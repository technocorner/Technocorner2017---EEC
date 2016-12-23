<?php

class EAnswer extends Eloquent {


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'exam_answer';

  public $timestamps = false;


  public function question()
  {
    return $this->belongsTo('Question');
  }

  public function scopeAlreadyAnswer($query, $examId, $questionId)
  {
    $matchingAnswer = [
      'exam_id' => $examId,
      'question_id' => $questionId
    ];

    return $query->where($matchingAnswer);
  }

}
