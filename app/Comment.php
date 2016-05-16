<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use SoftDeletes;
    
    //
    protected $table = 'comments';
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
