<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Comment;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        use SoftDeletes;
    //

    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function is_admin()
    {
        return ($this->role_id == \Config::get('constants.roles.admin')) ? true : false; 
    }

    public function is_developer()
    {
        return ($this->role_id == \Config::get('constants.roles.developer')) ? true : false; 
    }

    public function is_client()
    {
        return ($this->role_id == \Config::get('constants.roles.client')) ? true : false; 
    } 

    public function get_photo()
    {
        return ($this->photo == '') ?  \Config::get('constants.photo.profile_photo') : $this->photo;
    }

    public function complete_name()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function role()
    {
        if($this->role_id  == \Config::get('constants.roles.admin'))
            return 'admin';
        else if($this->role_id  == \Config::get('constants.roles.developer'))
            return 'developer';
        else if($this->role_id  == \Config::get('constants.roles.client'))
            return 'client';
        else
            return '';
    }
}
