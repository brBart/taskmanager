<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//use Illuminate\Database\Schema;


use App\Http\Requests;
use Carbon\Carbon;
use App\User;
use App\Company;
use App\Skill;
use App\Project;
use App\Procedure;
use App\Manager;
use App\SkillProcedure;
use App\Task;
use App\Comment;
use App\Media;
use App\TimeSpent;
use App\Credential;
use App\Events\CommentEvent;
use App\Notification;
use App\Events\TaskEvent;
use App\Events\StartEndTaskTimerEvent;
use Auth;
use DB;
use Laracasts\Utilities\JavaScript\JavaScriptServiceProvider;
    

class PagesController extends Controller
{

    public $auth_user = array('id' => '',
                              'email' => '',
                              'first_name' => '',
                              'last_name' => '',
                              'role_id' => '' );

    public function __construct()
    {
        $this->middleware('auth');
        
        if(Auth::check())
        {
            $this->auth_user['id'] = Auth::user()->id;
            $this->auth_user['email'] = Auth::user()->email;
            $this->auth_user['fist_name'] = Auth::user()->first_name;
            $this->auth_user['last_name'] = Auth::user()->last_name;
            $this->auth_user['role_id'] = Auth::user()->role_id;
            $this->auth_user['role_id'] = Auth::user()->role_id;
            $this->auth_user['role'] = Auth::user()->role();
               
        }
    }



    public function template()
    {
        
        return view("template");

    }

    public function dashboard()
    {

        return view("dashboard");

    }


    public function api_auth_user_get()
    {   
        
        if(Auth::check())
        {
            $user_id =Auth::user()->id;
            return response()->json( array('status' => 'success',
                                            'user'  => User::where('id',$user_id )->first()
                                           )
                                    );
    
        }
        else
        {
            return response()->json( array('status' => 'fail',
                                            'user'  => 0
                                           )
                                    );

        }
        
        
    }

    /********************************Globals*****************************************************/

    public function api_cities_get($country)
    {

        $countries =  json_decode(file_get_contents('cities.json'), true);//json_decode(\Config::get('cities'), TRUE);

        return $countries[$country];
    }

    

/*      $company_name = 'Aboitiz Co.';
        $company_logo = \Config::get('constants.domain').Auth::user()->get_photo();
        $application_name = 'Task Manager';
        $application_logo =  \Config::get('constants.domain').Auth::user()->get_photo();*/

    public function task_status_email_notification()
    {

        $task_id = 1;
        $emails = array();
        $task = Task::with('project')
                    ->where('id' , '=' , $task_id)
                    ->first();

        $project = Project::find($task->project_id);
        $project_title = $project->project_name;

        $task_title = $task->title;
        $link = \Config::get('constants.domain').'/tasklists?task='.$task_id.'&referrer=email';
        $task_status = $task->status();
        $user_name = Auth::user()->complete_name();
        $user_photo = \Config::get('constants.domain').Auth::user()->get_photo();
        $comments = Comment::with('user')
                          ->where('task_id', '=', $task_id)
                          ->orderBy('created_at', 'asc')
                          ->get();

        $managers_email = Manager::where('project_id', '=' , $project->id)
                           ->where('manager' , '=' , 1)
                           ->join('users', 'managers.user_id', '=', 'users.id')
                           ->get(['email'])
                           ->toArray();


        foreach ($managers_email as $me) {
            array_push($emails , $me['email']);
        }

        if(Auth::user()->email != '')
            if(!in_array(Auth::user()->email, $emails))
                array_push($emails , Auth::user()->email);


        if($project->email != '')
            if(!in_array($project->email, $emails))
                array_push($emails , $project->email);

        //return $emails;
        $data =  array('project_title' => $project_title,
                       'task_title' => $task_title,
                       'link' => $link,
                       'task_status' => $task_status,
                       'user_name' => $user_name,
                       'user_photo' => $user_photo,
                       'comments' => $comments,
                       'email' => Auth::user()->email,
                       'from' => 'info@cloudology.codes'
                 );

        $ok = \Mail::send('emails.notification', $data, function($message) use ($project_title, $task_title, $task_status,$managers_email, $emails)
        {   
            $message->from('info@cloudology.codes', 'Cloudology');
            $message->to( $emails)->subject($project_title.':'.$task_title.':'.$task_status);
        });

        if($ok)
            return "success";
        else
            return "error";
    }
    public function api_photo_post(Request $request){


        $table =Input::get('table');
        $image = Input::file('file');
        $user_id = Input::get('id');

        $filename = str_random(20).'.'.$image->getClientOriginalExtension();

        $direct_path = \Config::get('constants.path.photos').$filename;

        $move = $image->move(\Config::get('constants.path.public_path'), $filename);

        if($move){

            if($user_id > 0){
                $save = DB::table($table)
                          ->where('id',$user_id)
                          ->update(array( 'photo' => $direct_path));

                if($save){
                    $res = array('path' => $direct_path,
                                'status' => 'success'   
                                );

                    return response()->json(['response' => $res]);
                }
                else
                    return response()->json(['response' => "error"]);

            }else{        
                return response()->json(['response' => "success"]);
            }   

        }else{
                return response()->json(['response' => "error"]);
        }
    }

    public function save_data(Request $request)
    {

        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table =Input::get('table');
            $field =Input::get('field');
            $value =Input::get('value');
            $company_id =Input::get('company_id');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0)
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                    
                    
                    $role_id =Input::get('role_id');
                    $company_id =Input::get('company_id');

