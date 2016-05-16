<?php

use Illuminate\Support\Facades\Input;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\User;
use Auth;
use DB;


class AdminController extends Controller
{
    //
    public $auth_user = array('id' => '',
                              'email' => '',
                              'first_name' => '',
                              'last_name' => '',
                              'role_id' => '' );


    /*********************************Etc***********************************************/
    public function __construct()
    {

        $this->middleware('admin');
        
        if(Auth::user()->is_admin())
        {
            $this->auth_user['id'] = Auth::user()->id;
            $this->auth_user['email'] = Auth::user()->email;
            $this->auth_user['fist_name'] = Auth::user()->first_name;
            $this->auth_user['last_name'] = Auth::user()->last_name;
            $this->auth_user['role_id'] = Auth::user()->role_id;
        } 
        else
            return response('Unauthorized.', 401);


    }


    public function invite_user()
    {
        return view('admin.invite_user');
    }


    public function check_email($email)
    {
    	$user_count = User::where('email', '=' , $email)->count();

    	return $user_count;
    }


    public function send_email(Request $request)
    {	
    	$email = Input::get('email');
    	
        $check_user = User::where('email' , '=' , $email)->count();

        if($check_user == 0)
        {

            $role_id = Input::get('role_id');
        	$activation_code = str_random(20);

        	$user = new User();
        	$user->email = $email;
        	$user->role_id = $role_id;
        	$user->activation_code = $activation_code;

        	if($user->save())
            {
        		$data =  array('url' => \Config::get('constants.domain'),
                               'activation_code' => $activation_code,
                               'email' => $email,
                               'from' => 'info@cloudology.codes'
                              );
        		  
    	        $ok =\Mail::send('emails.account_activation', $data, function($message) use ($user)
        	         {   
        	            $message->from('info@cloudology.codes', 'Cloudology');
        	            $message->to($user->email)->subject('Task Manager Account Activation');
        	         });

                if($ok)
    	           return  response()->json(['response' => "success"]);
                else
                    return  response()->json(['response' => "error"]);

        	}
        }
        else
        {
            return  response()->json(['response' => "error"]);
        }
    	
    }




    public function sent_email_success($email)
    {

    	return view('sent_email_success', compact('email'));
    }


    /*********************************Skills***********************************************/

    


}
