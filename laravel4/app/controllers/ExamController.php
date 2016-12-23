<?php

class ExamController extends BaseController {

  public function showPreparation() {

    $p = Auth::user()->userable;

    // If Participant is opening exam preparation page for the first time,
    // then we create new Exam instance and assign it to them.
    if (!isset($p->exam)) {
      $pkg = new QPackage;
      $pkg->save();
      $pkg->enumerateQuestions();  // Must be called after dB insertion

      $e = new Exam;
      $e->session = 0;
      $e->qpackage_id = $pkg->id;
      $p->exam()->save($e);

      // Assign the exam
      $pkg->exam_id = $e->id;
      $pkg->save();
    }
    // Or if the participant already open the page before but NOT yet taken the exam,
    // then we just reference it.
    // Note: it is impossible for user that ALREADY TAKE EXAM to visit this page
    //       because there is filter in routes to this page.
    else {
      $e = $p->exam;
    }

    return View::make('participant.exam.preparation')
      ->withExam($e);
  }

  public function startExam()
  {
    $team = Auth::user()->userable->team_name;
    $e = Auth::user()->userable->exam;

    // Carbon::create($year, $month, $day, $hour, $minute, $second, $tz);
    $now = Carbon::now();

    // Simulation
    $opengate = Carbon::create(2015, 02, 28, 14, 0, 0, 'Asia/Jakarta');   // At 1 March, 14.00
    $closegate = Carbon::create(2017, 02, 24, 20, 30, 0, 'Asia/Jakarta'); // At 1 March, 15.30
    $zero_gate_opened = $opengate->diffInMinutes($now, false) > 0
                       && $closegate->diffInMinutes($now, false) < 0;

    // Real
    $opengate = Carbon::create(2016, 02, 28, 9, 00, 0, 'Asia/Jakarta');    // At 1 March, 9.00
    $closegate = Carbon::create(2016, 02, 28, 9, 31, 0, 'Asia/Jakarta');  // At 1 March, 9.55
    $first_gate_opened = $opengate->diffInMinutes($now, false) > 0
                       && $closegate->diffInMinutes($now, false) < 0;

    Log::info($team . ' :: [First gate] Different in time (minute) : ' . $opengate->diffInMinutes($now, false) . ' -- ' . $closegate->diffInMinutes($now, false));

    $opengate = Carbon::create(2015, 03, 1, 13, 30, 0, 'Asia/Jakarta');  // At 1 March, 13.30
    $closegate = Carbon::create(2015, 03, 1, 14, 20, 0, 'Asia/Jakarta');  // At 1 March, 14.20
    $second_gate_opened = $opengate->diffInMinutes($now, false) > 0
                        && $closegate->diffInMinutes($now, false) < 0;

    Log::info($team . ' :: [Second gate] Different in time (minute) : ' . $opengate->diffInMinutes($now, false) . ' -- ' . $closegate->diffInMinutes($now, false));

    $whitelistedTeam = ["PanitiaXYZ"];

    if (!$zero_gate_opened
        && !$first_gate_opened
        && !$second_gate_opened
        && !in_array($team, $whitelistedTeam)) {
        // Log to inform failure on gate closed
        Log::info($team . ' ::  Time gate not open yet.');
        return Redirect::route('participant.exam.preparation')
          ->withMessage('closed_gate');
    }

    if (!$e->end_time) {
        $e->session = 1;

        // Carbon DateTime extension
        // github.com/briannesbitt/Carbon
        $e->start_time = Carbon::now();
        $e->end_time = (Carbon::now()->addSeconds(7200));
        $e->save();
    }

    return Redirect::route('participant.exam.page');
  }

  // DEVELOPER MODE : destroy user related Exam instance
  //
  public function destroy()
  {
    if (count(Auth::user()->userable->exam)) {
      Auth::user()->userable->exam->delete();
    }

    return Redirect::route('participant.dashboard');
  }

  public function exam()
  {
    if (!Input::has('mapel')) {
      return Redirect::route('participant.exam.page', ['mapel' => 'matematika']);
    }


    $e = Auth::user()->userable->exam;

    // Get the current exam type subject from url (GET input)
    // If not present, default to the first subject in Qtype
    // In case of this EEC exam, the order is: Matematika, Fisika, Computer.

    // For better optimization, just hardcode the default : Matematika
    $questionSubject = Input::get('mapel', 'matematika');
    $subjectId = QType::where('name', '=', $questionSubject)->first()->id;

    $qpkg = $e->qpackage;

    // Get ALL the question in requested subject
    // $q = $qpkg->questions()->where('qtype_id', '=', $subjectId)->get();
    $q = $qpkg->scopeQType($subjectId)->get();

    // Get all the QType for pagination
    $subjectList = QType::all()->lists('name');

    // Pass the user's exam id to View for AJAX push saving to Database
    $examId = $e->id;

    Log::info('Exam_Page :: Tim-> ' . Auth::user()->userable->team_name . ':: Mapel-> ' . $questionSubject);

    return View::make('participant.exam.page')
      ->withQuestions($q)
      ->withSubjectList($subjectList)
      ->withSubjectId($subjectId)
      ->withExamId($examId);
  }

  public function getAnswer()
  {
    $examId = Input::get('exam_id');

    $ea = EAnswer::where('exam_id', '=', $examId)
            ->select(['id', 'exam_id', 'question_id', 'answer'])->get();

    return Response::json([
      'status' => 'sukses',
      'question' => $ea
    ]);
  }

    public function timeSync() {
        $e = Auth::user()->userable->exam;

        $carbon = Carbon::parse($e->end_time);
        $max_time = $carbon->timestamp;
        $now = Carbon::now()->timestamp;
        $remaining = $max_time - $now;

        return Response::json([
            'remaining' => $remaining,
            'max' => $max_time,
            'now' => $now
        ]);
    }

  public function submit()
  {
    if (Input::has('answers')) {
      $answers = Input::get('answers');
      $examId = Input::get('exam_id');

      foreach ($answers as $answer) {
        // First we check if there is already an answer with
        // matching exam_id and question_id in our database.
        // If there is no match then create new EAnswer model.
        $ea = EAnswer::alreadyAnswer($examId, $answer['id'])->first();
        if ( $ea == null ) {
          $ea = New EAnswer;
          $ea->exam_id = $examId;
          $ea->question_id = $answer['id'];
        }
        $ea->answer = $answer['answer'];
        $ea->save();
      }
    }

    return Response::json([
      'status' => 'success'
    ]);
  }

  public function showConfirmFinish()
  {
    $p = Auth::user()->userable;

    Log::info($p->team_name . " :: Confirmation page");
    return View::make('participant.exam.confirmFinish')
      ->withExam($p->exam);
  }

  public function confirmFinish()
  {
    $team = Auth::user()->userable->team_name;
    $e = Auth::user()->userable->exam;

    $e->session = 2;
    $e->calculateResult();

    Log::info($team . " :: I'm finish");

    return Redirect::route('participant.exam.result');
  }

  public function result()
  {
    $p = Auth::user()->userable;
    $e = $p->exam;

    return View::make('participant.exam.result')
      ->withParticipant($p)
      ->withExam($e);
  }
}
