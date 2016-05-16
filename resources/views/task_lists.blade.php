@extends('layout')

@section('breadcrumbs_title')
    Tasks
@stop


@section('css')
    <style>
    		
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

			
			.widget-news .widget-news-left-elem{
				width: 200px;
			}
			.tm-files-area-body{
				height: 340px;
				overflow-y: auto;
			}
			.tm-timespent-thread{
				font-size: 8px;
			}
			.tm-clock {
				 cursor: pointer; cursor: hand; 
			}

			.tm-drag-and-drop{
				 cursor: -moz-grab; opacity: 0.5;
			}


			.tm-drag-and-drop:hover{
				 cursor: -moz-grab; opacity: 1.0;
			}

			.tm-time-records{
				padding: 0;
			}
			
			#project_id {border-width: 0px;background: none;right:4px;position: relative;
				top:2px;padding:0px !important;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #project_id {border-width: 0px;background: none;right:8px;position: relative;
				top:5px;
			} }		
			
			#status_id   {border-width: 0px;background: none;right:4px;position: relative;
				top:5px;padding:0px !important;font-size:14px;text-transform: uppercase;font-weight: 600;color:green;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #status_id  {border-width: 0px;background: none;right:8px;position: relative;
				top:10px;
			} }	
			
			#skill_id, #procedure_id, #assign_user_id, #estimate_id  {border-width: 0px;background: none;right:4px;position: relative;
				top:5px;padding:0px !important;font-size:14px;font-weight:300;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #skill_id, #procedure_id, #assign_user_id, #estimate_id {border-width: 0px;background: none;right:8px;position: relative;
				top:10px;
			} }	
			
			#estimated_hours, #estimated_minutes  {border-width: 0px;background: none;right:0px;position: relative;
				top:0px;padding:0px !important;font-size:14px;font-weight:300;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #estimated_hours, #estimated_minutes {border-width: 0px;background: none;right:0px;position: relative;
				top:0px;
			} }	

			#title {border-width: 0px;background: none;right:0px;position: relative;
				top:4px;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #title {border-width: 0px;background: none;right:0px;position: relative;
				top:5px;
			} }		

