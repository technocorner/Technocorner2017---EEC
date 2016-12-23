<?php

class QSortable extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qsortables';

    public function qpackage() {
        return $this->belongToOne('QPackage');
    }

    public function qtype() {
        return $this->hasOne('QType');
    }

    public function question() {
        return $this->hasOne('Question');
    }


}
