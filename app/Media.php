<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'media';
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
	public $timestamps = true;
}
