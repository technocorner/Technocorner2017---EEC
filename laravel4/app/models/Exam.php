<?php

class Exam extends Eloquent {


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'exams';
  public $timestamps = false;

  protected $appends = ['exam_duration'];

  // Hardcode exam duration 2 hours.
  protected $exam_duration = 7200;
  protected $quest_count = 120;

  public function qpackage()
  {
      return $this->hasOne('QPackage');
  }

  public function participant()
  {
    return $this->belongsTo('Participant');
  }

  public function getExamDurationAttribute()
  {
    return $this->exam_duration;
  }

  public function calculateResult()
  {
    $answers = EAnswer::where('exam_id', '=', $this->id)
      ->select(['question_id', 'answer'])
      ->with(['question' => function($q){
            $q->select(['id', 'answer']);
          }])
      ->get();

    $VALUE_CORRECT = 4;
    $VALUE_EMPTY = 0;
    $VALUE_WRONG = -1;

    $score = 0;
    $score_true = 0;
    $score_false = 0;
    $score_null = 0;

    foreach ($answers as $answer) {
      if ($answer->answer == $answer->question->answer)
      {
        $score += $VALUE_CORRECT;
        $score_true++;
      } else {
        $score += $VALUE_WRONG;
        $score_false++;
      }
    }

    $score_null = $this->quest_count - ($score_true + $score_false);

    $this->score = $score;
    $this->score_true = $score_true;
    $this->score_false = $score_false;
    $this->score_null = $score_null;
    $this->session = 3; // 3 mean EXAM already graded and fully completed
    $this->save();
  }
}
