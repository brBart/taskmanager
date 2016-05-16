@extends('layout')

@section('breadcrumbs_title')
    Tasks
@stop


@section('css')
    <style>
    		.tm-task-icon{
    			 font-size: 30px;
    			 margin-top: 10px;
    		}

    		.tm-comments, .tm-files{
    			font-size: 12px;
    		}

    		.tm-tm-fill { 
			    min-height: 100%;
			    height: 100%;
			}
			.tm-comment-thread{
				margin: 20px;
			}

			.tm-comment-header{
				font-size: 11px;
				font-style: italic;
			}

			.tm-comment-body{

			}

			.tm-comment-section{
				display: none;
			}
			.widget-news .widget-news-left-elem{
				width: 200px;
			}
			.tm-files-area-body{
				height: 340px;
				overflow-y: auto;
			}
			.tm-clock{
				 cursor: pointer; cursor: hand; 
			}
			.tm-timespent-thread{
				display: none;
			}
    </style>
@stop


@section('content')
<div class="row tm-tasks-main-container">
    @if(is_null($tasks))
    	<div class="tm-task-wrapper user-admin row">
				<form id="tasks-0" name="tasks-0">
				     
					 <div class="tm-controllers-container col-md-1"> <!--1-->
						  <div class="tm-drag-and-drop  col-md-4 tm-fill"><i class="fa fa-arrows tm-task-icon"></i></div>
						  <div class="tm-add-new-task col-md-4"><button onclick="append_task_form()" class="btn btn-primary" type="button">Add</button ></div>
						  <div class="tm-delete-task col-md-4"><button class="btn btn-danger tm-task-delete" data-value="{{$task->id}}" type="button">Delete</button></div>
						  <div class="tm-due-date col-md-12">Due: Feb 24th @ 11:30am</div>
					 </div>
					 <div class="tm-project-container col-md-2"> <!--3-->
					  <div class="tm-project-title col-md-9	">Project</div>
					  <div class="tm-task-title col-md-3">passwords</div>
					  <div class="tm-project-field col-md-12"><select name="project_id" id="project_id" class="form-control">
					  											<option selected>Select</option>
					  											@foreach($projects as $project)
		                                                        	<option value="{{ $project->id }}"
		                                                        	>{{ $project->project_name }}</option>
		                                                        @endforeach                           
		                                                    </select></div>
					 </div>
					 <div class="tm-task-container col-md-2">   <!--4-->
					  <div class="tm-task-title col-md-12">Task</div>
					  <div class="tm-task-field col-md-12"><input id="title" name="title" type="text" placeholder="Enter task" class="form-control" value=""></div>
					 </div>
					 <div class="tm-comments-files-container col-md-1">  <!--6-->
					  <div class="tm-comments  col-md-8 "> <a href="#" class="tm-show-comments-link" data-value="{{$task->id}}">Comments (0) </a></div>
					  <div class="tm-files col-md-4"> <a href="#">Files (23) </a> </div>
					  <div class="tm-comments-and-files col-md-12">Comments & Files</div>
					 </div>
					 <div class="tm-status-container col-md-1">  <!--7-->
					  <div class="tm-status-title col-md-12">Status</div> 
					  <div class="tm-status-field  col-md-12">
					  		<select class="form-control" name="status_id" id="status_id">
					  		    <option selected>select</option>
						  		    @foreach($task_statuses as $key => $value)
						  		    	<option value="{{$value}}"
						  		    	> {{$key}} </option>
						  		    @endforeach
			                </select>
					  </div>
					 </div>
					 <div class="tm-admin-selects-container  col-md-2	">  <!--9-->
					  <div class="tm-skill-container col-md-4">
					   <div class="tm-skill-title  col-md-12">Skill</div>
					   <div class="tm-skill-field  col-md-12">
					   			<select id="skill_id" name="skill_id" class="form-control">
					   				<option selected>Select</option>
			                       	@foreach($skills as $skill)
			                       		<option value="{{ $skill->id }}"
			                       		> {{ $skill->name}}</option> 	
			                       	@endforeach	
			                    </select>
					   </div>
					  </div>
					  <div class="tm-procedure-container col-md-4">
					   <div class="tm-procedure-title  col-md-12">Procedure</div>
					   <div class="tm-procedure-field  col-md-12">
					   		    <select name="procedure_id" id="procedure_id" class="form-control">
					   		    	<option selected>Select</option>
					   		    	@foreach($procedures as $procedure)
					   		    		<option value="{{ $procedure->id }}"
					   		    		> {{ $procedure->title }}</option>
					   		    	@endforeach
		                    	</select></div>
					  </div>
					  <div class="tm-assign-container col-md-4">
						   <div class="tm-assign-title">Assign</div>
						   <div class="tm-assign-field">
						   		<select class="form-control" id="assign_user_id" name="assign_user_id">
						   			<option selected>Select</option>
			                        @foreach($developers as $developer)
			                        	<option value="{{ $developer->id }}"
			                        	>{{ $developer->first_name }} {{ $developer->last_name }}</option>
			                        @endforeach	
		                    	</select>

						   </div>
					  </div>
					 </div>
					 <div class="tm-estimate-container  col-md-1">  <!--10`-->
					  <div class="tm-estimate-hrs-field  col-md-12">Estimate</div>
					  <div class="tm-estimate-hrs-text col-md-6"> 
					 
					<input name="estimated_hours" value="" id="estimated_hours" min="1" max="59" style="width: 40px;"min="1" max="99" > 
					   hrs</div>
					  <div class="tm-estimate-minutes-field col-md-6"><input size="2" style="width: 40px;" type="number" name="estimated_minutes" id="estimated_minutes"  value="" min="1" max="59"> min.</div>
					 </div>
					 <div class="tm-time-record-container  col-md-2">   <!--2-->
					  <div class="tm-clock col-md-2"><i class="fa fa-clock-o tm-task-icon"></i></div>
					  <div class="tm-time-records-container  col-md-10">
					   <div class="tm-current-record col-md-12">43min - Marlon Dizon</div>
					   <div class="tm-time-records col-md-12"> 
					   		<a class="tm-tiew-view-records" data-value="{{ $task->id }}" href="#">View Time Records (4)</a>
					   		<div class="tm-timespent-thread" id="tm-timespent-thread-{{ $task->id }}">
					   			<span> 2016-03-29 02:54:41 - 2016-03-29 02:27:41 = 00:20:54</span>
					   			<span> 2016-03-29 02:54:41 - 2016-03-29 02:27:41 = 00:20:54</span>
					   			<span> 2016-03-29 02:54:41 - 2016-03-29 02:27:41 = 00:20:54</span>
					   			<span> 2016-03-29 02:54:41 - 2016-03-29 02:27:41 = 00:20:54</span>				
					   		</div>
					   </div>
					  </div>
					 </div>
				</form>
			</div>	
    @else
		@foreach($tasks as $task)
			<div class="tm-task-wrapper user-admin row " id="task-form-{{$task->id}}">
			    <div class="row">
				<form id="tasks" name="tasks-{{$task->id}}">
				     <input type='hidden' value="{{$task->id}}" name="task_order" id="task_order"> 
					 <div class="tm-controllers-container col-md-1"> <!--1-->
						  <div class="tm-drag-and-drop handle col-md-4 tm-fill"><i class="fa fa-arrows tm-task-icon"></i></div>
						  <div class="tm-add-new-task col-md-4"><button onclick="append_task_form({{$task->id}})" class="btn btn-primary" type="button">Add</button ></div>
						  <div class="tm-delete-task col-md-4"><button class="btn btn-danger tm-task-delete" type="button" data-value="{{$task->id}}">Delete</button></div>
						  <div class="tm-due-date col-md-12">Due: Feb 24th @ 11:30am</div>
					 </div>
					 <div class="tm-project-container col-md-2"> <!--3-->
					  <div class="tm-project-title col-md-9	">Project</div>
					  <div class="tm-task-title col-md-3">passwords</div>
					  <div class="tm-project-field col-md-12"><select name="project_id" id="project_id-{{ $task->id }}" class="form-control">
					  											<option selected>Select</option>
					  											@foreach($projects as $project)
		                                                        	<option value="{{ $project->id }}"

		                                                        	@if($project->id == $task->project_id)
		                                                        		selected
		                                                        	@endif	
		                                                        	>{{ $project->project_name }}</option>
		                                                        @endforeach
		                                                        
		                                                    </select></div>
					 </div>
					 <div class="tm-task-container col-md-2">   <!--4-->
					  <div class="tm-task-title col-md-12">Task</div>
					  <div class="tm-task-field col-md-12"><input id="title-{{ $task->id }}" name="title" type="text" placeholder="Enter task" class="form-control" value="{{ $task->title }}"></div>
					 </div>
					 <div class="tm-comments-files-container col-md-1">  <!--6-->
					  <div class="tm-comments  col-md-8 "> <a href="#" class="tm-show-comments-link" data-value="{{$task->id}}">Comments (13) </a></div>
					  <div class="tm-files col-md-4"> <a href="#">Files (23) </a> </div>
					  <div class="tm-comments-and-files col-md-12">Comments & Files</div>
					 </div>
					 <div class="tm-status-container col-md-1">  <!--7-->
					  <div class="tm-status-title col-md-12">Status</div> 
					  <div class="tm-status-field  col-md-12">
					  		<select class="form-control" name="status_id" id="status_id-{{ $task->id }}">
					  		    <option selected>select</option>

						  		    @foreach($task_statuses as $key => $value)
						  		    	<option value="{{$value}}"
						  		    	@if($task->status_id == $value)
						  		    		selected
						  		    	@endif
						  		    	> {{$key}} </option>
						  		    @endforeach
			                </select>

					  </div>
					 </div>
					 <div class="tm-admin-selects-container  col-md-2	">  <!--9-->
					  <div class="tm-skill-container col-md-4">
					   <div class="tm-skill-title  col-md-12">Skill</div>
					   <div class="tm-skill-field  col-md-12">
					   			<select id="skill_id-{{ $task->id }}" name="skill_id" class="form-control">
					   				<option selected>Select</option>
			                       	@foreach($skills as $skill)
			                       		<option value="{{ $skill->id }}"
			                       		@if($skill->id == $task->skill_id )
			                       			selected
			                       		@endif
			                       		> {{ $skill->name}}</option> 	
			                       	@endforeach	
			                    </select>
					   </div>
					  </div>
					  <div class="tm-procedure-container col-md-4">
					   <div class="tm-procedure-title  col-md-12">Procedure</div>
					   <div class="tm-procedure-field  col-md-12">
					   		    <select name="procedure_id" id="procedure_id-{{ $task->id }}" class="form-control">
					   		    	<option selected>Select</option>

					   		    	@foreach($procedures as $procedure)
					   		    		<option value="{{ $procedure->id }}"
					   		    		
					   		    		@if( $procedure->id == $task->procedure_id)
					   		    			selected
					   		    		@endif

					   		    		> {{ $procedure->title }}</option>
					   		    	@endforeach
		                    	</select></div>
					  </div>
					  <div class="tm-assign-container col-md-4">
						   <div class="tm-assign-title">Assign</div>
						   <div class="tm-assign-field">
						   		<select class="form-control" id="assign_user_id-{{ $task->id }}" name="assign_user_id">
						   			<option selected>Select</option>
			                        @foreach($developers as $developer)
			                        	<option value="{{ $developer->id }}"
			                        	@if($developer->id == $task->assign_user_id)
			                        		selected
			                        	@endif
			                        	>{{ $developer->first_name }} {{ $developer->last_name }}</option>
			                        @endforeach	
		                    	</select>

						   </div>
					  </div>
					 </div>
					 <div class="tm-estimate-container  col-md-1">  <!--10`-->
					  <div class="tm-estimate-hrs-field  col-md-12">Estimate</div>
					  <div class="tm-estimate-hrs-text col-md-6"> 
					 
					<input name="estimated_hours" value="{{ $task->estimated_hours }}" id="estimated_hours-{{ $task->id }}" min="1" max="59" style="width: 40px;"min="1" max="99" > 
					   hrs</div>
					  <div class="tm-estimate-minutes-field col-md-6"><input size="2" style="width: 40px;" type="number" name="estimated_minutes" id="estimated_minutes-{{ $task->id }}"  value="{{ $task->estimated_minutes }}" min="1" max="59"> min.</div>
					 </div>
					 <div class="tm-time-record-container  col-md-2">   <!--2-->
					  <div class="tm-clock col-md-2">
					  		<i class="fa fa-clock-o tm-task-icon timer-start-end" id="tm-clock-timer-{{$task->id}}" data-time-spent-value="0" data-value="{{$task->id}}"></i>
					  </div>
					  <div class="tm-time-records-container  col-md-10">
					   <div class="tm-current-record col-md-12">43min - Marlon Dizon</div>
					   <div class="tm-time-records col-md-12" > <div id="timer-{{$task->id}}"></div></div>
					   <div class="tm-time-records col-md-12"> 
					   		<a class="tm-tiew-view-records" data-value="{{ $task->id }}" href="#">View Time Records (4)</a>
					   		<div class="tm-timespent-thread" id="tm-timespent-thread-{{ $task->id }}">
					   				
					   		</div>


					   	</div>

					  </div>
					 </div>
				</form>
				</div>

				<!-- comment area, files, time log -->
				<div class="row tm-comment-section" id="comment-section-{{$task->id}}">

					 <div class="col-md-5">
					 	<div class="tm-comment-thread" id="comment-thread-{{$task->id}}">
					 		
					 	</div>

					 	<div class="tm-comment-preview" id="comment-preview-{{$task->id}}" style="word-wrap:break-word;">
					 		<a href="#" class="tm-view-more-link" data-value="{{$task->id}}">view more</a>
					 	</div>

					 	<div>
					 		<div class="tm-add-new-task col-md-8">
					 			<textarea class="col-md-12 tm-comment-area" id="task-id-{{$task->id}}" name="comment-area"></textarea>
					 		</div>
					 		<div>
					 			<div class="tm-add-new-task col-md-4"><button class="btn btn-primary add-comment-btn" data-value="{{$task->id}}" type="button">Add</button ></div>
					 		</div>


					 	</div>

				     </div>		
				     <div class="col-md-3">

				     	<div class="tm-files-area row">
				     		<div class="tm-files-area-header row">
				     			<form id="tm-file-upload-form-{{$task->id}}">
					     			<div class="tm-add-new-task col-md-4"><input class="tm-file-upload" data-value="{{$task->id}}" type="file" id="media" name="media" class="btn btn-primary"/></div>
							  		<div class="tm-delete-task col-md-4"><button class="btn btn-danger tm-task-delete" data-value="{{$task->id}}" type="button">Cancel upload</button></div>
						  		</form>
				     		</div>

				     		<div class="tm-files-area-body row" id="tm-files-area-body-{{$task->id}}">
				     			
				     		</div>

				        </div>		
				     </div>
				     <div class="col-md-3">
				     	 time log
				     </div>
				</div>
				<!-- end comment area -->

			</div>
		@endforeach
	@endif
