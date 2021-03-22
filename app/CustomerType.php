<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    //
    protected $table = "customers_type";

    protected $fillable = ["name_fr","name_ar"];
}
