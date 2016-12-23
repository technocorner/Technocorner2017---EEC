<?php

class Question extends Eloquent {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'questions';

    function nl2br_outside_pre($str) {
        $count = 0;
        $pre = array();

        // Replace <pre></pre> with var sign ${0}
        $nopre = preg_replace_callback('/<pre[^>]*>[^<]*<\/pre>[^\n]*\n/', function ($match) use (&$count) {
                global $pre;
                $pre[$count] = $match[0];

                return '${' . $count++ . '}';
            }, $str);

        // Convert newly converted string
        $brnopre = nl2br($nopre);

        // Recover removed <pre>
        $withpre = preg_replace_callback('/\${[0-9]+}/', function ($match) {
            global $pre;
            $idx = intval(str_replace('$', '', $match[0]));

            return $pre[$idx];
        }, $brnopre);

        return $withpre;
    }

    public function getQuestion() {
        return $this->nl2br_outside_pre($this->question);
    }

    public function getChoice($letter) {
        $letter = 'ch' . $letter;
        return $this->nl2br_outside_pre($this->$letter);
    }

    public function qtype() {
        return $this->belongsTo('QType');
    }

    public function qpackages() {
        return $this->belongsToMany('QPackage');
    }
}