</div>
@stop	


@section('javascripts')

<script>

    var socket = io('http://127.0.0.1:3000');
    //var socket = io('http://192.168.10.10:3000');
    socket.on("comment-channel:App\\Events\\CommentEvent", function(message){
        // increase the power everytime we load test route
        //$('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        var comment_id = message.data.id;
        // alert(comment_id);
        var content = message.data.content;
        var comment_task_id = message.data.task_id;
       
		var created_at = message.data.created_at.date;
		var user = message.data.user;
		var new_comment = '<div id="comment-id-'+comment_id+'" style="margin:5px;"> '+
      '<div class="row tm-comment-header"> <span style="float:left;">'+user+ '</span> <span style="float:right;">'+created_at+' </span>    </div>'+	
	  '<div class="row tm-comment-body">'+content+'</div></div>';
		$('#comment-section-'+comment_task_id+' #comment-thread-'+comment_task_id).append(new_comment);

		//$("textarea#task-id-"+comment_task_id).val('');
		//$("textarea#task-id-"+comment_task_id).html('');
    });

    var item_id = 0, task_id = 0; 
    var task = '';
    var new_task = 0;
    var comment = '';
    var comment_task_id  =0;
    var offset = [];
    var user_id = 1;

 
    $(window).load(function() {

    	$(document).on('focusout', 'textarea.tm-comment-area',function(){
    		var comment = $(this).val();
    		var id = $(this).attr("id");
    		var task_id = id.replace('task-id-',''); 
    	});

    	$(document).on('click', '.tm-show-comments-link', function(){
    		var task_id = $(this).attr('data-value');
    		
    		if($('#comment-section-'+task_id).css('display') == 'none'){
    			$('#comment-section-'+task_id).css('display', 'block');
    			get_comment(task_id);
    			get_media(task_id);
    		}else{
    			$('#comment-section-'+task_id).css('display', 'none');
    		}
    	});

    	$(document).on('click', '.tm-view-more-link', function(e){
    		e.preventDefault();
    		get_comment($(this).attr('data-value'));
    		
    	});


	    $(document).on('focusout',' input, select',function() {
	         

		       var field = $(this).attr('name');
		       var $form = $('input[name="'+field+'"] ,select[name="'+field+'"] ,textarea[name="'+field+'"]').closest("form");

		       task = $form.attr('name');

		       var field_id= $(this).attr('id');
		       var value = $('#'+field_id).val();
		       var task_id = 0;

		       item_id  = field_id.replace(field+'-',"");	


		       if((typeof value !== 'undefined') && ( value.length >= 1)){
		            var url = "/save/task";
		            $.ajaxSetup({
		              headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		              }
		            });

		            $(".saving-"+field).css('display','block'); 
		            $.ajax({
		                type: "POST",
		                url: url,
		                data: {'id':item_id, 'field' : field , 'value' : value},
		                cache: false,
		                success: function(data){
		                    if(data["response"]["status"] == 'success'){
		                        item_id = data["response"]["id"];
		                        task_id = item_id;

		                        if(task == "tasks-0" || new_task == 1){

		                        	$(".tm-task-wrapper form#tasks-0 :input").each(function(){

		                        		var input_name =  $(this).attr("name");

		                        		if(typeof input_name !== 'undefined'){

										  	var input_name =  $(this).attr("name");
										  	$(this).attr("id" ,input_name+"-"+task_id);
										}  	
									});

									$("[name='tasks-0']").attr("name" ,"tasks-"+task_id);
									new_task = 0;
								}
		                        	
		                        $(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
		                        $(".saving-"+field).delay(2000).fadeIn('slow');
		                        $(".saving-"+field).delay(2000).fadeOut('slow');

		                    }else{
		                        $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
		                
		                    }
		                   return data;
		                }
		            }).error(function(data){
		                $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
		            });
		        }else{
		            $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
		        }
	    });
	});


