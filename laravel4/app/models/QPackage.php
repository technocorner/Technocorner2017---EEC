<?php

/**
 * Provide persistent randomized questions per User basis.
 *
 */
class QPackage extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'qpackages';

    public function exam() {
        return $this->belongsTo('Exam');
    }

    public function qsortables() {
        return $this->hasMany('QSortable');
    }

    public function scopeQType($qtype_id) {
        // Get the randomized sequence form QSortable model
        $qsorts = QSortable::where('qpackage_id', '=', $this->id)
                ->where('qtype_id', '=', $qtype_id)
                ->orderBy('index', 'asc')->get();

        // Get ALL the question that have the asked subject (qtype)
        $q = Question::where('qtype_id', '=', $qtype_id);

        // Then we order the $q according to randomized $qsorts order
        $orderstr = 'FIELD(id';
        foreach($qsorts as $qsort) {
            $q_id = $qsort->question_id;
            $orderstr .= ', "' . $q_id . '"';
        }
        $orderstr .= ')';
        $q->orderByRaw($orderstr);

        return $q;
    }

    public function enumerateQuestions() {
        // Separately process questions in each QType
        foreach (QType::all() as $qtype) {
            $qtype_id = $qtype->id;
            $q_ids = Question::where('qtype_id', '=', $qtype_id)->orderBy('id')->get(['id', 'randomize']);
            $q_ids_rand = null;

            // Separate randomizabled-questions into an array
            $i = 0;
            foreach($q_ids as $q_id) {
                if ($q_id['randomize'] == 1) {
                    $q_ids_rand[$i] = $q_id;
                    $i++;
                }
            }

            // Protection against empty array
            if ($q_ids_rand) {
                shuffle($q_ids_rand); // Suffle randomizabled question array
            }

            // Return shuffled array into origin
            $innerIt = 0;
            $outerIt = 0;
            foreach($q_ids as $q_id) {
                if ($q_id['randomize'] == 1) {
                    $q_ids[$outerIt] = $q_ids_rand[$innerIt];
                    $innerIt++;
                }
                $outerIt++;
            }

            // Assign into QSortable
            $i = 0;
            foreach($q_ids as $q_id) {
                $qsort = new QSortable;
                $qsort->index = $i;
                $qsort->qpackage_id = $this->id;
                $qsort->qtype_id = $qtype_id;
                $qsort->question_id = $q_id['id'];
                $qsort->save();
                $i++;
            }
        }
    }

}
