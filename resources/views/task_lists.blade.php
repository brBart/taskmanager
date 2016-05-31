@extends('layout')

@section('breadcrumbs_title')
    Tasks
@stop


@section('css')
    <style>	
			.tm-clock {
				 cursor: pointer; cursor: hand; 
			}

			.tm-drag-and-drop{
				 opacity: 0.5;
			}

			.tm-drag-and-drop:hover{
				cursor: move;
				cursor: -webkit-grab;
				cursor: -moz-grab; 
				opacity: 1.0;
			}
					
			#project_id {
				border-width: 0px;
				background: none;
				right:4px;
				position: relative;
				top:2px;
				padding:0px !important;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #project_id {
				border-width: 0px;
				background: none;
				right:8px;
				position: relative;
				top:5px;
			} }		
			
			#status_id   {
				border-width: 0px;
				background: none;
				right:4px;
				position: relative;
				top:5px;
				padding:0px !important;
				text-transform: uppercase;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #status_id  {
				border-width: 0px;
				background: none;
				right:8px;
				position: relative;
				top:10px;
			} }	
			
			#skill_id, #procedure_id, #assign_user_id, #estimate_id  {
				border-width: 0px;
				background: none;
				right:4px;
				position: relative;
				top:5px;
				padding:0px !important;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #skill_id, #procedure_id, #assign_user_id, #estimate_id {
				border-width: 0px;
				background: none;
				right:8px;
				position: relative;
				top:10px;
			} }	
			
			#estimated_hours, #estimated_minutes  {
				border-width: 0px;
				background: none;
				right:0px;
				position: relative;
				top:0px;
				padding:0px !important;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #estimated_hours, #estimated_minutes {
				border-width: 0px;
				background: none;
				right:0px;
				position: relative;
				top:0px;
			} }	

			#title {
				border-width: 0px;
				background: none;
				right:0px;
				position: relative;
				top:4px;
			}
			
			@media all and (-webkit-min-device-pixel-ratio:0) and (min-resolution: .001dpcm) { #title {
				border-width: 0px;
				background: none;
				right:0px;
				position: relative;
				top:5px;
			} }	
.tm-task-saving{
	position: absolute;
	top : 0px;
	right: 0px;
}	