function get_comment(task_id){
	if(typeof offset[task_id] === 'undefined'){
		offset[task_id] = 0;
	}else{
		offset[task_id] = offset[task_id] + 5;
	}

	$.get('/api/comments/'+task_id+'/'+offset[task_id], function(data){
		$.each(data, function(i, item) {
		    var new_comment = '<div id="comment-id-'+data[i].id+'" style="margin:5px;"> '+
		    			      '<div class="row tm-comment-header"> <span style="float:left;">'+data[i].user.first_name+ '</span> <span style="float:right;">'+data[i].user.created_at+' </span>    </div>'+	
		                	  '<div class="row tm-comment-body">'+data[i].content+'</div></div>';
    		$('#comment-section-'+task_id+' #comment-thread-'+task_id).append(new_comment);

		});
	});
}


function get_media(task_id){

	$.get('/api/media/'+task_id, function(data){
		$.each(data, function(i, item) {
		    var media_id = data[i].id;
            var img = data[i].path;
            var filesize = data[i].filesize;
            var path = data[i].path;
            var created_at = data[i].created_at;

            var content = '<div class="widget-news margin-bottom-20" id="tm-media-id-'+media_id+'"> '+
                          ' <img alt="" src="'+img+'" class="widget-news-left-elem"> '+
                          '      <div class="widget-news-right-body"> '+
                          '              <span class="label label-default"> '+created_at+' </span> '+
                          '          <p>'+filesize+' bytes</p> '+
                          '      </div> '+
                          '  </div> ';

            $('#tm-files-area-body-'+task_id).append(content);
		});
	});
}

