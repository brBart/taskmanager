<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Comment;
use App\Media;
use App\Project;
use App\TimeSpent;
use Carbon\Carbon;
use App\Procedure;

class Task extends Model
{
    //
    use SoftDeletes;

        //
    public $timestamps = true;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function comments_relation()
    {

        return $this->hasMany('App\Comment')
                     ->selectRaw('task_id,case when count(*) is null then 0 else count(*) end as count')
                     ->groupBy('task_id');

    }

    public function media_relation()
    {
        return  $this->hasMany('App\Media')
                     ->selectRaw('task_id, count(*) as count')
                     ->groupBy('task_id');
    }

    public function timespent_relation()
    {
        return  $this->hasMany('App\TimeSpent')
                     ->selectRaw('task_id, count(*) as count')
                     ->whereNotNull('end_datetime')
                     ->groupBy('task_id');
    }

    public function get_working_user()
    {
        return  $this->hasMany('App\TimeSpent')
                     ->selectRaw('user_id, end_datetime , count(*) as count')
                     ->whereNull('end_datetime');
    }


    public function assigned_user()
    {
        return $this->belongsTo('App\User', 'assign_user_id');
    }


    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

    public function status()
    {
        return  \Config::get('constants.task_status.reverse.'.$this->status_id);
    }

    public function timespent_total_time()
    {
        return  $this->hasMany('App\TimeSpent')
                    ->selectRaw('task_id, sum(TIMESTAMPDIFF(minute, start_datetime, end_datetime)) as minutes_elapsed')
                    ->whereNotNull('end_datetime')
                    ->groupBy('task_id');
        
    }  




}
