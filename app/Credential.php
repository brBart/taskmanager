<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Credential extends Model
{
    use SoftDeletes;
    protected $table = 'credentials';
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
}