function append_task_form(task_id){
	var next_id = 0;
	$.get("/api/tasknextid", function(data){
		next_id = data['next_id'];
		$.get( "/api/taskform" )
		  .done(function( form ) {
		  	form = form.replaceAll("task_id",next_id);
		     $( ".tm-tasks-main-container").append(form);
		     	item_id = 0;
		     	new_task = 1;
		   });
	});	
}


$(function() {
    $('#photo').change(function(){
        $('#preview').css('background-image', 'url("/assets/apps/img/photos/loading_spinner.gif")');
        var form_data = new FormData(file);
        form_data.append('id',item_id);
        form_data.append('table',table);

        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE) {
                var obj = jQuery.parseJSON(request.responseText);
                if(obj['response']['status'] == "success"){
                    var img = obj['response']['path'];
                    $('#preview').css('background-image', 'url("' + img + '")');
                }else{

                }
            }
        }
        request.open('post', '/upload/photo/', true);
        request.send(form_data);
    });
});


$(function() {
  $('.tm-tasks-main-container').sortable({
    placeholderClass: 'tm-task-wrapper',
    handle: '.handle',
    update: function(evt, ui) {
    	var serialize_tasks = $('.tm-tasks-main-container').find("input[type='hidden']").serialize();
        serialize_tasks = serialize_tasks.replaceAll("task_order=","");
	    $.ajax({
        	type: "POST",
        	url: '/api/task/reorder',
        	data: {'serialize_tasks' : serialize_tasks},
        	cache: false,
        	success: function(data){
        		console.log(data['response']);
        	}
        });
    }
  });
});

