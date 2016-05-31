<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/






Route::get('template', 'PublicController@template');

Route::get('',  'PublicController@login');

Route::get('/register/{role}' , 'PublicController@register');

Route::get('api/all/get', 'PublicController@api_all_get');

Route::get('/api/roles/get', 'PublicController@api_roles_get' );

Route::get('/sample/create/account' , 'PublicController@sample_create_account' );

//Route::get('send/email/', 'PublicController@sample_create_account');

Route::get('/api/countries/get/' , 'PublicController@api_countries_get');

Route::get('/api/timezones/get/' , 'PublicController@api_timezones_get');

Route::get('/api/cities/get/' , 'PublicController@api_cities_get');


Route::group(['middleware' => ['web']], function () {
	Route::get('',  'PublicController@login');

	Route::post('create/password', 'PublicController@create_password');

	Route::get('/account/activation/{activation_code}', 'PublicController@account_activation');

});



Route::group(['middleware' => ['web' , 'admin' ]], function () {
	
	Route::auth();

	Route::get('invite/user', 'AdminController@invite_user');

	Route::get('check/email/{email}', 'AdminController@check_email');

	Route::post('send/email/', 'AdminController@send_email');

	Route::get('sent/email/success/{email}', 'AdminController@sent_email_success');

	
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/api/procedure/{id}/get', 'PagesController@api_procedure_get');
    
    Route::get('api/cities/{country}/get', 'PagesController@api_cities_get');

    Route::get('/test', 'PagesController@test_mail');
	
    Route::get('api/notifications/get','PagesController@api_notifications_get');

    Route::post('api/photo/post','PagesController@api_photo_post');

    Route::get('profile/edit', 'PagesController@edit_profile');

    Route::get('api/auth/user/get', 'PagesController@api_auth_user_get');

    Route::get('dashboard', 'PagesController@dashboard');

	Route::get('tasks', 'PagesController@tasks');

	Route::get('users', 'PagesController@users');

	Route::get('companies', 'PagesController@company');

	Route::get('profile', 'PagesController@profile');

	Route::get('profile/create', 'PagesController@create_profile');

	Route::get('projects', 'PagesController@projects');

	Route::get('project/create', 'PagesController@create_project');

	Route::get('skill/create', 'PagesController@create_skill');

	Route::get('procedure/create', 'PagesController@create_procedure');

	Route::get('team/create', 'PagesController@create_team');

	Route::get('company/create', 'PagesController@create_company');

	Route::get('company/users', 'PagesController@users');

	Route::get('save/data', 'PagesController@save_data');  //delete

	Route::post('save/data', 'PagesController@save_data');

	Route::get('save/project/manager', 'PagesController@save_project_manager');

	Route::post('save/project/manager', 'PagesController@save_project_manager');

	Route::get('company/{mode}/{id}', 'PagesController@company');

	/***********************Procedures*****************************************/

	Route::get('/api/procedures/get' , 'PagesController@api_procedures_get');

	Route::post('api/procedure/post' , 'PagesController@api_procedure_post');

	Route::post('api/skill/procedure/post' , 'PagesController@api_skill_procedure_post');

	Route::get('procedure/{mode}/{id}','PagesController@procedure');

	Route::get('api/skill/procedure/{id}/get','PagesController@api_skill_procedure_get');

	/***********************Skills*****************************************/

	Route::get('/api/skills/get/' , 'PagesController@api_skills_get');

	Route::post('/api/skill/post', 'PagesController@api_skill_post');

	Route::get('skill/{mode}/{id}','PagesController@skill');

	Route::get('save/skill/procedure', 'PagesController@save_skill_procedure');

	Route::post('save/skill/procedure', 'PagesController@save_skill_procedure');

	/***********************Projects**************************************/

	Route::get('api/projects/get','PagesController@api_projects_get');

	Route::get('api/credentials/{project_id}/get','PagesController@api_credentials_get');

	Route::get('api/credential/{credential_id}/get','PagesController@api_credential_get');

	Route::post('api/credential/post' , 'PagesController@api_credential_post');

	Route::post('api/credential/delete/post', 'PagesController@api_credential_delete_post');

	Route::post('api/project/post','PagesController@api_project_post');

	Route::get('project/{mode}/{id}','PagesController@project');

	Route::get('api/project/managing/users/{id}/{role_id}/get','PagesController@api_project_managing_users_get');

	Route::get('api/project/managing/companies/{id}/get','PagesController@api_project_managing_companies_get');

	Route::post('api/project/manager/post','PagesController@api_project_manager_post');

	Route::post('/api/project/delete/post' , 'PagesController@api_project_delete_post');

	Route::post('/api/skill/delete/post' , 'PagesController@api_skill_delete_post');

	Route::post('/api/procedure/delete/post' , 'PagesController@api_procedure_delete_post');

	

	/***********************Company******************************************/
	Route::get('api/companies/get', 'PagesController@api_companies_get');

	Route::post('/api/company/post', 'PagesController@api_company_post');
	
	/***********************Users******************************************/
	Route::get('user/{user}/{mode}/{id}', 'PagesController@user');
	
	Route::get('user/company/create', 'PagesController@user_company');

	Route::get('api/get/{obj}/{role}','PagesController@api_get');

	Route::get('api/users/{role}/get','PagesController@api_users_get');

	Route::post('/api/user/post', 'PagesController@api_user_post');

	Route::post('/api/user/delete/post', 'PagesController@api_user_delete_post');

	Route::post('/api/company/delete/post', 'PagesController@api_company_delete_post');

	//Todo merge all possible links

	Route::get('users', 'PagesController@users');

	Route::get('skills', 'PagesController@skills');

	Route::get('projects', 'PagesController@projects');

	Route::get('companies', 'PagesController@companies');

	Route::get('developers', 'PagesController@developers');

	Route::get('clients', 'PagesController@clients');

	Route::get('procedures', 'PagesController@procedures');


	/***************************Media***************************************/

	Route::get('api/media/{task_id}','PagesController@api_media');

	Route::get('upload/photo', 'PagesController@upload_photo');

	Route::post('upload/photo', 'PagesController@upload_photo');

	Route::post('save/media', 'PagesController@save_media');

	Route::post('api/media/post', 'PagesController@api_media_post');

	Route::get('api/media/{task_id}/get','PagesController@api_media_get');
	/***************************Time logged***************************************/
	
	Route::get('report','PagesController@report');
	
	/***************************Comments***************************************/
	Route::post('save/comment','PagesController@save_comment');  // remove soon

	Route::post('api/comment/post','PagesController@api_comment_post');

	Route::get('api/comments/{task_id}/{offset}/get','PagesController@api_comments_get');

	/**************************Tasks***************************************/

	Route::get('api/taskform','PagesController@api_task_form');

	Route::get('save/task','PagesController@save_task');

	Route::post('save/task','PagesController@save_task');

	Route::get('api/tasks/get','PagesController@api_tasks_get');

	Route::post('api/tasks/post','PagesController@api_tasks_post');

	Route::get('api/tasknextid','PagesController@task_next_id');

	Route::post('api/task/reorder', 'PagesController@api_task_reorder'); //remove after abandonig /tasks

	Route::post('api/tasks/reorder/post', 'PagesController@api_tasks_reorder_post');

	Route::post('api/tasks/client/reorder/post', 'PagesController@api_tasks_client_reorder');

	Route::post('api/task/delete', 'PagesController@api_task_delete');

	Route::get('api/task/statuses/get','PagesController@api_task_statuses_get');

	Route::post('api/task/new/post' , 'PagesController@api_task_new_post');

	Route::post('api/task/client/new/post' , 'PagesController@api_task_client_new_post');

	Route::post('api/task/time/post', 'PagesController@api_task_time_post');

	Route::get('api/task/timespent/{task_id}/get' , 'PagesController@api_task_time_get');

	Route::get('tasklists', 'PagesController@task_lists');

	Route::get('api/auth/current/task/get' , 'PagesController@api_auth_currrent_task_get' );

	Route::get('/report' , 'PagesController@report');

	Route::get('api/timespent/get' , 'PagesController@api_timespent_get');
	
	Route::get('/testmail' , 'PagesController@task_status_email_notification');

	Route::get('/api/sort/task/get' ,'PagesController@api_sort_task_get');

	Route::get('/api/user/notifications/get', 'PagesController@api_user_notifications_get');

	Route::get('/api/user/notifications/count/get', 'PagesController@api_user_notifications_count_get');

	/*************************api*******************************************/
});
/*
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
*/