                    if(isset($role_id))
                    {
                        if($table == "companies" || $table == "projects")
                            $item_id = DB::table($table)    
                                         ->insertGetId([$field=>$value,
                                                       'created_at'=>$timestamp,
                                                       'updated_at'=>$timestamp,
                                                      ]);
                        else
                            $item_id = DB::table($table)    
                                ->insertGetId([$field=>$value,
                                              'role_id' => $role_id,
                                              'created_at'=>$timestamp,
                                              'updated_at'=>$timestamp  
                                              ]);

                    }
                    elseif(isset($company_id))
                        $item_id = DB::table($table)    
                                     ->insertGetId([$field=>$value,
                                                    'created_at'=>$timestamp,
                                                    'updated_at'=>$timestamp 
                                                 ]);        
                    else
                        $item_id = DB::table($table)    
                                     ->insertGetId([$field=>$value,
                                                    'created_at'=>$timestamp,
                                                    'updated_at'=>$timestamp 
                                                    ]);

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);

    }

    /*************************************Notifications**************************************/

    public function api_notifications_get()
    {
        $notifications = array();
        $notification_type = \Config::get('constants.notification_type');
        $user_id = Auth::user()->id;


        foreach ($notification_type as $key => $value) 
        {
            if($value == 0 && Auth::user()->is_developer())
            {
                $last_time_read = Notification::where('notification_type' ,'=' ,$value)->first();

                if($last_time_read)
                {
                    $task_updates = Task::where('updated_at' , '>', $last_time_read)->get();

                    foreach($task_updates as $task_update)
                    {

                        array_push($notifications , array('messsage' =>  'Task '.$task_update->title.' has a new update.' 
                                                         ,'link' => '/tasklists') );  
                    }
                }
                else
                {

                }

            }else if($value == 1 && !Auth::user()->is_de())   


            if(Auth::user()->is_developer())
            {

            } 
            else
            {
                array_push($notifications , array('messsage' =>  $messsage ,
                                               'link' => $link ) );    
            }

            
            //array_push($notifications , array($key =>  $value  ) );   
        }
        
        return response()->json($notifications);
    }

    /******************************************Media*****************************************/

    public function upload_photo(Request $request){


        $table =Input::get('table');
        $image = Input::file('photo');
        $user_id = Input::get('id');

        $filename = str_random(20).'.'.$image->getClientOriginalExtension();

        $direct_path = \Config::get('constants.path.photos').$filename;

        $move = $image->move(\Config::get('constants.path.public_path'), $filename);

        if($move){

            if($user_id > 0){
                $save = DB::table($table)
                          ->where('id',$user_id)
                          ->update(array( 'photo' => $direct_path));

                if($save){
                    $res = array('path' => $direct_path,
                                'status' => 'success'   
                                );

                    return response()->json(['response' => $res]);
                }
                else
                    return response()->json(['response' => "error"]);

            }else{        
                return response()->json(['response' => "success"]);
            }   

        }else{
                return response()->json(['response' => "error"]);
        }
    }



    public function api_media_post(Request $request){
        if ($request->isMethod('post'))
        {   

            $res = array('status' => 'error',
                         'reason' => 'default error!');

            $task_id = Input::get('task_id');
            $table ='media';
            $media = Input::file('file');
            $filesize = Input::file('file')->getSize();

            $res = response()->json(['response' => "error"]);

            $filename = str_random(20).'.'.$media->getClientOriginalExtension();

            $direct_path = \Config::get('constants.path.photos').$filename;

            $move = $media->move(\Config::get('constants.path.public_path'), $filename);

            if($move){

                $media = new Media();
                $media->path = $direct_path;
                $media->filesize = $filesize;
                $media->task_id = $task_id;
                $result = $media->save();

                if($result){

                    $count = Media::where('task_id' , '=' , $task_id )
                            ->count();

                    $res = array('count' => $count,
                                 'status' => 'success'   
                                 );    
                } 
            }else{
                 $res = array('status' => 'error',
                         'reason' => 'unable to move file');
                    
            }



            return response()->json($res);
        }
    }


    public function save_media(Request $request){
        if ($request->isMethod('post'))
        {   

            $res = array('status' => 'error',
                         'reason' => 'default error!');

            $table ='media';
            $media = Input::file('media');
            $filesize = Input::file('media')->getSize();
            $task_id = Input::get('task_id');

            $res = response()->json(['response' => "error"]);

            $filename = str_random(20).'.'.$media->getClientOriginalExtension();

            $direct_path = \Config::get('constants.path.photos').$filename;

            $move = $media->move(\Config::get('constants.path.public_path'), $filename);

            if($move){

                $media = new Media();
                $media->path = $direct_path;
                $media->filesize = $filesize;
                $media->task_id = $task_id;
                $result = $media->save();

                if($result){
                    $res = array('id' => $media->id,
                                 'path' => $media->path,
                                 'created_at' => $media->created_at,
                                 'filesize' => $filesize,
                                 'status' => 'success'   
                                 );    
                } 
            }else{
                 $res = array('status' => 'error',
                         'reason' => 'unable to move file');
                    
            }

            return response()->json($res);
        }
    }

     public function api_media($task_id)
    {

        $results = Media::where('task_id', '=' , $task_id )->get();

        return \Response::json($results);
    }


    public function api_media_get($task_id)
    {

        $results = Media::where('task_id', '=' , $task_id )->get();

        return \Response::json($results);
    }



    /****************************************Company*******************************/
    public function api_companies_get()
    {
        $companies = Company::where('name', '!=', '')
                            ->whereNotNull('name')->get();

        return \Response::make(json_encode($companies, JSON_PRETTY_PRINT))
                        ->header('Content-Type', "application/json");
    }

    public function company($mode,$id)
    {
        if($mode =='viewall'){
            $companies = Company::all();
            return view("companies", compact('companies'));
        }elseif($mode == 'create'){
            return view("create_company_form");
        }elseif($mode == 'edit'){
            $company = Company::where('id','=',$id)->first();
            return view('edit_company_form',compact('company' ));          
        }elseif($mode == 'delete'){

            $company = Company::find($id);
            $company->delete();

            return redirect("users");
        }
    }


    
    public function api_company_post(Request $request)
    {
        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='companies';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0 && $item_id != '')
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                         
                    $item_id = DB::table($table)    
                            ->insertGetId([$field=>$value,'created_at'=>$timestamp,'updated_at'=>$timestamp  ]);

                

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);
    }

   

    /*********************************************Users****************************************************/

 

    public function api_users_get($role)
    {

        $results = User::where('role_id', '=', \Config::get('constants.roles.'.$role))
                        ->whereNull('deleted_at')
                 //       ->where('activated' , '=', 1)
                        ->where('first_name' ,'!=', '')
                        ->where('last_name' ,'!=', '')
                        ->get();
        
        return \Response::json($results);

    }

    public function api_user_post(Request $request)
    {
        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='users';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0 && $item_id != '')
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                         
                    $item_id = DB::table($table)    
                            ->insertGetId([$field=>$value,'created_at'=>$timestamp,'updated_at'=>$timestamp  ]);

                

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);
    }

    public function api_get($obj, $role)
    {

        if($obj == 'projects'){
            $results = Project::all();        
        }elseif ($obj == 'skills') {
            $results = Skill::all();
        }elseif ($obj == 'procedures') {
            $results = Procedure::all();
        }elseif ($obj == 'roles') {
            $results = \Config.get('constants.roles');
        }elseif ($obj == 'task_statuses') {
            $results = \Config.get('constants.task_statuses');
        }else{
            $results = User::where('role_id', '=', \Config::get('constants.roles.'.$role))->get();
        }
        
        return \Response::json($results);
    }


    public function edit_profile()
    {
        return view("edit_my_profile_form");
    }

    public function user($user, $mode, $id)
    {
        if($mode == 'create')
        {
            
            $mode = 'add';
            return view("user_form", compact('mode')); 

/*          $companies = Company::all();
            $roles  = \Config::get('constants.roles');
            $cities = \Config::get('constants.cities');
            $countries = \Config::get('constants.countries');
            $timezones = \Config::get('constants.timezones');
            $role =\Config::get('constants.roles.'.$user);
*/
            return view("create_user_form", compact('user' ,'role', 'companies' , 'roles', 'cities', 'countries','timezones'));
        }
        elseif($mode =='edit')
        {
            $user = User::where('id', '=' ,$id)->first();
            $companies = Company::all();
            $roles  = \Config::get('constants.roles');
            $cities = \Config::get('constants.cities');
            $countries = \Config::get('constants.countries');
            $timezones = \Config::get('constants.timezones');

            return view("edit_user_form", compact('user' , 'companies' , 'roles', 'cities', 'countries','timezones'));
        }elseif($mode == 'delete'){
            
            $user = User::find($id);
            $user->delete();

            return redirect('users');
        }elseif($mode == 'viewall'){

            //$users = User::all();
            //$companies = Company::all();

            return view("users", compact('users','companies', 'mode','user'));
            
        }else{

            if($user == 'company')
            {
                $companies = Company::all();

                return view("users", compact('companies','user','mode'));
            }
            else
            {
                $role = \Config::get('constants.roles.'.$user);
            
                $users = User::where('role_id', '=', $role)->get();
                return view("users", compact('users','user' ,'mode'));
            }
             
        }
    }



    /***********************************************Procedures********************************************************/
    public function api_procedures_get()
    {
        $procedures = DB::table('procedures')->whereNull('deleted_at')->get();

        return response()->json($procedures);

    }
    public function api_procedure_get($id)
    {
        $procedure = Procedure::find($id);
        if($procedure)
            return response()->json($procedure);
        else
            return response()->json('error');

    }



    public function api_procedure_post(Request $request)
    {
        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='procedures';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0 && $item_id != '')
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                         
                    $item_id = DB::table($table)    
                            ->insertGetId([$field=>$value,'created_at'=>$timestamp,'updated_at'=>$timestamp  ]);

                

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);
    }


    public function api_skill_procedure_get($id)
    {
            $skill_procedure = array();

            $skills = Skill::where('name' , '!=' , '')
                            ->get();

            foreach ($skills as $skill) {
                $count = SkillProcedure::where('procedure_id', '=', $id)
                                               ->where('skill_id', '=', $skill->id)
                                               ->where('related','=',1)
                                               ->count();

                $selected = $count > 0 ?  true : false;

                array_push($skill_procedure, array('id' => $skill->id,
                                                   'name' => $skill->name,
                                                   'selected' => $selected  
                                                  ));

            }

            
           // $skill_related_ids = array_column($skill_related, 'skill_id');

            return response()->json($skill_procedure);

    }

    public function procedure($mode,$id)
    {

        if($mode == 'viewall')
        {

            return view("procedures");

        }
        elseif($mode == 'create')
        {

            return view("create_procedure_form");
        }    
        elseif($mode == 'edit')
        {
           /* $skill_related = SkillProcedure::where('procedure_id', '=', $id)
                                ->where('related','=',1)
                                ->get()
                                ->toArray();

            $skill_related_ids = array_column($skill_related, 'skill_id');*/

            $procedure = Procedure::where('id', '=' , $id)->first();

            //$skills = Skill::all();
            //'skills' , 'skill_related_ids'
            return view('edit_procedure_form', compact('procedure'));
        }
        elseif($mode == 'delete')
        {

            $procedure = Procedure::find($id);
            $procedure->delete();

            $procedures = Procedure::all();
            return redirect('procedures');
        }
    }

    /***********************************************Skills**********************************************/

    public function api_skills_get()
    {
        $skills = DB::table('skills')->whereNull('deleted_at')->get();

        return response()->json($skills);

    }

    public function api_skill_post(Request $request)
    {
        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='skills';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0 && $item_id != '')
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                         
                    $item_id = DB::table($table)    
                            ->insertGetId([$field=>$value,'created_at'=>$timestamp,'updated_at'=>$timestamp  ]);

                

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);
    }

    public function skill($mode , $id)
    {
        if($mode == 'viewall')
        {
            $skills = Skill::all();

            return view("skills", compact('skills'));

        }
        elseif ($mode == 'create') 
        {
            //$users = User::all();
            
            return view("create_skill_form");

        }
        elseif($mode == 'edit')
        {
            $skill = Skill::where('id' ,'=' ,$id )->first();

            return view('edit_skill_form', compact('skill'));
        }
        elseif($mode =='delete')
        {
            $skill = Skill::find($id);
            $skill->delete();

            $skills = Skill::all();

            return redirect('skills');
        }
    }

    /***********************************************Projects***********************************************************/
     public function api_project_post(Request $request)
    {
        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='projects';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0 && $item_id != '')
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                             'status' => 'fail' 
                        );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                         
                    $item_id = DB::table($table)    
                            ->insertGetId([$field=>$value,'created_at'=>$timestamp,'updated_at'=>$timestamp  ]);

                

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);
    }

    public function api_projects_get()
    {
        $projects = DB::table('projects')->whereNull('deleted_at')->get();
        return response()->json($projects);
    }

    public function api_credential_get($credential_id)
    {
        $credentials = Credential::find($credential_id);
        return response()->json($credentials);
    }

    public function api_credential_delete_post(Request $request)
    {
        if($request->isMethod('post'))
        {
            $id = Input::get('id');
            $credential = Credential::find($id);
            
            if($credential->delete())
                return response()->json(['response' => "success"]);
            else
                return response()->json(['response' => "error"]);
        }
            
    }


    public function api_credentials_get($project_id)
    {
        $credentials = Credential::where('project_id' , '=' , $project_id)->get();
        return response()->json($credentials);
    }

    public function api_credential_post(Request $request)
    {
        if ($request->isMethod('post'))
        {  
            $mode =Input::get('mode');
            $id = Input::get('id');
            $title = Input::get('title');
            $url = Input::get('url');
            $username = Input::get('username');
            $password = Input::get('password');
            $notes = Input::get('notes');
            $project_id = Input::get('project_id');

            if($mode == 'new')
            {
                $credential = New Credential();
                $credential->title = $title;
                $credential->url = $url;
                $credential->username = $username;
                $credential->password = $password;
                $credential->project_id = $project_id;
                $credential->notes = $notes;

                if($credential->save())
                {
                    return response()->json(['response' => 'success']);
                }
                else
                {
                    return response()->json(['response' => 'error']);
                }    


            }
            else
            {
                $credential= Credential::find($id);

                if($credential)
                {
                    $credential->title = $title;
                    $credential->url = $url;
                    $credential->username = $username;
                    $credential->password = $password;
                    $credential->project_id = $project_id;
                    $credential->notes = $notes;

                    if($credential->save())
                    {
                        return response()->json(['response' => 'success']);
                    }
                    else
                    {
                        return response()->json(['response' => 'error']);
                    }     
                }
                else
                {
                    return response()->json(['response' => 'error']);
                } 


            }
        }
    }

    public function api_project_manager_post(Request $request){
        if ($request->isMethod('post'))
        {   
            $ts = '';


            $ret = 'error';

            $table ='managers';
            $company_id =Input::get('company_id');
            $user_id =Input::get('user_id');
            $manager =Input::get('manager');
            $project_id =Input::get('project_id');


            if($user_id > 0 && $company_id == 0 )
            {
                $is_exist = Manager::where('project_id' , '=', $project_id)
                                   ->where('user_id' , '=' , $user_id)
                                   ->count();        
                
                if($is_exist > 0 )
                {
                    $save = DB::table($table)
                    ->where('user_id',$user_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));

                    if($save>0)
                    {
                        $ret = 'success';
                    }
                }
                else
                {
                    $item_id = DB::table($table)    
                            ->insertGetId(['user_id'=>$user_id, 'project_id'=>$project_id , 'manager' => $manager]);
                    

                    if($item_id > 0)
                    {
                        $ret = 'success';
                    }
                }
            }
            
            if($company_id > 0 && $user_id == 0)
            {
                $is_exist = Manager::where('project_id' , '=', $project_id)
                                   ->where('company_id' , '=' , $company_id)
                                   ->count();   

                if($is_exist > 0 )
                {
                    $save = DB::table($table)
                    ->where('company_id',$company_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));

                    if($save)
                    {
                        $ret = 'success';
                    }
                }
                else
                {
                    $item_id = DB::table($table)    
                            ->insertGetId(['company_id'=>$company_id, 'project_id'=>$project_id , 'manager' => $manager]);

                    if($item_id > 0 )
                    {
                        $ret = 'success';
                    }

                }                   
            }


            

            /*if($user_id > 0)
            {
                $save = DB::table($table)
                    ->where('user_id',$user_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));
            }
            else
                $save = DB::table($table)
                    ->where('company_id',$company_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));
                    

            if($save){
                return response()->json(['response' => "success"]);

            }else{
                if($user_id > 0)
                    $item_id = DB::table($table)    
                            ->insertGetId(['user_id'=>$user_id, 'project_id'=>$project_id , 'manager' => $manager]);
                else
                {
                    $ts ='tt';
                    $item_id = DB::table($table)    
                            ->insertGetId(['company_id'=>$company_id, 'project_id'=>$project_id , 'manager' => $manager]);
                }
                    

                if($item_id)
                    return response()->json(['response' => "success-".$ts]);
                else
                    return response()->json(['response' => "error"]);
            }*/     
        
     
        }

        return response()->json(['response' => $ret]);

    }

    public function save_project_manager(Request $request){
        if ($request->isMethod('post'))
        {   

            $table ='managers';
            $company_id =Input::get('company_id');
            $user_id =Input::get('user_id');
            $manager =Input::get('manager');
            $project_id =Input::get('project_id');
            

            if($user_id > 0)
                $save = DB::table($table)
                    ->where('user_id',$user_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));
            else
                $save = DB::table($table)
                    ->where('company_id',$company_id)
                    ->where('project_id',$project_id)
                    ->update(array( 'manager' => $manager));
                    

            if($save){
                return response()->json(['response' => "success"]);

            }else{
                if($user_id > 0)
                    $item_id = DB::table($table)    
                            ->insertGetId(['user_id'=>$user_id, 'project_id'=>$project_id , 'manager' => $manager]);
                else
                    $item_id = DB::table($table)    
                            ->insertGetId(['company_id'=>$company_id, 'project_id'=>$project_id , 'manager' => $manager]);
                    

                if($item_id)
                    return response()->json(['response' => "success"]);
                else
                    return response()->json(['response' => "error"]);
            }     

     
        }

        return response()->json(['response' => "error"]);

    }



    public function api_project_managing_companies_get($id)
    {
        $managing_companies = array();

        $companies = Company::whereNotNull('name')
                            ->where('name' , '!=' , '')
                            ->get();

        foreach ($companies as $company) {

            $count = Manager::where('project_id', '=', $id)
                                ->where('company_id','=',$company->id)
                                ->where('manager','=',1)
                                ->count();

            $selected = $count  > 0 ? true : false;

            array_push( $managing_companies ,array('id' => $company->id,
                                                   'name' => $company->name ,
                                                   'selected' => $selected,
                                                    )); 

        }

            return response()->json($managing_companies);
    }


    public function api_project_managing_users_get($id, $role_id)
    {
            $managing_users = array();

            $users = User::where('first_name' , '!=', '')
                         ->where('last_name' , '!=', '')
                         ->where('role_id' , '=' , $role_id)
                         ->get();

            foreach ($users as $user) {

                $count = Manager::where('project_id', '=', $id)
                                    ->where('user_id','=',$user->id)
                                    ->where('manager','=',1)
                                    ->count();

                $selected = $count  > 0 ? true : false;

                array_push( $managing_users ,array('id' => $user->id,
                                                    'name' => $user->first_name.' '.$user->last_name ,
                                                     'selected' => $selected,
                                                  )); 

            }


             return response()->json($managing_users);
    }




    public function project($mode , $id)
    {
        if($mode == 'viewall')
        {

            return view("projects");

        }
        elseif($mode == 'create')
        {
            $users = User::all();
            $companies = Company::all();

            return view("create_project_form", compact('users', 'companies'));


        }    
        elseif($mode == 'edit')
        {

            $project = Project::where('id','=', $id)->first();
            return view('edit_project_form', compact('project') );
        }
        elseif($mode == 'delete')
        {
            $project = Project::find($id);
            $project->delete();

            $projects = Project::all();

            return redirect('projects');
        }
    }


    

    /*********************************************Comments**************************************************************/
    public function api_comment_post(Request $request)
    {
        $res = array('status' => 'error');

        if ($request->isMethod('post'))
        {  

            $user_id = Auth::user()->id;
            $task_id = Input::get('task_id');
            $content = Input::get('content');

            if($content != "")
            {    
                $comment = new Comment;
                $comment->content = $content;
                $comment->user_id = $this->auth_user['id'];
                $comment->task_id = $task_id;
                $comment->save();

                $res = array('status' => 'success'   
                                );
                $new_comment = Comment::with('user')
                                      ->where('id', '=', $comment->id)
                                      ->get(['id','content','user_id','task_id','created_at']);

                event(new CommentEvent($new_comment));
            }
        }
        return response()->json(['response' =>$res]);


    }


    public function save_comment(Request $request)
    {
        $res = array('status' => 'error');

        if ($request->isMethod('post'))
        {  
            $user_id =Input::get('user_id');
            $task_id =Input::get('task_id');
            $content = Input::get('content');

            if($content != "")
            {    
                $comment = new Comment;
                $comment->content = $content;
                $comment->user_id = $user_id;
                $comment->task_id = $task_id;
                $comment->save();

                $res = array('id' => $comment->id,
                             'user' => $comment->user->first_name,
                             'created_at' => $comment->created_at,
                             'content' => $comment->content,
                             'task_id' => $comment->task_id,
                             'status' => 'success'   
                            );
                event(new CommentEvent($task_id));
            }
        }
        return response()->json(['response' => $res]);
    }

    public function api_comments($task_id ,$offset)
    {
        $offset = isset($offset) ? $offset : 0;
        $results = Comment::with('user')
                          ->take(5)
                          ->offset($offset)
                          ->where('task_id', '=', $task_id)
                          ->get();
        
        return \Response::json($results);
    }


    public function api_comments_get($task_id, $offset){
        
        $results = Comment::with('user')
                          ->where('task_id', '=', $task_id)
      //                    ->take(5)
      //                    ->offset($offset)
                          ->orderBy('created_at', 'asc')
                          ->latest()
                          ->get();
        
        return \Response::json($results);
    }

    /**********************************************Tasks*************************************************************/

    public function api_task_time_post(Request $request){

        if($request->isMethod('post'))
        {

            $res = array( 'id' => 0 ,
                          'status' => 'error',
                          'mode' => 'close',  
                        );

            $task_id = Input::get('task_id');
            $user_id = Auth::user()->id;
            $mode = Input::get('mode');
            //ts_id or time_spent_id , if set, this will close the current open time
            $ts_id = Input::get('ts_id');  

            if(isset($ts_id) && $ts_id > 0)
            {

                 $current_open_time = TimeSpent::find($ts_id);
                 $current_open_time->end_datetime = Carbon::now();

                 //closing the time
                 if($current_open_time->save())
                {
                    $res = array( 'id' => $current_open_time->id ,
                                  'status' => 'success',
                                  'task_id' => $task_id,
                                  'mode' => 'close',  
                                );
                }
            }
            else
            {
                
                 $starting_time = new TimeSpent();
                 $starting_time->start_datetime = Carbon::now();
                 $starting_time->task_id = $task_id;
                 $starting_time->user_id = $user_id;

                 //openning a new time
                 if($starting_time->save())
                 {
                    $res = array( 'id' => $starting_time->id ,
                                  'task_id' => $task_id, 
                                  'status' =>  'success',
                                  'mode' => 'open', 
                                );
                 } 



            }



            event(new StartEndTaskTimerEvent($res));
            
        
        }

        return response()->json($res);
    }



    public function client_order_slots()
    {
        $project_manage = Manager::where('user_id' , '=' , $this->auth_user['id'])
                                     ->where('manager' , '=' , 1)
                                     ->get(['project_id'])
                                     ->toArray();

        $ordering_slots = Task::orderby('ordering' ,'asc')
                    ->orWhere('created_by_user_id', '=', $this->auth_user['id'])
                    ->orWhereIn('project_id' , $project_manage)
                    ->whereNull('deleted_at')
                    ->get(['id','ordering']);


        return $ordering_slots;                                      
    }

    
    public function api_task_client_new_post(Request $request)
    {
        $res = 'error';

        if($request->isMethod('post'))
        {   

            $highest_order = DB::table('tasks')->max('ordering');
            $higher_id =Input::get('id');
            
            $new_task = new Task;
            $new_task->title = 'New task '.($highest_order + 1);
            $new_task->ordering =  $highest_order + 1;
            $new_task->created_by_user_id = $this->auth_user['id'];
            $new_task->save();
            $newly_task_id = $new_task->id;
            $newly_task_order = $new_task->ordering;

            $client_tasks_orders = $this->client_order_slots();

            $insert_the_newly_created_task = false;
            $inserted = false;

            $next_id = 0;

            foreach($client_tasks_orders as $client_tasks_order) 
            {                             
                
                $ordering = $client_tasks_order->ordering;
                $tid = $client_tasks_order->id;

                if($higher_id == $tid){
                    $insert_the_newly_created_task =  true ;    
                    continue;
                }


               if($insert_the_newly_created_task)
                {

                    $next_id = $tid;
                    $task = Task::find($newly_task_id);
                    $task->ordering = $ordering;   
                    $task->save();
                    $insert_the_newly_created_task = false;
                    $inserted = true;
                    continue;

                }

                if($inserted && ($newly_task_id != $tid) )
                {

                    $task = Task::find($next_id);
                    $task->ordering = $ordering;   
                    $task->save();

                    $next_id = $tid;
                }
            }


            if($next_id > 0 )
            {
                $task = Task::find($next_id);
                $task->ordering = $newly_task_order;
                $task->save();
            }  

             $res = 'success';

        }


        return response()->json(['response' => $res]);
    }      

    public function api_task_new_post(Request $request)
    {

        $res = 'error';

        if($request->isMethod('post'))
        {  
            $id =Input::get('id');
                 
            if($id > 0)
            {
                $highest_order = DB::table('tasks')->max('ordering');

                $higher_id =Input::get('id');
                $higher_task = Task::find($higher_id);
                $higher_task_ordering = $higher_task->ordering;

                $new_task = new Task;
                $new_task->title = 'new task '+($highest_order+1);
                $new_task->ordering =  $highest_order + 1;
                $new_task->created_by_user_id = Auth::user()->id;
                $new_task->save();
                $result = $this->reorder_task($new_task->id ,$higher_task_ordering + 1);
                $res = $result ;
            }
            else
            {
                $new_task = new Task;
                $new_task->title = 'New task 1';
                $new_task->ordering =  1;
                $new_task->created_by_user_id = Auth::user()->id;
                $new_task->save();
                $res = 'success';   
            }
        }

        return response()->json(['response' => $res]);

    }

    public function api_tasks_get(Request $request)
    {
        $sort_by = Input::get('sort_by'); 


        if(Auth::user()->is_admin() )
        {
            if($sort_by  == 'project' )
            {  
                //$tasks = array();
                $pids = array();
                $task_project_ids = Task::groupby('project_id')
                                        ->get(['project_id']);
                $project_ids = Project::orderby('project_name' , 'asc')
                                      ->whereIn('id' ,$task_project_ids)
                                      ->get(['id'])
                                      ->toArray();

                foreach ($project_ids as $project_id){
                    array_push($pids, $project_id['id']);
                }

                $project_ids_ordered = implode(',', $pids);                      
                
                $tasks = Task::with('comments_relation')
                              ->with('media_relation')
                              ->with('timespent_relation')
                              ->with('timespent_total_time')
                              ->with('get_working_user')
                              ->orderByRaw(DB::raw("FIELD(project_id, $project_ids_ordered)"))
                              ->get();

                 
            
            }
            else if($sort_by == 'user')
            {
                $user_group_ids = Task::groupby('assign_user_id')
                                        ->get(['assign_user_id']);
                $user_ids = User::orderby('first_name' , 'asc')
                                ->whereIn('id' , $user_group_ids)
                                ->get(['id']);
                $uids = array();

                foreach ($user_ids as $user_id){
                    array_push($uids, $user_id['id']);
                }

                $user_ids_ordered = implode(',', $uids);  
                $tasks = Task::with('comments_relation')
                             ->with('assigned_user')   
                             ->with('media_relation')
                             ->with('timespent_relation')
                             ->with('timespent_total_time')
                             ->with('get_working_user')
                             ->orderByRaw(DB::raw("FIELD(assign_user_id, $user_ids_ordered)"))
                             ->get();

            }
            else
            {
                $tasks = Task::with('comments_relation')
                                ->with('media_relation')
                                ->with('timespent_relation')
                                ->with('timespent_total_time')
                                ->with('get_working_user')
                                ->orderby('ordering','asc')
                                ->get();

            }
        }
        elseif(Auth::user()->is_developer())
        {

            $tasks = Task::with('comments_relation')
                            ->with('project') 
                            ->with('procedure')   
                            ->with('media_relation')
                            ->with('timespent_relation')
                            ->with('timespent_total_time')
                            ->orderby('ordering','asc')
                            ->where('assign_user_id' , '=' , $this->auth_user['id'])
                            ->whereIn('status_id' , \Config::get('constants.task_status.developer'))
                            ->get();
        }
        elseif(Auth::user()->is_client())
        {
            $project_manage = Manager::where('user_id' , '=' , $this->auth_user['id'])
                                     ->where('manager' , '=' , 1)
                                     ->get(['project_id'])
                                     ->toArray();


            $tasks = Task::with('comments_relation')
                            ->with('media_relation')
                            ->with('timespent_relation')
                            ->with('timespent_total_time')
                            ->with('get_working_user')
                            ->orderby('ordering','asc')
                            ->orWhere('created_by_user_id', '=', $this->auth_user['id'])
                            ->whereIn('status_id' , \Config::get('constants.task_status.client'))
                            ->orWhereIn('project_id' , $project_manage)
                            ->get();
        }
               
        return \Response::make(json_encode($tasks, JSON_PRETTY_PRINT))
                        ->header('Content-Type', "application/json");
    }



    public function client_order_slot()
    {
        $project_manage = Manager::where('user_id' , '=' , $this->auth_user['id'])
                                     ->where('manager' , '=' , 1)
                                     ->get(['project_id'])
                                     ->toArray();

        $ordering_slots = Task::orderby('ordering' ,'asc')
                    ->orWhere('created_by_user_id', '=', $this->auth_user['id'])
                    ->orWhereIn('project_id' , $project_manage)
                    ->whereNull('deleted_at')
                    ->get(['ordering']);

        $os = array();

        $i = 0;
        foreach ($ordering_slots as $slot) 
        {
            $os[$i] = $slot->ordering;
            $i++;
        }

        return $os;                                      
    }

    public function api_tasks_reorder_post(Request $request)
    {
        $tokenized = '';

        $str = '';

        $str1 = '';

        if ($request->isMethod('post'))
        {
            $ordering = Input::get('serialize_tasks');
            
            $token = strtok($ordering,'&');

            $order = 1;



            while($token !== false)
            {
                $tokenized = $token;                
                $task_id = str_replace("task_order=","", $tokenized);

                $task = Task::find($task_id);
                $task->ordering = $order;
                $task->save();
                    
                $token = strtok('&');     
                $order++;
            }

            
        }

        event(new TaskEvent('reorder'));

        return response()->json(['response' =>'****'.$str1]); 
    }

    public function api_tasks_client_reorder(Request $request)
    {
        $tokenized = '';

        $str = '';


        if ($request->isMethod('post'))
        {
            $ordering = Input::get('serialize_tasks');
            
            $token = strtok($ordering,'&');
    
            $ordering_slots = $this->client_order_slot();

            $order = 0;

            while($token !== false)
            {
                $tokenized = $token;

                $task_order = $ordering_slots[$order];
                $task_id = str_replace("task_order=","", $tokenized);
                $task = Task::find($task_id);
                $task->ordering = $task_order;
                $task->save();
                $token = strtok('&');
                $order++;
            }

            
        }

        event(new TaskEvent('reorder'));

        return response()->json(['response' =>'success']); 

    }


    public function reorder_task($id , $new_position)
    {

        $old_position = 0;
        $task = Task::find($id);
        $old_position = $task->ordering;
        
        if($new_position > $old_position)
        {
            DB::table('tasks')
                ->where('ordering', '>', $old_position)
                ->where('ordering' , '<=' , $new_position )
                ->update(['ordering' => DB::raw('ordering-1')]);
        }
        else
        {
             DB::table('tasks')
                ->where('ordering', '<', $old_position)
                ->where('ordering' , '>=' , $new_position )
                ->update(['ordering' => DB::raw('ordering+1')]);
        }

        $task->ordering = $new_position;

        if($task->save())
        {
            $res= 'success';
        }
        else
        {
            $res = 'error';
        }

        return $res;

    }

    public function api_task_delete(Request $request)
    {
        $res = array('status' => 'error');

        if ($request->isMethod('post'))
        {  
            $id =Input::get('id');    
            $task = Task::findOrFail($id);
            $task->delete();
            
            if($task->trashed())
            {
                $res = array('status' => 'success');
            }

        }

        return response()->json(['response' => $res]);
    }


    public function task_lists()
    {
        if(Auth::user()->is_developer())
        {
            $tasks = Task::latest()->get();
            return view('developer_task_lists', compact('tasks'));
        }
        else
        {
            $tasks = Task::latest()->get();
            $task_count = Task::count();
            return view('task_lists', compact('tasks' , 'task_count'));
        }
    }

    

    public function api_tasks_post(Request $request)
    {

        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='tasks';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0)
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,
                                        'updated_at'=>$timestamp 
                                        )
                                );
                

                    if($save)
                    {
                        
                        if($field == 'status_id')
                        {    
                            $this->task_status_email_notification($item_id);
                        }

                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                                );

                        $task = Task::find($item_id);
                        event(new TaskEvent('reorder'));
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                                     'status' => 'fail' 
                                    );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                    
                    $item_id = DB::table($table)    
                                ->insertGetId([$field=>$value,
                                               'created_at'=>$timestamp,
                                               'updated_at'=>$timestamp,
                                             ]);

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                                      );
                        event(new TaskEvent('reorder'));
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'fail' 
                                    );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);

    }

    public function task_next_id()
    {
        $highest_order = DB::table('tasks')->max('ordering');

        $task = new Task;
        $task->title = 'new task';
        $task->ordering =  $highest_order + 1;
        $task->save();
        $next_id = $task->id;
        return response()->json(['next_id' => ($next_id)]);
    }

    public function api_task_statuses_get()
    {
        $statuses = \Config::get('constants.task_status.'.Auth::user()->role());
        
        return response()->json($statuses);
        //return response()->json(\Config::get('constants.task_statuses'));
    }


    //delete after abandoning /tasks page
    public function api_task_reorder(Request $request)
    {
        $tokenized = '';

        if ($request->isMethod('post'))
        {
            $ordering = Input::get('serialize_tasks');
            
            $token = strtok($ordering,'&');

            $order = 1;
            while($token !== false)
            {
                $tokenized = $token;
                $token = strtok('&');
                
                $task = Task::find($tokenized);
                $task->ordering = $order;
                $task->save();
                $order++;
            }

            
        }

        event(new TaskEvent('reorder'));

        return response()->json(['response' =>'success']); 
    }

    
    

    public function save_task(Request $request)
    {

        if ($request->isMethod('post'))
        {   

            $item_id = Input::get('id');
            $table ='tasks';
            $field =Input::get('field');
            $value =Input::get('value');
            $timestamp = Carbon::now();

            if(\Schema::hasColumn($table,$field) &&($field!="photo"))
            {
                if($item_id > 0)
                {
                
                    
                    $save = DB::table($table)
                        ->where('id',$item_id)
                        ->update(array( $field => $value,
                                       'updated_at'=>$timestamp ));
                

                    if($save)
                    {
                        $res = array('id' => $item_id,
                                     'status' => 'success'  
                            );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id ' => $item_id,
                                     'status' => 'fail' 
                                    );
                        return response()->json(['response' => $res]);
                    }
                    
                }
                else
                {
                    
                    $item_id = DB::table($table)    
                                ->insertGetId([$field=>$value,
                                               'created_at'=>$timestamp,
                                               'updated_at'=>$timestamp ]);

                    if($item_id)
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'success'  
                        );
                        return response()->json(['response' => $res]);
                    }
                    else
                    {
                        $res = array('id' => $item_id,
                                 'status' => 'fail' 
                        );
                    }

                }
            }else{
                return response()->json(['response' => "error no field $field"]);
            }

     
        }

        return response()->json(['response' => "error"]);

    }

    public function api_skill_procedure_post(Request $request){
        if ($request->isMethod('post'))
        {   

            $table ='skill_procedure';
            $skill_id =Input::get('skill_id');
            $procedure_id =Input::get('procedure_id');
            $related =Input::get('related');  // 1 yes related , or not ralated


            $count = SkillProcedure::where('skill_id',$skill_id)
                                   ->where('procedure_id',$procedure_id)
                                   ->count();

            if($count > 0 )
            {    

                $save = DB::table($table)
                    ->where('skill_id',$skill_id)
                    ->where('procedure_id',$procedure_id)
                    ->update(array( 'related' => $related));
                
                return response()->json(['response' => "success"]);
             }
             else
             {
                $item_id = DB::table($table)    
                             ->insertGetId(['skill_id'=>$skill_id, 
                                            'procedure_id'=>$procedure_id , 
                                            'related' => $related]);
                    
                if($item_id)
                    return response()->json(['response' => "success"]);
                else
                    return response()->json(['response' => "error"]);
             }       



     
        }

        return response()->json(['response' => "error"]);

    }

    public function api_task_form(){
        $projects = Project::all();
        $procedures = Procedure::all();
        $skills = Skill::all();
        $task_statuses = \Config::get('constants.task_statuses');
        $role = \Config::get('constants.roles.developer');
        $developers = User::where('role_id', '=', $role)->get();
        $tasks = Task::all();

        return view("task_form",compact('tasks', 'projects', 'developers' , 'procedures', 'skills', 'task_statuses'));
    }

    public function tasks()
    {
        $projects = Project::all();
        
        $procedures = Procedure::all();
        $skills = Skill::all();
        $task_statuses = \Config::get('constants.task_statuses');

        $role = \Config::get('constants.roles.developer');
        $developers = User::where('role_id', '=', $role)->get();


        $tasks = DB::table('tasks')->orderby('ordering','asc')->whereNull('deleted_at')->get();

        return view("tasks",compact('tasks', 'projects', 'developers' , 'procedures', 'skills', 'task_statuses'));

    }

    public function api_task_time_get($task_id)
    {

        $timespents = TimeSpent::where('task_id','=', $task_id)
                        ->get();

        $ts = array();
        $total_time_spent = 0;

        foreach ($timespents as $timespent) 
        {
            //Did not include unended time
            if(strtotime($timespent->end_datetime) > 0)
            {

                $start_taskdatetime = new \Datetime($timespent->start_datetime);
                $end_taskdatetime = new \Datetime($timespent->end_datetime);

                $interval = $start_taskdatetime->diff($end_taskdatetime);
                $elapsed = $interval->format(' %h hours %i minutes %S seconds');
                //%y years %m months %a

                array_push( $ts ,array('id' => $timespent->id,
                            'task_id' => $timespent->task_id,
                            'user_id' => $timespent->user_id,
                            'start_datetime' => $timespent->start_datetime,
                            'end_datetime' => $timespent->end_datetime,
                            'spent' => $elapsed,
                            )); 
            }
        
        }    
        
        return response()->json($ts);
    }  


    public function api_auth_currrent_task_get()
    {
        if(Auth::user()->is_developer())
            $time_running =TimeSpent::where('user_id' ,'=', $this->auth_user['id'])
                                    ->whereNull('end_datetime')->first();
        else if(Auth::user()->is_client())
        {
            $project_manage = Manager::where('user_id' , '=' , $this->auth_user['id'])
                         ->where('manager' , '=' , 1)
                         ->get(['project_id'])
                         ->toArray();

            $tasks = Task::with('comments_relation')
                            ->with('media_relation')
                            ->orderby('ordering','asc')
                            ->orWhere('created_by_user_id', '=', $this->auth_user['id'])
                            ->whereIn('status_id' , \Config::get('constants.task_status.client'))
                            ->orWhereIn('project_id' , $project_manage)
                            ->get(['id'])
                            ->toArray();

            $time_running =TimeSpent::with('user')
                                    ->whereIn('task_id' , $tasks)
                                    ->whereNull('end_datetime')->get();
           
        }
        else if(Auth::user()->is_admin())
        {

            $time_running =TimeSpent::with('user')
                                    ->whereNull('end_datetime')->get();
        }

        if($time_running)
        {

            return response()->json($time_running);
        }

        return response()->json(0);

    }

    /*********************************Auth *****************************************************/

    public function send_email_invitation($user_email)
    {
        $user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) 
        {
            $m->from('hello@app.com', 'Your Application');
            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });

    }

    public function showLogin()
    {
        // show the form
        return View::make('auth\login');
    }

    /*********************************Time logged *****************************************************/

    public function report()
    {
        return view('report');
    }

    public function get_date_range($start_date, $end_date, $format = "Y-m-d")
    {
        $begin = new \DateTime($start_date);
        $end = new \DateTime($end_date);

        $interval = new \DateInterval('P1D'); 
        $date_range = new \DatePeriod($begin, $interval, $end);

        $range = [];
        foreach ($date_range as $date) {
            $range[] = $date->format($format);
        }

        return $range;
    }

    public function api_timespent_get(Request $request)
    {

        if ($request->isMethod('get'))
        {   

            $start_date =Input::get('start_date');
            $end_date =Input::get('end_date');
            $company_id =Input::get('company_id');
            $sort_by = Input::get('sort_by');


            if($sort_by == 'user')
            {

                    $user_timespent = array();
                    
                    if($company_id > 0 )
                    {

                        $project_ids = Manager::where('company_id' , '=' , $company_id )
                                            ->get(['project_id']);

                        $task_ids = Task::whereIn('project_id' ,$project_ids)
                                        ->get(['id']);

                        $users =TimeSpent::where('start_datetime' ,'>', $start_date.' 00:00:00')
                                         ->whereIn('task_id' , $task_ids)
                                         ->orWhere('end_datetime' ,'<', $end_date.' 23:59:59.999')
                                         ->groupby('user_id')
                                         ->get(['user_id']);


                    }
                    else
                    {
                        $users =TimeSpent::where('start_datetime' ,'>', $start_date.' 00:00:00')
                                         ->orWhere('end_datetime' ,'<', $end_date.' 23:59:59.999')
                                         ->groupby('user_id')
                                         ->get(['user_id']);
                    }


                    $str = '';

                    $user_total_time = '';
                    $user_total_hour = '';
                    $user_total_minutes = '';

                    foreach($users as $user) 
                    {

                        if($company_id > 0 )
                        {
                            $timespents =TimeSpent::whereDate( 'start_datetime' , '>=' , $start_date.' 00:00:00')
                                                  ->WhereDate( 'end_datetime' ,'<=', $end_date.' 23:59:59.999')
                                                  ->whereIn('task_id' , $task_ids)
                                                  ->where( 'user_id' , '=' , $user->user_id)
                                                  ->get();
                        }
                        else
                        {
                            $timespents =TimeSpent::whereDate( 'start_datetime' , '>=' , $start_date.' 00:00:00')
                                                  ->WhereDate( 'end_datetime' ,'<=', $end_date.' 23:59:59.999')
                                                  ->where( 'user_id' , '=' , $user->user_id)
                                                  ->get(); 

                        }

                        $ts = array();                        
                        $$user_total_hour = 0;
                        $user_total_minutes = 0;

                        foreach($timespents as $timespent) 
                        {
                            if(strtotime($timespent->end_datetime) > 0)
                            {

                                $start_taskdatetime = new \Datetime($timespent->start_datetime);
                                $end_taskdatetime = new \Datetime($timespent->end_datetime);
                                $interval = $start_taskdatetime->diff($end_taskdatetime);
                                $elapsed = $interval->format(' %h hours %i minutes ');

                                $user_total_hour += intval($interval->format('%h'));
                                $user_total_minutes += intval($interval->format('%i'));
                                $task = Task::where('id' , '=' , $timespent->task_id)->first();
                               
                                array_push( $ts ,array('id' => $timespent->id,
                                            'date' => substr($timespent->start_datetime,0,10),
                                            'task_id' => $timespent->task_id,
                                            'task_title' => $task->title,
                                            'project_title' => $task->project->project_name,
                                            'user_id' => $timespent->user_id,
                                            'start_datetime' => $timespent->start_datetime,
                                            'end_datetime' => $timespent->end_datetime,
                                            'spent' => $elapsed,
                                            )); 
                            }

                        }


                        if(count($ts) > 0 )
                        {

                            $task = Task::where('assign_user_id' , '=' , $user->user_id)->first();
                            $ts_user = User::find($user->user_id);

                            array_push($user_timespent , 
                                                array('name' => $ts_user->first_name.' '.$ts_user->last_name,
                                                      'time_spent' => $ts,
                                                      'user_time_spent' => $user_total_hour.' hours '.$user_total_minutes.' minutes ',
                                                      )
                                        );


                        }    


                    }   

                   return \Response::make(json_encode($user_timespent, JSON_PRETTY_PRINT))
                                   ->header('Content-Type', "application/json");  
            }
            else if($sort_by == 'project')
            {
                
                $project_timespent = array();
                if($company_id > 0 )
                {
                    $project_ids = Manager::where('company_id' , '=' , $company_id )
                                          ->get(['project_id']);

                    $task_ids = Task::whereIn('project_id' ,$project_ids)
                                        ->get(['id']);
                }
                else
                {
                    $project_ids = Manager::groupby('project_id')
                                          ->get(['project_id']);   
                }


                $user_total_time = '';
                $user_total_hour = '';
                $user_total_minutes = '';

                foreach($project_ids as $project_id )
                {
                    $project = Project::where('id', '=' ,$project_id->project_id)->first(); 

                    $task_ids = Task::where('project_id','=', $project_id->project_id)
                                    ->get();
                    
                    $ts = array();
                    foreach ($task_ids as $task_id) 
                    {

                        $timespents =TimeSpent::whereDate( 'start_datetime' , '>=' , $start_date.' 00:00:00')
                                              ->WhereDate( 'end_datetime' ,'<=', $end_date.' 23:59:59.999')
                                              ->where('task_id' ,'=', $task_id->id)
                                              ->get();

                        $user_total_time = 0;
                        $user_total_hour = 0;
                        $user_total_minutes = 0;

                        foreach($timespents as $timespent) 
                        {
                            if(strtotime($timespent->end_datetime) > 0)
                            {
                                                  
                                $start_taskdatetime = new \Datetime($timespent->start_datetime);
                                $end_taskdatetime = new \Datetime($timespent->end_datetime);
                                $interval = $start_taskdatetime->diff($end_taskdatetime);
                                $elapsed = $interval->format(' %h hours %i minutes ');

                                $user_total_hour += intval($interval->format('%h'));
                                $user_total_minutes += intval($interval->format('%i'));
                                $user = User::find($timespent->user_id);
                               
                                array_push( $ts ,array('id' => $timespent->id,
                                            'date' => substr($timespent->start_datetime,0,10),
                                            'task_id' => $timespent->task_id,
                                            'task_title' => $task_id->title,
                                            'project_title' => $task_id->project->project_name,
                                            'user' => $user->first_name.' '.$user->last_name,
                                            'start_datetime' => $timespent->start_datetime,
                                            'end_datetime' => $timespent->end_datetime,
                                            'spent' => $elapsed,
                                            ));     
                            }
                        }       
                        
                    }


                    array_push($project_timespent , 
                                                array('project_name' => $project->project_name,
                                                      'time_spent' => $ts,
                                                      'user_time_spent' => $user_total_hour.' hours '.$user_total_minutes.' minutes ',
                                                      )
                                        );


                }



                return \Response::make(json_encode($project_timespent, JSON_PRETTY_PRINT))
                                   ->header('Content-Type', "application/json");  

            }
            else
            {
                $date_range = $this->get_date_range($start_date, $end_date);
                $date_range_timespent = array();

                foreach ($date_range as $dt) 
                {
                   $timespents =TimeSpent::whereDate( 'start_datetime' , '>=' , $dt.' 00:00:00')
                                         ->WhereDate( 'start_datetime' , '<=' , $dt.' 23:59:59.99')
                                         ->get(); 

                    $user_total_time = 0;
                    $user_total_hour = 0;
                    $user_total_minutes = 0;
                    $ts = array();

                    foreach($timespents as $timespent) 
                    {
                        if(strtotime($timespent->end_datetime) > 0)
                        {
                                              
                            $start_taskdatetime = new \Datetime($timespent->start_datetime);
                            $end_taskdatetime = new \Datetime($timespent->end_datetime);
                            $interval = $start_taskdatetime->diff($end_taskdatetime);
                            $elapsed = $interval->format(' %h hours %i minutes ');

                            $user_total_hour += intval($interval->format('%h'));
                            $user_total_minutes += intval($interval->format('%i'));

                            $user = User::find($timespent->user_id);
                            $task = Task::find($timespent->task_id);

                            array_push( $ts ,array('id' => $timespent->id,
                                        'task_title' => $task->title,
                                        'project_title' => $task->project->project_name,
                                        'user' => $user->first_name.' '.$user->last_name,
                                        'start_datetime' => $timespent->start_datetime,
                                        'end_datetime' => $timespent->end_datetime,
                                        'spent' => $elapsed,
                                        ));     
                        }
                    }

                    if(count($ts) > 0)
                    {

                        array_push($date_range_timespent , 
                                                array('date' => $dt,
                                                      'time_spent' => $ts,
                                                      'user_time_spent' => $user_total_hour.' hours '.$user_total_minutes.' minutes ')
                                            );  
                    }
                }


                return \Response::make(json_encode($date_range_timespent, JSON_PRETTY_PRINT))
                                   ->header('Content-Type', "application/json");  
            }

        }
        else
        {
            return 'error';
        }
    }


    public function api_sort_task_get()
    {
        $sort_by = Input::get('sort_by');

        if($sort_by == 'user')
        {

            $user_group = Task::groupby('assign_user_id')
                              ->get();



            $user_task = array();
            $user_details = array();

            foreach($user_group as $user) 
            {
                $tasks_per_user = Task::where('assign_user_id' , '=' , $user->assign_user_id)
                                      ->get()
                                      ->toArray();

                                      
                $user_name = User::find($user->assign_user_id);

                array_push($user_task , 
                           $tasks_per_user);


                array_push($user_details, array('user'=> $user_name->first_name.' '.$user_name->last_name,
                                                'user_task' => $user_task));                    
            }


            return \Response::make(json_encode($user_details, JSON_PRETTY_PRINT))
                                   ->header('Content-Type', "application/json");  


        }
        else if ($sort_by == 'project') 
        {

            $project_group = Task::groupby('project_id')
                                 ->get();

            $project_task = array();
            $project_details = array();

            foreach($project_group as $project) 
            {
                $tasks_per_project = Task::where('project_id' , '=' , $project->project_id)
                                      ->get()
                                      ->toArray();

                array_push($project_task , 
                           $tasks_per_project);


                array_push($project_details, array('project'=> $project->project->project_name,
                                                'project_task' => $project_task));                    
            }

            return \Response::make(json_encode($project_details, JSON_PRETTY_PRINT))
                                   ->header('Content-Type', "application/json");  

        }
        else
        {

        }

        
    }

}
