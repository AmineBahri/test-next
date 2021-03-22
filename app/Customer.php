<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = "customers";

    protected $fillable = ["name","cin","address","birthday","phone","image_path","parents_name","customertype_id","companie_id","municipalite_id"];

    public function customertype()
    {
    	return $this->belongsTo('App\CustomerType');
    }

    public function companies()
    {
    	return $this->belongsTo('App\Company','companie_id');
    }

    public function municipalites()
    {
    	return $this->belongsTo('App\Municipalite','municipalite_id');
    }
}
