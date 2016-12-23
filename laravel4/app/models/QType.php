<?php

class QType extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qtypes';

    public function questions() {
        return $this->hasMany('Question');
    }
}