$(function() {
	$(document).on('click','.tm-task-delete',function(){
		var task_id = $(this).attr('data-value');
		var r = confirm("Are you sure?");
		if (r){																						
    		$.ajax({
    			type: "POST",
                url: '/api/task/delete/',
                data: {'id':task_id},
                cache: false,
                success: function(data){
                	var new_comment = '';
                	if(data['response']['status'] == 'success'){
                		$('#task-form-'+task_id).remove();
                	}else{
                		alert('Error deleting');
                	}
                }
    		});
	    }
	});
});

	
$(function() {
	$(document).on('click','.tm-tiew-view-records',function(){
		var task_id = $(this).attr("data-value");
		$.get('/api/task/timespent/'+task_id+'/get', function(data){
			$("#tm-timespent-thread-"+task_id).css('display' , 'block');
			$.each(data['timespent'], function(i, item) {
		    	/*var ts = '<p> Started : '+data['timespent']['start_datetime']+' <br> Ended : '+data['timespent']['end_datetime']+' <br> '+ 
		    	' Spent  : '+data['timespent']['spent']+'</p>';*/
		    	alert(data['timespent']['spent']);
		    	//$( "#tm-timespent-thread-"+task_id).append(ts);
			});
		});
	    
	});
});



$(function() {
	$(document).on('click','.add-comment-btn',function(){
		var comment_task_id = $(this).attr("data-value");
		var content = $("textarea#task-id-"+comment_task_id).val();

		if(content != ''){																						
    		$.ajax({
    			type: "POST",
                url: '/save/comment',
                data: {'task_id':comment_task_id , 'content' : content , 'user_id' : 1},
                cache: false,
                success: function(data){
                	var new_comment = '';
                	if(data['response']['status'] == 'success'){
                		$("textarea#task-id-"+comment_task_id).val('');
                		$("textarea#task-id-"+comment_task_id).html('');
                	}else{
                		new_comment = '<div id="comment-id-'+comment_id+'"> '+
            	   					  ''+comment+''			
            						  '</div>'; 
            			$('#comment-preview-'+comment_task_id).html(new_comment);
                	}
                }
    		});
	    }
	});
});