.tm-task-wrapper {
	border-bottom:1px solid lightgrey;
	padding-bottom:10px;
	background:#F1F3FA}

.tm-access-details {
	float:left;
	position: relative;
	width:25%;
	max-width: 450px;
	}

.tm-comments-container {
	float:left;
	position: relative;
	width:100%;
	}

.tm-tinymce-comments-container {
	float:left;
	position: relative;
	width:100%;
	}

.mce-path {
	display: none !important
	}

table.mceLayout {
	width:100% !important;
	}

.tm-project-status-0,.tm-project-status-border-0, .tm-project-status-filter-0{
	color: #732F2F!important;
	}
.tm-project-status-1,.tm-project-status-border-1,.tm-project-status-filter-1{
	color: #E15B23!important;
}
.tm-project-status-2,.tm-project-status-border-2,.tm-project-status-filter-2{
	color: #b88b00!important;
}
.tm-project-status-3,.tm-project-status-border-3,.tm-project-status-filter-3{
	color: #00858a!important;
}
.tm-project-status-4,.tm-project-status-border-4,.tm-project-status-filter-4{
	color: #196b19!important;
}
.tm-project-status-5,.tm-project-status-border-5,.tm-project-status-filter-5{
	color: #2F3F8C!important;
}
.tm-project-status-6,.tm-project-status-border-6,.tm-project-status-filter-6{
	color: #633E8E!important;
}

.quick-sidebar-toggler {display: none}

#main-content {padding:0px !important}

.page-container {padding-top:48px !important;}

.track-red {border:1px dashed red}
.track-orange {border:1px dashed orange}
.track-gold {border:1px dashed gold}
.track-green {border:1px dashed green}
.track-aqua {border:1px dashed aqua}
.track-blue {border:1px dashed blue}
.track-purple {border:1px dashed purple}
.track-black {border:1px dashed black}
.track-white {border:1px dashed white}
.track-grey {border:1px dashed grey}

.tm-filter-by {
	border-bottom:1px solid #EBECED;
	box-shadow: 0px 0px 1px lightgrey inset;
	background: #f7f7f7;
	}

.page-container-bg-solid, .page-header {
	background:white !important;
	}

.menu-trigger {background: #f7f7f7 !important}

.tm-task-listing {background:white;}

.tm-task-listing:hover {background: #f7f7f7;box-shadow: 0px 8px 8px #c9c9c9}

.tm-comment-thread {padding: 0px !important;margin:0px !important}




 .countDays, .countDiv0, .countDiv2 {
	display: none
}

.countdownHolder {text-align: left;padding:0px !important;}

.countDiv1 {top:-3px;font-size:12px; }

.digit, .countDiv1  {
	text-align: left !important;
	margin-right:6px !important;
		}

.countdownHolder {max-height: 16px}

.countSeconds {font-size:7px; padding-left:3px;}

.tm-assign-container-sorted{display: none;}

#status_id {background-color:white !important;box-shadow:1px 1px 2px lightgrey;font-size:12px;top:-0px !important;}

.sort-by-selected {color:black !important}
   
   
    </style>
@stop


@section('content')


<div id="main" class="desk-full tm-tasks-main-container">

<!--filter by..-->

	<div class="tm-filter-by desk-full pad-15px" >
					
		<div class="desk-6-12">
		
		<span class="weight-bold font-12px pad-r-10px">filter by.. </span>
		
		<span class="pad-r-10px color-777 clickable sort-by-date sort-by-selected" v-on:click="SortTask('date')">
		<i class="fa fa-clock-o tm-task-icon" >
		</i>
		Due Date
		</span>	

		<span class="pad-r-10px  color-777 clickable sort-by-project"  v-on:click="SortTask('project')">
		<i class="fa fa-pencil-square-o tm-task-icon " ></i>
		Projects
		</span>	

		 <span class="pad-r-10px  color-777 clickable sort-by-user"  v-on:click="SortTask('user')">
		 <i class="fa fa-user tm-task-icon " ></i>
		 Assigned
		 </span>	

		 <br class="desk-hide mob-p-show">

		<span class="weight-bold font-12px pad-r-10px">and status.. </span>

		 <span  class="pad-r-10px">
		 	<select v-on:change="FilterTask( $event)" v-model="task.status_id" class="tm-project-status-header-@{{task.status_id}}" name="status_id" id="status_id">
				<option class="pad-5px weight-normal" value="7" selected> All </option> 
				<option class="pad-5px tm-project-status-filter-@{{value}}" v-for="(key , value) in statuses" v-bind:value="value"> @{{ key }} 
				</option> 
			</select>
		 </span>	

		</div>

<div class="desk-6-12  pad-t-5px align-right">
		
		<span class="weight-bold font-11px pad-r-10px">view as.. </span>
		
		<span class="pad-r-5px font-13px">
		LARGE
		</span>	

		<span class="pad-r-5px font-12px">
		Small
		</span>	

		<span class="pad-r-5px font-11px">
		compact
		</span>	

		</div>


		


		


	</div>

<!--Create Task Function-->
			
	@if($task_count == 0 )
	<div class="tm-add-new-task desk-full"><button class="btn btn-primary" v-on:click="NewTask(0)" type="button">Create New Task</button ></div>
	@endif						  
			
	<div id="task-id-@{{ task.id }}" class="tm-project-status-@{{task.status_id}} tm-task-listing pad-t-15px mob-l-pad-t-0px user-admin desk-full ui-sortable task-form-@{{ task.id }}" v-for="task in tasks">
	 <a name="task-id-@{{ task.id }}"></a> 
	
	<div class="desk-full">
	
	<input type='hidden' value="@{{ task.id }}" name="task_order" id="task_order">
	
<!--End.. Create Task Function-->
					 
<!--First Container-->

	<div class="desk-5-12 tab-l-full mob-l-pad-t-5px">		
		<div class="desk-6-12 tab-l-4-12 mob-p-full tm-project-drag tm-project-drag-@{{ task.project_id }}-@{{ task.id }}">

<!--DRAG'N'DROP-->
					  
			<div class="tm-drag-and-drop handle tm-fill desk-2-12 align-center pad-t-10px font-24px line-40px">
			<i class="fa fa-arrows-v tm-task-icon tm-project-status-@{{task.status_id}} ">
			</i>
			</div>

		<!-- Assigned user-->
			<div class="tm-assign-container-sorted tm-assign-container-sorted-@{{ task.id }}-@{{ task.assign_user_id }}  mob-p-8-16 mob-l-pad-l-0px mob-p-pad-l-0px pad-r-10px">
			
			<div class="dropdown-user-inner">
                <img width="50px" height="50px" src="@{{ task.assigned_user.photo }}" alt=""> 
            </div>

			<div class="tm-assign-field desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'assign_user_id', $event )" class="form-control tm-select-assigned-user tm-project-status-@{{task.status_id}}" id="assign_user_id" name="assign_user_id" v-model="task.assign_user_id" >
			<option  class="pad-5px tm-select-asssign-user"  v-for="developer in developers" v-bind:value="developer.id"> @{{ developer.first_name }} @{{ developer.last_name }} 
			</option>
		    </select>
			</div>

			</div>
		<!-- end assigned user-->

					 
<!--PROJECT-->							
					
			<div class="tm-project-container tm-filter-by-date-selected desk-10-12 pad-r-15px mob-l-pad-r-0px mob-p-pad-r-10px">				
			
				<div class="tm-project-field desk-full">	
				<select v-model="task.project_id" v-on:blur="OnSaveTask(task.id , 'project_id', $event )" name="project_id" id="project_id" class="form-control tm-project-status-border-@{{task.status_id}} font-18px pad-b-1px pad-l-0px weight-light tm-select-project" >					
				<option class="pad-5px" v-for="project in projects" v-bind:value="project.id">@{{ project.project_name }}
				</option>
				</select>

				<div class="form_control_1 tm-task-saving saving-project_id-@{{ task.id }}"></div>  
				</div>
						 
				<div class="pad-r-5px desk-full tm-project-details">						  
				
					<div class="tm-project-title tm-project-status-@{{task.status_id}} desk-3-12 weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Project
					</div>
						 
					<div class="tm-due-date font-11px desk-9-12 align-right  tm-project-status-border-@{{task.status_id}} border-1px border-solid pad-t-2px" style="border-width: 2px 0px 0px 0px"><span class="weight-normal">Task due:</span><span> Feb 24th </span><span class="mob-l-hide mob-p-show">@ 11:30am</span>
					</div>						 
			
				</div>
					
			</div>
		</div>

	<!--VIEW MORE-->
		
		<div class="tm-view-more mob-l-1-12 mob-p-2-12 pad-b-5px pad-t-10px align-center desk-hide mob-l-show">		
		<a href="#">
		<span v-on:click="ShowHodeTaskDetails(task.id,$event)" class="font-12px line-16px" href="#"><span class="tm-view-hide-details">View</span><br>Details<br>↓</span>
		</a>
		</div>		


<!--TASK-->
					
		<div class="tm-task-container desk-6-12 tab-l-8-12 mob-l-7-12 mob-p-10-12 tab-l-pad-r-15px mob-l-pad-l-5px mob-p-pad-l-0px ">   
					  
			<div class="tm-task-field desk-full">
			<input id="title" name="title" type="text" v-on:blur="OnSaveTask(task.id , 'title' , $event )" placeholder="Enter task" class="form-control pad-5px  tm-project-status-border-@{{task.status_id}} font-16px pad-b-5px pad-l-0px weight-normal" value="@{{ task.title }}">
			
			<div class="form_control_1 tm-task-saving saving-title-@{{ task.id }}"></div>  
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
			<a class="font-11px" v-on:click="ShowHideCredentials( task.id,task.project_id ,$event)" href="#">Access
			</a>
			<span class="color-lightgrey"> | 
			</span>
			<a class="font-11px" v-on:click="ShowHideProcedure( task.id,task.procedure_id ,$event)" href="#">Procedure		
			</a>
			</div>
					  
		</div>
	
	
	</div>
	
	
<!--End.. First Container-->

<!--Second Container-->

	<div id="tm-more-details-container-@{{task.id}}" class="tm-2nd-container desk-7-12 tab-l-full tab-l-pad-t-10px mob-l-pad-t-0px mob-l-hide">

<!--COMMENTS & FILES-->

		<div class="tm-comments-files-container desk-2-16 tab-l-2-16 tab-p-3-16 mob-l-4-16 align-center mob-l-pad-l-10px mob-p-pad-l-5px ">  <!--6-->
					  	
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
			<select v-on:blur="OnSaveTask(task.id , 'status_id', $event )" v-model="task.status_id" class="weight-bold font-14px form-control tm-project-status-@{{task.status_id}}" name="status_id" id="status_id">
			<option class="pad-5px tm-project-status-@{{value}}" v-for="(key , value) in statuses" v-bind:value="value"> @{{ key }} 
			</option> 
			</select>
			</div>
						   
			<div class="tm-status-title desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Status
			</div> 
			
			<div class="form_control_1 tm-task-saving saving-status_id-@{{ task.id }}"></div> 
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
			
			<div class="form_control_1 tm-task-saving saving-skill_id-@{{ task.id }}"></div> 
		</div>

<!--PROCEDURE-->
		
		<div class="tm-procedure-container desk-2-16 tab-l-2-16 mob-l-5-16 mob-p-8-16 mob-l-pad-l-40px mob-p-pad-l-20px pad-r-10px">
					   		
			<div class="tm-procedure-field  desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'procedure_id', $event )" name="procedure_id" id="procedure_id" class="form-control tm-project-status-@{{task.status_id}}" v-model="task.procedure_id">
			<option   class="pad-5px" v-for="procedure in procedures" v-bind:value="procedure.id"> @{{ procedure.title }} 
			</option>
		    </select>
		    </div>
		                    
		    <div class="tm-procedure-title  desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid " style="border-width: 2px 0px 0px 0px">Procedure
		    </div>
			<div class="form_control_1 tm-task-saving saving-procedure_id-@{{ task.id }}"></div> 
		</div>

<!--ASSIGN-->
					 
		<div class="tm-assign-container desk-2-16 tab-l-2-16 mob-l-4-16 mob-p-8-16 mob-l-pad-l-0px mob-p-pad-l-0px pad-r-10px">
						   
			<div class="tm-assign-field desk-full">
			<select v-on:blur="OnSaveTask(task.id , 'assign_user_id', $event )" class="form-control tm-project-status-@{{task.status_id}}" id="assign_user_id" name="assign_user_id" v-model="task.assign_user_id" >
			<option  class="pad-5px"  v-for="developer in developers" v-bind:value="developer.id"> @{{ developer.first_name }} @{{ developer.last_name }} 
			</option>
		    </select>
			</div>
		
			<div class="tm-assign-title desk-15-16 tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px  tm-project-status-border-@{{task.status_id}} border-1px border-solid" style="border-width: 2px 0px 0px 0px">Assign
			</div>
			
			<div class="form_control_1 tm-task-saving saving-assign_user_id-@{{ task.id }}"></div> 
		</div>

					
<!--ESTIMATE-->
		
		<div class="tm-estimate-container  desk-2-16 tab-l-2-16 mob-l-3-16 mob-p-7-16 mob-p-pad-l-20px pad-t-15px pad-r-10px mob-p-pad-r-0px">
						
		<div class="tm-estimate-hrs-text desk-full font-14px pad-b-3px pad-r-1-16"> 
			
			<div class="desk-7-12 pad-r-5px pad-b-2px">
				<div class="desk-7-12">
				<input size="1" type="text" name="estimated_hours" value="@{{ task.estimated_hours }}" v-on:blur="OnSaveTask(task.id , 'estimated_hours', $event )" id="estimated_hours" min="1" max="59" min="1" max="99" class="font-14px desk-full tm-project-status-@{{task.status_id}}">
				</div>
				<div class="font-11px line-14px desk-5-12 tm-project-status-@{{task.status_id}}">
				hr :
				</div>

				<div class="form_control_1 tm-task-saving saving-estimated_hours-@{{ task.id }}"></div> 
			</div>
		
			<div class="desk-5-12  pad-b-2px">
				<div class="desk-6-12">
				<input size="1" type="text" name="estimated_minutes" id="estimated_minutes"  value="@{{ task.estimated_minutes }}"  v-on:blur="OnSaveTask(task.id , 'estimated_minutes', $event )" min="1" max="59" class="font-14px desk-full float-left tm-project-status-@{{task.status_id}}">
				</div>
				<div class="font-11px line-14px  desk-6-12 tm-project-status-@{{task.status_id}}">
				min
				</div>

				<div class="form_control_1 tm-task-saving saving-estimated_minutes-@{{ task.id }}"></div> 
			</div>
		
		</div>
						
				
			<div class="tm-estimate-hrs-field tm-project-status-@{{task.status_id}} desk-full weight-normal font-12px pad-t-1px tm-project-status-border-@{{task.status_id}} border-t-2px border-solid border-r-none border-b-none border-l-none tm-project-status-@{{task.status_id}}" >Estimate			
			</div>
			
		</div>
		
		
<!--TIMER-->

		<div class="tm-time-record-container desk-4-16 tab-l-4-16 tab-p-3-16 mob-l-4-16 mob-p-9-16 mob-p-pad-l-5px ">   
			
			<div class="tm-clock desk-5-12 tab-l-4-12 align-right pad-r-10px pad-t-0px align-right">
				
		  
			<div style="display:none;max-height: 42px;min-height: 42px; max-width: 42px;margin-top:12px !important;width:42px !important" class="float-right align-right tm-user-assigned-preview-@{{ task.id }}" >
				
                
                
			</div>
		  
			
			
			

			<i v-on:click="StartEndTaskTime(task.id , $event)" id="timer-icon-@{{ task.id }}" class="fa fa-clock-o tm-task-icon timer-start-end font-36px line-36px pad-t-25px pad-b-10px" >
			</i>
			
			</div>




			<div class="tm-time-records-container desk-7-12 tab-l-8-12 pad-t-10px">
				
				<div class="desk-full font-12px weight-bold mob-p-hide tm-current-working-user-name-@{{task.id}}" >
				</div>
				
				
				<div class="tm-time-records desk-full" > 
				<div id="timer">
				</div>
				</div>
				<div class="tm-time-records desk-full" > 
				<div id="timer-@{{ task.id }}">
				</div> 
				</div>
			
							
				<div style="padding-top:7px;" class="tm-total-time-per-task-@{{task.id}} tm-current-record desk-full font-12px weight-normal  tm-project-status-@{{task.status_id}}">
				@{{ task.timespent_total_time[0].minutes_elapsed | extract_hours  }}
				<span class="font-10px">hrs,
				</span> 
				@{{ task.timespent_total_time[0].minutes_elapsed | extract_minutes  }} 
				<span class="font-10px">min
				</span>
				</div>
				


		
				<div class="tm-time-records desk-full "> 
				<a v-if="task.timespent_relation[0].count > 0" class="tm-time-records-@{{ task.id }} font-10px tm-tiew-view-records tm-project-status-@{{task.status_id}}"  v-on:click="ShowTimeSpent(task.id, (task.timespent_relation[0].count) , $event )" href="#">Time logs (@{{ task.timespent_relation[0].count | to_int }}) 			
				</a>
				<a  class="font-10px tm-project-status-@{{task.status_id}} tm-time-records-@{{ task.id }}" v-else class="tm-tiew-view-records" href="#">Time logs (@{{ task.timespent_relation[0].count | to_int }}) 
				</a>
				
			</div>
		</div>
		
	</div>
</div>

<!--End.. Second Container-->

<!--Task Hide/Show Details-->

	<div class="display-flex pad-15px mob-l-pad-b-5px mob-l-pad-t-5px border-b-light border-b-1px border-b-solid">

<!--ACCESS-->
				
		<div class="flex-grow-1" v-show="credentialShow[task.id]">
			
				<div class="font-16px weight-normal pad-b-5px">
				Access
				</div>
								
			<div class="pad-b-5px tm-access-details desk-full" v-for="credential in credentials[task.project_id]">
				
				
				<div class="desk-full border-3px border-solid pad-10px pad-r-30px border-r-none border-t-none border-b-none">					
				
					<div class="desk-full weight-bold pad-b-5px font-13px color-555"> 
					@{{ credential.title }} 
					</div>
								
					<div class="desk-full pad-b-5px font-13px">
					<span class="weight-normal font-13px color-333">URL:
					</span> 
					<a class="font-13px" href="http://tm.cloudology.codes/login" target="_blank">
					@{{ credential.url }} 
					</a>
					</div>
								
					<div class="desk-full pad-b-5px font-13px color-333">
					<span class="weight-normal">
					User:</span>
					@{{ credential.username }} 
					</div>
					
					<div class="desk-full pad-b-5px font-13px color-333">
					<span class="weight-normal">
					Pass:
					</span> 
					@{{ credential.password }} 
					</div>
					
					<div class="desk-full font-11px color-333 tab-p-pad-r-30px">
					<span class="weight-normal">
					Notes:
					</span> 
					@{{ credential.notes }} 
					</div>
				
				</div>
								
			</div>
										
		</div>

<!--PROCEDURES-->
		
		<div class="tm-task-procedure flex-grow-2" v-show="procedureShow[task.id]">
			
			<div class="font-16px weight-normal pad-b-5px">Procedures
				
			</div>
			
			<div class="tm-timespent-thread max-width-340px float-right pad-10px pad-r-30px  border-3px border-solid border-r-none border-t-none border-b-none" id="tm-task-procedure-thread-@{{ task.id }}">
							
				<h3 class="color-555">@{{ this.taskProcedureTitle[task.id] }}
				</h3>
				<div class="color-333" slot="body" v-html=" this.taskProcedureDescription[task.id] ">
				</div>

			</div>
		
		</div>				
							
<!--COMMENTS-->

		<div class="flex-grow-4 " v-show="commentShow[task.id]">
			
			<div class="font-16px weight-normal pad-b-5px ">Comments</div>
			<div id="comment-section-@{{ task.id}}" class="tm-comments-container">
			
				<div class="tm-comment-thread" id="comment-thread-@{{ task.id}}">

<!--TinyMCE-->
								
					<div class="pad-b-10px desk-6-12 mob-l-full">			
						<div class="tm-tinymce-comments-container  border-3px border-solid border-r-none border-t-none border-b-none pad-l-10px pad-r-40px">
				
							<div class="desk-full font-16px weight-normal pad-b-15px pad-t-10px">
							<i class="fa fa-comments font-22px color-555 line-22px">&nbsp
							</i><span class=" color-555">Post a comment..</span>
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
					
					<div class=" desk-6-12 mob-l-full">
						<div v-for="comment in comments[task.id]" id="comment-id-@{{ task.id }}" class="desk-full pad-b-10px"> 
							    			      	
							<div class="tm-comment-header desk-full border-3px border-solid pad-b-10px pad-l-10px pad-r-30px border-r-none border-t-none border-b-none"> 
							
								<div class="desk-1-12 pad-r-10px tab-l-2-12">
								<img src="@{{ comment.user.photo }}"/>
								</div>
								<div class="desk-11-12  tab-l-10-12 font-16px weight-normal color-333 pad-b-1px pad-t-3px">
								<i class="fa fa-comments font-22px color-555 line-22px">&nbsp
								</i> @{{ comment.user.first_name }}:
								</div> 
								<div class="desk-11-12 tab-l-10-12 font-10px pad-b-3px color-333">@{{ comment.created_at | format_datetime }}
								</div> 
		
							    <div class="pad-l-5px pad-b-10px desk-full">
								<div class="rtm-comment-body desk-full pad-t-20px pad-l-10px color-333" v-html="comment.content">
								</div>
								</div>
							
							</div>
						</div>				 		
					</div>	
				
				</div>	 											 	
						
			
			</div>				 	
		</div>
													
<!--FILES-->
		
		<div class="tm-task-uploads flex-grow-2 float-right" v-show="mediaShow[task.id]">
			
			<div class="font-16px weight-normal pad-b-5px desk-full max-width-960px float-right">Files</div>
			<div class="desk-full max-width-960px float-right">
								     	
				<div class="tm-files-area desk-full">
					<div class="tm-files-area-header desk-full border-solid border-3px border-t-none border-r-none border-b-none pad-10px pad-r-30px">
							
						<form id="tm-file-upload-form" class="">
						<div class="tm-add-new-task desk-full pad-b-3px">
						<input @change="UploadFile(task.id ,$event)" class="tm-file-upload"  type="file" name="media" id="file-upload-@{{ task.id }}" class="btn btn-primary"/>
						</div>
						<div class="desk-full desk-hide">
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
							
							<div class=" border-solid border-3px border-t-none border-r-none border-b-none pad-10px pad-r-30px desk-full">
								<div class="font-12px desk-full pad-b-5px">
								<a href="@{{ med.path }}" @click="showMediaModal = true,ShowMediaInModal( med.path ,med.filesize , med.created_at)" >
								<i class="fa fa-file font-32px shadow-some">
								</i>
								<span class="line-24px">Uploaded: @{{ med.path | remove_path }}</span>
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
					<div class="tm-task-timer flex-grow-1 float-right" v-show="timespentShow[task.id]">
						
						
						
						<div class="tm-timespent-thread desk-full max-width-240px float-right pad-b-10px" id="tm-timespent-thread-@{{ task.id }}">
				   			<div class="font-16px weight-normal pad-b-5px">
					   		Time Logs
					   		</div>
				   			
				   			<div v-for="timespent in timespents[task.id]" class="desk-full pad-b-10px"> 
					   		<div class="font-10px line-12px border-l-3px border-solid border-t-none border-r-none border-b-none pad-l-10px"> 
					   			
					   			<span class="weight-normal color-333 desk-3-12">
					   			AMOUNT
					   			</span>
					   			<span class="weight-normal color-333 desk-9-12">
					   			 @{{ timespent.spent }} 
					   			</span>
					   			<br>
					   			<span class="weight-normal color-333 desk-3-12">
					   			STARTED
					   			</span>
					   			<span class="weight-normal color-333 desk-9-12">
					   			 @{{ timespent.start_datetime | format_datetime }} 
					   			</span>
					   			<br> 
				   				<span class="weight-normal color-333 desk-3-12">
				   				FINISHED
				   				</span>
				   				<span class="weight-normal color-333 desk-9-12">
				   				 @{{ timespent.end_datetime | format_datetime }} 
				   				</span>
				   				<br>
				   				<span class="weight-normal color-333 desk-3-12">
				   				PERSON
				   				</span>
				   				<span class="weight-normal color-333 desk-9-12">
				   				 @{{ timespent.user_name }}
				   				</span>
				   				<br>
																
							</div>				   	
				   			</div>
				   			
				   			<div class="tm-current-record desk-full weight-normal font-10px line-12px border-l-3px border-solid border-t-none border-r-none border-b-none pad-l-10px pad-t-5px pad-b-5px">
					   		<span class="color-333">
					   		TOTAL = @{{ total_timespents[task.id]  }}
					   		</span>
					   		
					   		<!--<span class="font-10px color-333">
					   		hrs,
					   		</span>
					   		 @{{ task.timespent_total_time[0].minutes_elapsed | extract_minutes  }} -->
					   		
					   		<!--<span class="font-10px color-333">
					   		min
					   		</span>-->
					   		
					   		</div>

						</div>
					</div>
					<!-- End Timelogs -->


<!--End.. Create Task Function-->	

	</div>
	</div>
	
	
</div>

@stop	

@section('javascripts')
																																																																		
<script>

tinymce.init({
    selector: "textarea",
    menubar: false,
    setup: function(editor) {
        editor.on('blur', function(e) {
        	alert(editor.id);
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
			//this.FetchAuthUserCurrentTask();
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