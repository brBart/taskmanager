<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

use Auth;
use App\User;
use Carbon\Carbon;

use App\Company;
use App\Project;

use DB;

//use Auth\AuthController;
class PublicController extends Controller
{
    //
    public function __construct()
	{

	}
    /********************************Auth*******************************************************/

    public function api_logged_user_get()
    {	
    	
    	if(Auth::check())
    	{
    		$user_id =Auth::user()->id;
    		return response()->json( array('status' => 'success',
    									    'user'	=> User::where('id',$user_id )->first()
    									   )
    								);
	
    	}
    	else
    	{
    		return response()->json( array('status' => 'fail',
    									    'user'	=> 0
    									   )
    								);

    	}
    	
        
    }




    public function login()
    {
        if(Auth::check())
        {          
            return redirect("/tasklists");
        }
        else
        {
            return redirect("/login");
        }
    }

    public function register($role)
    {
        $mode = 'add';
        return view("user_form", compact('mode')); 
    }


    public function api_all_get()
    {

        $companies = Company::all();
        $cities = \Config::get('constants.cities');
        $countries = \Config::get('constants.countries');
        $timezones = \Config::get('constants.timezones');
        $roles = \Config::get('constants.roles');

        $initial_data =array('companies' => $companies,
                             'cities'  => $cities ,
                             'timezones'  => $timezones ,
                             'countries'  => $countries ,
                             'roles'  => $roles );

        return \Response::make(json_encode($initial_data, JSON_PRETTY_PRINT))
                        ->header('Content-Type', "application/json");
    }


    public function api_roles_get(){

        return \Response::make(json_encode(\Config::get('constants.roles'), JSON_PRETTY_PRINT))
                        ->header('Content-Type', "application/json");
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


    public function account_activation($activation_code)
    {
        if(Auth::check())
        {
            Auth::logout();
            \Session::flush();
        }
        
        $activated_user = User::where('activation_code', '=', $activation_code)->first();

        $user  = User::find($activated_user->id);

        if($user)
        {
            return view('create_password' , compact('user') );
        }
        else
        {
            return ' Activation code expired';
        }
    }

    public function create_password(Request $request)
    {


        $id = Input::get('id');
        $password = Input::get('password');
        $first_name = Input::get('first_name');
        $last_name = Input::get('last_name');

        $user = User::find($id);
        $user->password = bcrypt($password); 
        $user->first_name = $first_name;
        $user->last_name = $last_name; 
        
        $user->activated = 1;

        if($user->save())
        {
            if (Auth::attempt(['email' => $user->email, 'password' => $password]))
            {
                return redirect()->intended('tasklists');
            }
            else
            {
                return redirect()->intended('login');
            }
         
        }
        else
        {
            return redirect()->intended('tasklists');
        }
    }


    public function api_countries_get()
    {
        
        return \Config::get('constants.countries');
    }

    public function api_timezones_get()
    {
        
        return \Config::get('constants.timezones');
    }

    public function api_cities_get()
    {
        
        return \Config::get('constants.cities');
    }

  /*   public function send_email(Request $request)
    {   
        $email = Input::get('email');
        
        $check_user = User::where('email' , '=' , $email)->count();

        if($check_user == 0)
        {


            $role_id = Input::get('role_id');
            $activation_code = str_random(20);

            $data =  array('url' => \Config::get('constants.domain'),
                           'activation_code' => $activation_code,
                           'email' => $email,
                           'from' => 'info@cloudology.codes'
                           );


            \Mail::send('emails.account_activation', $data, function($message)
                     {   
                        $message->from('info@cloudology.codes', 'Cloudology');
                        $message->to('send8heremd@gmail.com')->subject('Task Manager Account Activation');
                     });



            if($ok)
            {    
                $user = new User();
                $user->email = $email;
                $user->role_id = $role_id;
                $user->activation_code = $activation_code;
                $user->save();
                if($user)
                {
                    return  response()->json(['response' => "success"]);
                }
                else
                {
                    return  response()->json(['response' => "error"]);
                }
            }
            else
            {
                return  response()->json(['response' => "error"]);
            }
        }
        else
        {
            return  response()->json(['response' => "error"]);
        }
        
    }*/

    public function send_email($email, $role_id)
    {   
        $activation_code = str_random(20);
        $user = new User();
        $user->email = $email;
        $user->role_id = $role_id;
        $user->activation_code = $activation_code;
        $user->save();

        $data =  array('first_name' => 'wat',
                 'last_name' => 'wot',
                 'activation_code' => $user->activation_code,
                 'url' => '/tasklists',
                 'email' => $user->email,
                 'from' => 'info@cloudology.codes'
                 );

        \Mail::send('emails.account_activation', $data, function($message) use ($user)
        {   
            $message->from('info@cloudology.codes', 'Cloudology');
            $message->to($user->email, $user->first_name)->subject('Task Manager Account Activation');
        });

        return '<a href="/account/activation/'.$activation_code.'">click here</a>'; 
        
    }


    public function sample_create_account()
    {
        $activation_code = str_random(20);
        $user = new User();
        $user->first_name = 'Marlon';
        $user->last_name = 'test';
        $user->email = 'okfinebye2014@gmail.com';
        $user->activation_code = $activation_code;
        $user->save();

        $data =  array('first_name' => $user->first_name,
                 'last_name' => $user->last_name,
                 'activation_code' => $user->activation_code,
                 'url' => '/tasklists',
                 'email' => $user->email,
                 'from' => 'info@cloudology.codes'
                 );

        \Mail::send('emails.account_activation', $data, function($message) use ($user)
        {   
            $message->from('info@cloudology.codes', 'Cloudology');
            $message->to($user->email, $user->first_name)->subject('Task Manager Account Activation');
        });

        return '<a href="/account/activation/'.$activation_code.'">click here</a>';
    }

}
