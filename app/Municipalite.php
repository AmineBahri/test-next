<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipalite extends Model
{
    //
    protected $table = "municipalites";

    protected $fillable = ["name_fr","name_ar","region_id"];

    public function regions()
    {
    	return $this->belongsTo('App\Region','region_id');
    }
}
