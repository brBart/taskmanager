<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
	use SoftDeletes;
    //

    protected $table = 'companies';
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function get_photo()
    {
        return ($this->photo == '') ?  \Config::get('constants.photo.profile_photo') : $this->photo;
    }

}