$(function(){


	
    var request = new XMLHttpRequest();

    $(document).on('change','.tm-file-upload',function(){
        $('#preview').css('background-image', 'url("/assets/apps/img/photos/loading_spinner.gif")');
        var task_id = $(this).attr('data-value');

        
        var file = document.querySelector("form#tm-file-upload-form-"+task_id);

        var form_data = new FormData(file);
        form_data.append('task_id',task_id);
        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE) {
                var obj = jQuery.parseJSON(request.responseText);
                if(obj['status'] == "success"){
                	var media_id = obj['id'];
                    var img = obj['path'];
                    var filesize = obj['filesize'];
                    var path = obj['path'];
                    var created_at = obj['created_at']['date'];

                    var content = '<div class="widget-news margin-bottom-20" id="tm-media-id-'+media_id+'"> '+
                                  ' <img alt="" src="'+img+'" class="widget-news-left-elem"> '+
                                  '      <div class="widget-news-right-body"> '+
                                  '              <span class="label label-default"> '+created_at+' </span> '+
                                  '          <p>'+filesize+' bytes</p> '+
                                  '      </div> '+
                                  '  </div> ';

                    $('#tm-files-area-body-'+task_id).append(content);

                }else{

                }
            }
        }
        request.open('post', '/save/media/', true);
        request.send(form_data);
    });

});





$(function(){
    $(document).on('click','.timer-start-end',function(){
       	var task_id = $(this).attr('data-value');
       	var ts_id = $(this).attr('data-time-spent-value');
       	$.ajax({
    			type: "POST",
                url: '/api/task/time/post',
                data: {'task_id': task_id , 'user_id' : 1 , 'ts_id' : ts_id},
                cache: false,
                success: function(data){
        
 		          	if(data['status'] === 'success' && data['mode'] === 'close'){
                		$('#tm-clock-timer-'+task_id).css('color', 'black');
                		$('#tm-clock-timer-'+task_id).attr('data-time-spent-value',0);
       					$('#timer-'+task_id).html('');
                	}else if(data['status'] === 'success' && data['mode'] === 'open'){
                		$('#tm-clock-timer-'+task_id).css('color', 'green');
                		$('#tm-clock-timer-'+task_id).attr('data-time-spent-value', data['id'] );
       					$('#timer-'+task_id).countup();
                	}
                
               }
        });	
    });
});




function isNumber(obj) { 
	return !isNaN(parseFloat(obj)) 
}

String.prototype.replaceAll = function(str1, str2, ignore) {
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
} 





</script>

@stop																																																																																																																											