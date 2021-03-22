<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = "regions";

    protected $fillable = ["name_fr","name_ar"];

    public function municipalites()
    {
    	return $this->hasMany('App\Municipalite');
    }
}
