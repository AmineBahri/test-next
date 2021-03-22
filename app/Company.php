<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = "companies";

    protected $fillable = ["name_fr","name_ar","adresse"];
}