.tm-task-wrapper {border-bottom:1px solid lightgrey;margin-bottom:10px;background:#F1F3FA}

.display-flex {display:flex !important;display: -webkit-flex !important;width:100%}

.flex-grow-1 {flex-grow:1;-webkit-flex-grow:1;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-2 {flex-grow:2;-webkit-flex-grow:2;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-3 {flex-grow:3;-webkit-flex-grow:3;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-4 {flex-grow:4;-webkit-flex-grow:4;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-5 {flex-grow:5;-webkit-flex-grow:5;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-6 {flex-grow:6;-webkit-flex-grow:6;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-7 {flex-grow:7;-webkit-flex-grow:7;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-8 {flex-grow:8;-webkit-flex-grow:8;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-9 {flex-grow:9;-webkit-flex-grow:9;-webkit-flex-basis:0;flex-basis:0;}
.flex-grow-10 {flex-grow:10;-webkit-flex-grow:10;-webkit-flex-basis:0;flex-basis:0;}


.tm-access-details {float:left;position: relative;min-width: 300px;width:25%;max-width: 450px;}

.tm-comments-container {float:left;position: relative;min-width: 300px;width:100%;}

.tm-tinymce-comments-container{float:left;position: relative;min-width: 300px;width:100%;}

.mce-path {display: none !important}

table.mceLayout {width:100% !important;}

.tm-project-status-0,.tm-project-status-border-0{
	color: #732F2F!important;
}
.tm-project-status-1,.tm-project-status-border-1{
	color: #E15B23!important;
}
.tm-project-status-2,.tm-project-status-border-2{
	color: #b88b00!important;
}
.tm-project-status-3,.tm-project-status-border-3{
	color: #00858a!important;
}
.tm-project-status-4,.tm-project-status-border-4{
	color: #196b19!important;
}
.tm-project-status-5,.tm-project-status-border-5{
	color: #2F3F8C!important;
}
.tm-project-status-6,.tm-project-status-border-6{
	color: #633E8E!important;
}

.quick-sidebar-toggler {display: none}

#main-content {padding:0px !important}

    </style>
@stop


@section('content')


<div id="main" class="desk-full pad-30px tm-tasks-main-container">

<!--Create Task Function-->
			
	@if($task_count == 0 )
	<div class="tm-add-new-task desk-full"><button class="btn btn-primary" v-on:click="NewTask(0)" type="button">Create New Task</button ></div>
	@endif						  
			
	<div id="task-id-@{{ task.id }}" class="tm-task-wrapper user-admin row  ui-sortable task-form-@{{ task.id }}" v-for="task in tasks" >
	<div class="desk-full">
	<form id="tasks" name="">
	<input type='hidden' value="@{{ task.id }}" name="task_order" id="task_order">
	
<!--End.. Create Task Function-->
					 
<!--First Container-->

	<div class="tm-first-container desk-5-12 tab-l-full">		
		<div class="tm-controllers-container desk-6-12 tab-l-4-12 mob-p-full pad-r-10px">

<!--DRAG'N'DROP-->
						  
			<div class="tm-drag-and-drop handle tm-fill desk-2-12 align-center pad-t-2px">
			<i class="fa fa-arrows-v tm-task-icon tm-project-status-@{{task.status_id}} font-32px line-36px pad-5px pad-l-10px pad-t-10px">
			</i>
			</div>
					 
<!--PROJECT-->							
					
			<div class="tm-project-container desk-10-12"> 					
				
				<div class="tm-project-field desk-full">	
				<select v-model="task.project_id" v-on:blur="OnSaveTask(task.id , 'project_id', $event )" name="project_id" id="project_id" class="form-control tm-project-status-border-@{{task.status_id}} font-22px pad-b-1px pad-l-0px weight-light" >					
				<option class="pad-5px" v-for="project in projects" v-bind:value="project.id">@{{ project.project_name }}
				</option>
				</select>
				</div>
						 
				<div class="pad-r-5px desk-full">						  
				
					<div class="tm-project-title tm-project-status-@{{task.status_id}} desk-3-12 weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Project
					</div>
						 
					<div class="tm-due-date font-11px desk-9-12 align-right  tm-project-status-border-@{{task.status_id}} border-1px border-solid pad-t-2px" style="border-width: 2px 0px 0px 0px"><span class="weight-normal">Due:</span> Feb 24th @ 11:30am
					</div>						 
			
				</div>
					
			</div>
		</div>

<!--VIEW MORE-->

		<div class="tm-view-more desk-1-12">View More ↓
		</div>
					

<!--TASK-->
					
		<div class="tm-task-container desk-5-12 tab-l-8-12 mob-p-full mob-p-pad-l-30px mob-p-pad-r-15px tab-l-pad-r-20px">   
					  
			<div class="tm-task-field desk-full">
			<input id="title" name="title" type="text" v-on:blur="OnSaveTask(task.id , 'title', $event )" placeholder="Enter task" class="form-control pad-5px  tm-project-status-border-@{{task.status_id}} font-18px pad-b-5px pad-l-0px weight-normal" value="@{{ task.title }}">
			</div>
					 
			<div class="tm-task-title tm-project-status-@{{task.status_id}} desk-3-12 weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Task				
			</div>
					  
			<div class="tm-add-new-task desk-9-12 align-right pad-0px pad-r-5px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">
			<a class="color-green font-11px" v-on:click="NewTask( task.id )" >Create
			</a >
			<span class="color-lightgrey"> | 
			</span>
			<a class="color-red tm-task-delete font-11px" v-on:click="DeleteTask( task.id )" >Delete
			</a>
			<span class="color-lightgrey"> | 
			</span>
			<a class="color-blue font-11px" v-on:click="ShowHideCredentials( task.id,task.project_id ,$event)" href="#">Access
			</a>
			<span class="color-lightgrey"> | 
			</span>
			<a class="color-blue font-11px" v-on:click="ShowHideProcedure( task.id,task.procedure_id ,$event)" href="#">Procedure		
			</a>
			</div>
					  
		</div>
	
	</div>
	
<!--End.. First Container-->

<!--Second Container-->

	<div class="desk-7-12 tab-l-full tab-l-pad-t-10px">

<!--COMMENTS & FILES-->

		<div class="tm-comments-files-container desk-2-16 tab-l-2-16 tab-p-3-16 mob-l-4-16 mob-p-pad-l-15px align-center">  <!--6-->
					  	
			<div class="tm-comments desk-6-12 line-20px pad-l-10px pad-t-10px"> 
			<a href="#" class="tm-show-comments-link tm-project-status-@{{task.status_id}}" v-on:click="ShowHideComments(task.id , $event)">
			<i class="fa fa-comments font-36px mob-p-font-24px ">
			</i>
			<div class="clearfix">
			</div> (@{{ task.comments_relation[0].count | to_int }}) 
			</a>
			</div>
		
			<div class="tm-files desk-6-12 tm-project-status-@{{task.status_id}} line-18px pad-r-10px" style="padding-top:13px;"> 
			<a class="tm-project-status-@{{task.status_id}}" v-on:click="ShowHideMedia(task.id , $event)" href="#">
			<i class="fa fa-cloud-upload font-36px mob-p-font-22px tm-project-status-@{{task.status_id}}"></i><br> (@{{ task.media_relation[0].count | to_int }})  
			</a> 
			</div>
					
		</div>

<!--STATUS-->
					 
		<div class="tm-status-container desk-2-16 tab-l-2-16 mob-l-5-16 mob-l-pad-b-5px pad-r-10px">  
						 
			<div class="tm-status-field desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'status_id', $event )" v-model="task.status_id" class="form-control tm-project-status-@{{task.status_id}}" name="status_id" id="status_id">
			<option class="pad-5px tm-project-status-@{{value}}" v-for="(key , value) in statuses" v-bind:value="value"> @{{ key }} 
			</option> 
			</select>
			</div>
						   
			<div class="tm-status-title desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Status
			</div> 
		
		</div>

<!--SKILL-->
		
		<div class="tm-admin-selects-container desk-2-16 tab-l-2-16 mob-l-7-16  mob-l-pad-b-5px pad-r-10px">  <!--9-->
					   		
			<div class="tm-skill-field  desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'skill_id', $event )" id="skill_id" name="skill_id" class="form-control  tm-project-status-@{{task.status_id}}" v-model="task.skill_id">
			<option class="pad-5px" v-for="skill in skills" v-bind:value="skill.id"> @{{ skill.name }}
			</option> 
			</select>
			</div>
						   
			<div class="tm-skill-title desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Skill
			</div>
		
		</div>

<!--PROCEDURE-->
		
		<div class="tm-procedure-container desk-2-16 tab-l-2-16 mob-l-5-16 mob-p-9-16 mob-l-pad-l-30px pad-r-10px">
					   		
			<div class="tm-procedure-field  desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'procedure_id', $event )" name="procedure_id" id="procedure_id" class="form-control tm-project-status-@{{task.status_id}}" v-model="task.procedure_id">
			<option   class="pad-5px" v-for="procedure in procedures" v-bind:value="procedure.id"> @{{ procedure.title }} 
			</option>
		    </select>
		    </div>
		                    
		    <div class="tm-procedure-title  desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Procedure
		    </div>
		</div>

<!--ASSIGN-->
					 
		<div class="tm-assign-container desk-2-16 tab-l-2-16 mob-l-4-16 mob-p-7-16 mob-p-7-16 pad-r-10px">
						   
			<div class="tm-assign-field">
			<select v-on:blur="OnSaveTask(task.id , 'assign_user_id', $event )"  v-model="task.assign_user_id" class="form-control tm-project-status-@{{task.status_id}}" id="assign_user_id" name="assign_user_id">
			<option  class="pad-5px"  v-for="developer in developers" v-bind:value="developer.id"> @{{ developer.first_name }} @{{ developer.last_name }} 
			</option>
		    </select>
			</div>
		
			<div class="tm-assign-title desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Assign
			</div>
		
		</div>

					
<!--ESTIMATE-->
		
		<div class="tm-estimate-container  desk-2-16 tab-l-2-16 mob-l-3-16 mob-p-8-16 mob-p-pad-l-30px pad-t-15px pad-r-10px">
						
			<div class="tm-estimate-hrs-text desk-6-12 font-16px pad-b-3px"> 
			<input name="estimated_hours" value="@{{ task.estimated_hours }}" v-on:blur="OnSaveTask(task.id , 'estimated_hours', $event )" id="estimated_hours" min="1" max="59" min="1" max="99" class="desk-6-12  tm-project-status-@{{task.status_id}}">
			<span class="font-12px tm-project-status-@{{task.status_id}}"> hrs
			</span>
			</div>
						  
			<div class="tm-estimate-minutes-field desk-6-12 pad-b-3px">
			<input size="2" type="number" name="estimated_minutes" id="estimated_minutes"  value="@{{ task.estimated_minutes }}"  v-on:blur="OnSaveTask(task.id , 'estimated_minutes', $event )" min="1" max="59" class="desk-6-12 tm-project-status-@{{task.status_id}}">
			<span class="font-11px tm-project-status-@{{task.status_id}}"> min
			</span>
			</div>
						
			<div class="clearfix">
			</div>
			
			<div class="tm-estimate-hrs-field pad-r-5px tm-project-status-@{{task.status_id}} desk-7-16 weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid tm-project-status-@{{task.status_id}}" style="border-width: 2px 0px 0px 0px">Estimate
			</div>
			<div class="desk-1-16">&nbsp
			</div>
						 
			<div class="tm-estimate-hrs-field pad-t-5px tm-project-status-@{{task.status_id}} desk-7-16 weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid tm-project-status-@{{task.status_id}}" style="border-width: 2px 0px 0px 0px">
			</div>
			
			<div class="desk-1-16">&nbsp
			</div>
		
		</div>
		
<!--TIMER-->

		<div class="tm-time-record-container desk-4-16 tab-l-4-16 tab-p-3-16 mob-l-4-16 mob-p-8-16 pad-r-10px">   
			
			<div class="tm-clock desk-5-12 tab-l-4-12 align-center tab-l-align-right tab-l-pad-r-10px">
			<i v-if="task.timespent_relation[0].count > 0" style="color:green"  v-on:click="StartEndTaskTime(task.id , $event)" id="timer-icon-@{{ task.id }}" class="fa fa-clock-o tm-task-icon timer-start-end font-36px line-36px" >
			</i>
			<i v-else v-on:click="StartEndTaskTime(task.id , $event)" id="timer-icon-@{{ task.id }}" class="fa fa-clock-o tm-task-icon timer-start-end font-36px line-36px" >
			</i>
			</div>

			<div class="tm-time-records-container desk-7-12 tab-l-8-12">
			<div class="tm-current-record desk-full font-12px weight-normal  tm-project-status-@{{task.status_id}}">@{{ task.timespent_total_time[0].minutes_elapsed | extract_hours  }}
			<span class="font-10px">hrs,
			</span> @{{ task.timespent_total_time[0].minutes_elapsed | extract_minutes  }} 
			<span class="font-10px">min
			</span>
			</div>
						   	
			<div class="tm-time-records desk-full" > 
			<div id="timer">
			</div>
			</div>
		
			<div class="tm-time-records desk-full"> 
			<a v-if="task.timespent_relation[0].count > 0" class=" font-10px tm-tiew-view-records tm-project-status-@{{task.status_id}}"  v-on:click="ShowTimeSpent(task.id, (task.timespent_relation[0].count) , $event )" href="#">Time Records (@{{ task.timespent_relation[0].count | to_int }}) 			</a>
			<a  class="font-10px tm-project-status-@{{task.status_id}}" v-else class="tm-tiew-view-records" href="#">Time Records (@{{ task.timespent_relation[0].count | to_int }}) 
			</a>
			<div class="tm-time-records desk-full" > 
			<div id="timer-@{{ task.id }}">
			</div>
			</div>
			</div>
			</div>
		
		</div>
	</div>

<!--End.. Second Container-->

<!--Task Hide/Show Details-->

	<div class="display-flex pad-b-10px pad-t-10px tracking">

<!--ACCESS-->
				
		<div class="flex-grow-1" v-show="credentialShow[task.id]">
								
			<div class="pad-b-5px tm-access-details " v-for="credential in credentials[task.project_id]">
				<div class="border-light border-3px border-solid pad-10px border-r-none border-t-none border-b-none">					
				
					<div class="weight-bold pad-b-5px font-13px color-555"> @{{ credential.title }} 
					</div>
								
					<div class="pad-b-5px font-13px">
					<span class="weight-normal">URL:
					</span> 
					<a class="font-13px color-blue" href="http://tm.cloudology.codes/login" target="_blank"> @{{ credential.url }} 
					</a>
					</div>
								
					<div class="pad-b-5px font-13px"><span class="weight-normal">User:</span>  @{{ credential.username }} 
					</div>
					
					<div class="pad-b-5px font-13px"><span class="weight-normal">Pass:</span>  @{{ credential.password }} 
					</div>
					<div class="font-11px"><span class="weight-normal">Notes:</span>  @{{ credential.notes }} 
					</div>
								
				</div>
			</div>
							
		</div>

<!--PROCEDURES-->
		
		<div class="tm-task-procedure flex-grow-2 border-light border-3px border-solid pad-10px border-r-none border-t-none border-b-none" v-show="procedureShow[task.id]">
		
			<div class="tm-timespent-thread max-width-340px float-right" id="tm-task-procedure-thread-@{{ task.id }}">
							
				<h3>@{{ this.taskProcedureTitle[task.id] }}
				</h3>
				<div slot="body" v-html=" this.taskProcedureDescription[task.id] ">
				</div>

			</div>
		
		</div>				
							
<!--COMMENTS-->

		<div class="flex-grow-4" v-show="commentShow[task.id]">
			<div id="comment-section-@{{ task.id}}" class="tm-comments-container">
				<div class="tm-comment-thread" id="comment-thread-@{{ task.id}}">

<!--TinyMCE-->
								
					<div class="pad-b-10px desk-6-12 tab-p-full ">			
						<div class="tm-tinymce-comments-container border-light border-3px border-solid border-r-none border-t-none border-b-none pad-l-10px pad-r-40px">
				
							<div class="desk-full font-16px weight-normal pad-b-15px">
							<i class="fa fa-comments font-22px color-grey line-22px">&nbsp
							</i>Post a comment..
							</div> 
														
							<form @submit.prevent="AddNewComment(task.id)"> {!! csrf_field() !!}
							<div class="tm-comment-preview" id="comment-preview" style="word-wrap:break-word;">
							</div>	
							<div class="tm-add-new-task desk-full">
							<textarea rows="20" cols="105" class="tm-comment-area" v-model="newComment[task.id]" id="@{{ task.id }}" name="comment-area">
							</textarea>
							</div>					 		
							<div class="tm-add-new-task desk-full align-right pad-t-5px">
							<button class="btn btn-primary add-comment-btn" data-value="" type="submit">Post 
							<i class="fa fa-comments">
							</i>
							</button >
							</div>						 		
							</form>
			
						</div>
					</div> 
									
<!--Comments List-->
					
					<div class="desk-6-12 tab-p-full ">
						<div v-for="comment in comments[task.id]" id="comment-id-@{{ task.id }}" class="desk-full pad-b-10px"> 
							    			      	
							<div class="tm-comment-header desk-full border-light border-3px border-solid pad-10px border-r-none border-t-none border-b-none"> 
							
								<div class="desk-1-12 pad-r-5px tab-l-2-12">
								<img src="@{{ comment.user.photo }}"/>
								</div>
								<div class="desk-11-12  tab-l-10-12 font-16px weight-normal color-333 pad-b-1px">
								<i class="fa fa-comments font-22px color-grey line-22px">&nbsp
								</i> @{{ comment.user.first_name }}:
								</div> 
								<div class="desk-11-12  tab-l-10-12 font-10px pad-b-3px">@{{ comment.created_at | format_datetime }}
								</div> 
		
							    <div class="pad-l-5px pad-b-10px desk-full">
								<div class="rtm-comment-body desk-full pad-20px" v-html="comment.content">
								</div>
								</div>
							
							</div>
										 		
						</div>	
					</div>	 											 	
						
				</div>
			</div>				 	
		</div>
													
<!--FILES-->
		
		<div class="tm-task-uploads flex-grow-2" v-show="mediaShow[task.id]" style="border:red 1px solid">
			<div class="desk-full max-width-960px float-right pad-20px">
								     	
				<div class="tm-files-area desk-full">
					<div class="tm-files-area-header desk-full border-grey border-solid border-3px pad-l-10px border-t-none border-r-none border-b-none">
							
						<form id="tm-file-upload-form" class="">
						<div class="tm-add-new-task desk-full pad-b-3px">
						<input @change="UploadFile(task.id ,$event)" class="tm-file-upload"  type="file" name="media" id="file-upload-@{{ task.id }}" class="btn btn-primary"/>
						</div>
						<div class="desk-full">
						<div class="border-green border-3px border-solid border-t-none border-l-none border-r-none desk-9-12 align-right pad-3px font-11px">75%
						</div>		 							
						<div class="tm-delete-task desk-full color-red"><div class="font-11px pad-t-3px" data-value="" >Cancel upload
						</div>
						</div>
						</form>
					
					</div>
				</div>
						
				<div class="desk-full pad-t-10px">			
					<div class="tm-files-area-body" id="tm-files-area-body">
						<div v-for="med in media[task.id]" class="widget-news desk-full pad-b-10px desk-full" id="tm-media-id-@{{ task.id }}"> 
							
							<div class="border-grey border-solid border-3px pad-l-10px border-t-none border-r-none border-b-none desk-full">
								<div class="font-12px desk-full">
								<i class="fa fa-file font-32px">
								</i>
								<a href="@{{ med.path }}" @click="showMediaModal = true,ShowMediaInModal( med.path ,med.filesize , med.created_at)" ></i>Uploaded: @{{ med.path | remove_path }}
									</a> 
								</div>
								<div class="font-10px desk-full">Size: @{{ med.created_at }}
								</div> 
								<div class="weight-normal font-10px desk-full"> @{{ med.filesize }} bytes
								</div>
							</div> 
							
						</div> 
					</div>
				</div>	
				
			</div>
		</div>
	</div>
				
<!--TIME LOGS-->
					<div class="tm-task-timer flex-grow-1" v-show="timespentShow[task.id]">
						<div class="tm-timespent-thread desk-full max-width-180px float-right pad-b-10px" id="tm-timespent-thread-@{{ task.id }}">
				   			<div v-for="timespent in timespents[task.id]" class="desk-full pad-b-10px"> 
					   			<div class="font-10px line-12px border-l-3px border-grey border-solid border-t-none border-r-none border-b-none pad-l-10px"> 
					   			
					   			<i class="fa fa-clock-o font-10px"></i>
					   			<span class="weight-normal">TIME</span> : @{{ timespent.spent }} <br>
					   			BEGAN : @{{ timespent.start_datetime | format_datetime }} <br> 
				   				ENDED :  @{{ timespent.end_datetime | format_datetime }}
								
							</div>
							<div class="tm-current-record desk-full weight-normal font-10px line-12px border-l-3px border-grey border-solid border-t-none border-r-none border-b-none pad-l-10px">TOTAL = @{{ task.timespent_total_time[0].minutes_elapsed | extract_hours  }}<span class="font-10px">hrs,</span> @{{ task.timespent_total_time[0].minutes_elapsed | extract_minutes  }} <span class="font-10px">min</span></div>
				   	
				   			</div>
						</div>
					</div>
					<!-- End Timelogs -->


<!--End.. Create Task Function-->	

	</div>
	</div>
	</form>
</div>

@stop	

@section('javascripts')
																																																																		
<script>

tinymce.init({
    selector: "textarea",
    menubar: false,
    setup: function(editor) {
        editor.on('blur', function(e) {
        	vm.newComment[editor.id] = tinyMCE.activeEditor.getContent(); 
        });
    }
});




var mixin = {
	data : function(){
						return {
							currentMedia :{
								photo : '',
								size : '',
								created_at : '',
							},
						
							taskProcedureTitle : [],
							taskProcedureDescription : [],
						}
	},

	ready : function(){
			this.FetchTasks();
			this.FetchProjects();
			this.FetchTaskStatuses();
			this.FetchSkills();
			this.FetchUsers('developer');
			this.FetchProcedures();
			this.FetchAuthUserCurrentTask();
			this.FetchRoles();
	}

}

@if(isset($_GET['referrer'])  && isset($_GET['task']) )
	$(document).ready(function(){

		$('html,body').animate({
		scrollTop: $("#task-id-<?php echo ($_GET['task']); ?>").offset().top},
		'slow');

		$("#task-id-<?php echo ($_GET['task']); ?>").animate({'background-color': '#FAD160'}, 'slow');

		setTimeout( function(){ 
		$("#task-id-<?php echo ($_GET['task']); ?>").animate({'background-color': '#F1F3FA'}, 'slow'); 
		} , 5000 );

	});
@endif


	
</script>

@stop																																																																																																																											