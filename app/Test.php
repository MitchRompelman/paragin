<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    public function calculations() {
        return $this->hasMany('App\Calculation', 'calculations_test_id_foreign');
    }

    public function scores() {
        return $this->hasMany('App\Score', 'scores_test_id_foreign');
    }

    public function grades() {
        return $this->hasMany('App\Grade', 'grades_test_id_foreign');
    }

    public function pvalues() {
        return $this->hasMany('App\Pvalue', 'pvalues_test_id_foreign');
    }

    public function ritvalues() {
        return $this->hasMany('App\Ritvalue', 'ritvalues_test_id_foreign');
    }
    
}
