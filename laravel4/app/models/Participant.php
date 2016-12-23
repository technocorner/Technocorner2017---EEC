<?php

class Participant extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users_participant';

	public $timestamps = false;

	public function user()
	{
		return $this->morphOne('User', 'userable');
	}

	public function exam()
	{
		return $this->hasOne('Exam');
	}

}
