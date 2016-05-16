<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    //
    use SoftDeletes;

        //
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
}
