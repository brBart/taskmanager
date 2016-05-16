<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeSpent extends Model
{
    //
    use SoftDeletes;
    //

    protected $table = 'timespent';
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
}
