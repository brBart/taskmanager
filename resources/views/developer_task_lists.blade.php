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
			.tm-clock{
				 cursor: pointer; cursor: hand; 
			}


			.tm-time-records{
				padding: 0;
			}
			

    </style>
@stop


@section('content')
<div id="app" class="row tm-tasks-main-container">

			<div class="tm-task-wrapper user-admin row  ui-sortable" v-for="task in tasks" >
			    <div class="row">
				<form id="tasks" name="">
				     <input type='hidden' value="@{{ task.id }}" name="task_order" id="task_order"> 
					 <div class="tm-controllers-container col-md-1"> <!--1-->
						  <div v-if="false" class="tm-drag-and-drop handle col-md-4 tm-fill"><i class="fa fa-arrows tm-task-icon"></i></div>
						  <div v-if="false" class="tm-add-new-task col-md-4"><button class="btn btn-primary" v-on:click="NewTask( task.id )" type="button">Add</button ></div>
						  <div v-if="false" class="tm-delete-task col-md-4"><button class="btn btn-danger tm-task-delete" v-on:click="DeleteTask( task.id )" type="button">Delete</button></div>
						  <div class="tm-due-date col-md-12">Due: Feb 24th @ 11:30am</div>
					 </div>
					 
					 <div class="tm-project-container col-md-2"> <!--3-->
						  <div class="tm-project-title col-md-9	">Project</div>
						  <div class="tm-task-title col-md-3"> Password </div>
							  <div class="tm-project-field col-md-12" style="background-color: pink;">
									@{{ task.project.project_name }}
				              </div>
					 </div>

					 <div class="tm-task-container col-md-2">   <!--4-->
					  	<div class="tm-task-title col-md-12">Task</div>
					  	<div class="tm-task-field col-md-12" style="background-color: pink;">
					  		@{{ task.title }}
					  	</div>
					 </div>

					 <div class="tm-comments-files-container col-md-1">  <!--6-->
					  	<div class="tm-comments  col-md-8 "> 
					  		<a href="#" class="tm-show-comments-link" v-on:click="ShowHideComments(task.id , $event)">
					  			Comments (@{{ task.comments_relation[0].count | to_int }}) 
					  		</a>
					  	</div>
					  	<div class="tm-files col-md-4"> 
					  		<a v-on:click="ShowHideMedia(task.id , $event)" href="#">
					  			Files (@{{ timespentShowvietask.media_relation[0].count | to_int }})  
					  		</a> 
					  	</div>
					  	<div class="tm-comments-and-files col-md-12">
					  		<a  v-on:click="ShowHideMediaComment(task.id , $event)" href="#">
					  			Comments & Files
					  		</a>
					  	</div>
					 </div>

					 <div class="tm-status-container col-md-1">  <!--7-->
						  <div class="tm-status-title col-md-12">Status</div> 
						  <div class="tm-status-field  col-md-12">
						  		<select v-on:blur="OnSaveTask(task.id , 'status_id', $event )" v-model="task.status_id" class="form-control" name="status_id" id="status_id">
							  		<option  v-for="(key , value) in statuses" v-bind:value="value"> 
							  		    @{{ key }} 
							  		</option> 
				                </select>
						  </div>
					 </div>

					 <div class="tm-admin-selects-container  col-md-2	">  <!--9-->
					  	<div class="tm-skill-container col-md-4" v-if="false">
						   		<div class="tm-skill-title  col-md-12">Skill</div>
							    <div class="tm-skill-field  col-md-12">
						   			<select v-on:blur="OnSaveTask(task.id , 'skill_id', $event )" id="skill_id" name="skill_id" class="form-control" v-model="task.skill_id">
				                       		<option v-for="skill in skills" v-bind:value="skill.id"> 
				                       			@{{ skill.name }}
				                       		</option> 
				                    </select>
							    </div>
					  	</div>

					  <div class="tm-procedure-container col-md-12">
					   		<div class="tm-procedure-title  col-md-12">Procedure</div>
					   		<div class="tm-procedure-field  col-md-12">
					   		    	<a @click="showProcedureModal=true,ShowProcedureInModal(task.procedure_id)" href="#" >@{{ task.procedure.title }}</a>
		                    </div>
					  </div>

					  <div v-if="false" class="tm-assign-container col-md-4">
						   <div class="tm-assign-title">Assign</div>
						   <div class="tm-assign-field">
						   		<select v-on:blur="OnSaveTask(task.id , 'assign_user_id', $event )"  v-model="task.assign_user_id" class="form-control" id="assign_user_id" name="assign_user_id">
						   			<option  v-for="developer in developers" v-bind:value="developer.id"> 
							  		    @{{ developer.first_name }} @{{ developer.last_name }} 
							  		</option>
		                    	</select>

						   </div>
					  </div>

					 </div>

					 <div class="tm-estimate-container  col-md-1">  <!--10`-->
							<div class="tm-estimate-hrs-field  col-md-12">Estimate</div>
							<div class="tm-estimate-hrs-text col-md-6"> 
								@{{ task.estimated_hours }} hrs
							</div>
							 <div class="tm-estimate-minutes-field col-md-6">
							 	 @{{ task.estimated_minutes }} min.
							 </div>
					 </div>

					 <div class="tm-time-record-container  col-md-2">   <!--2-->
						  <div class="tm-clock col-md-2">
						  	<i  v-on:click="StartEndTaskTime(task.id , $event)" id="timer-icon-@{{ task.id }}" class="fa fa-clock-o tm-task-icon timer-start-end" ></i>
						  </div>
						  <div class="tm-time-records-container  col-md-10">
						   	<div class="tm-current-record col-md-12">@{{ task.timespent_total_time[0].minutes_elapsed | extract_hours  }} hours, @{{ task.timespent_total_time[0].minutes_elapsed | extract_minutes  }} minutes</div>
						   	<div class="tm-time-records col-md-12" > <div id="timer"></div></div>
						   	<div class="tm-time-records col-md-12"> 
							   		
								<a  v-if="task.timespent_relation[0].count > 0" class="tm-tiew-view-records"  v-on:click="ShowTimeSpent(task.id, (task.timespent_relation[0].count) , $event )" href="#">View Time Records (@{{ task.timespent_relation[0].count | to_int }}) </a>
								<a  v-else class="tm-tiew-view-records"  v-on:click="ShowTimeSpent(task.id, 0 , $event )" href="#">View Time Records (@{{ task.timespent_relation[0].count | to_int }}) </a>


								<div class="tm-time-records col-md-12" > <div id="timer-@{{ task.id }}"></div></div>
						   		
						   		<div class="tm-timespent-thread" id="tm-timespent-thread-@{{ task.id }}" v-show="timespentShow[task.id]">
						   			<p v-for="timespent in timespents[task.id]"> Started : @{{ timespent.start_datetime }} <br> 
						   				Ended :  @{{ timespent.end_datetime }} <br> 
			    						Spent : @{{ timespent.spent }} 
			    					</p>
			    				</div>

						   	</div>
						  </div>
					 </div>
				</form>
				</div>

				<!-- comment area, files, time log -->
				<div class="row tm-comment-section">

					 <div class="col-md-5"  >
					 		<div id="comment-section-@{{ task.id}}" v-show="commentShow[task.id]">
							 	<div class="tm-comment-thread" id="comment-thread-@{{ task.id}}">

								 	<!-- TODO :move this to template -->
								 		<div v-for="comment in comments[task.id]" id="comment-id-@{{ task.id }}" style="margin:5px;"> 
					    			      	<div class="row tm-comment-header"> 
					    			      		<span style="float:left; color:red;"> @{{ comment.user.first_name }}</span> 
					    			      		<span style="float:right;">@{{ comment.user.created_at }}</span>    
					    			      	</div>
					                	   <div class="row tm-comment-body" v-html="comment.content"></div>
					                	</div>
					                <!-- End Todo -->
								 		
							 	</div>

							 	<form @submit.prevent="AddNewComment(task.id)">
							 		{!! csrf_field() !!}
								 	<div class="tm-comment-preview" id="comment-preview" style="word-wrap:break-word;">
								 		<a href="#" class="tm-view-more-link" >view more</a>
								 	</div>

								 	<div>
								 		<div class="tm-add-new-task col-md-8">
								 			<textarea class="col-md-12 tm-comment-area" v-model="newComment[task.id]" id="@{{ task.id }}" name="comment-area"></textarea>
								 		</div>
								 		<div>
								 			<div class="tm-add-new-task col-md-4"><button class="btn btn-primary add-comment-btn" data-value="" type="submit">Add</button ></div>
								 		</div>
								 	</div>
								</form>
							</div>
						 	
				     </div>		
				     <div class="col-md-3">

				     		<div class="col-md-12" v-show="mediaShow[task.id]">
						     	<div class="tm-files-area row">
						     		<div class="tm-files-area-header row">
						     			<form id="tm-file-upload-form">
							     			<div class="tm-add-new-task col-md-4"><input @change="UploadFile(task.id ,$event)" class="tm-file-upload"  type="file" name="media" id="file-upload-@{{ task.id }}" class="btn btn-primary"/></div>
									  		<div class="tm-delete-task col-md-4"><button class="btn btn-danger tm-task-delete" data-value="" type="button">Cancel upload</button></div>
								  		</form>
						     		</div>

						     		<div class="tm-files-area-body row" id="tm-files-area-body">
						   				 <!-- TODO :move this to template -->
						     				<div v-for="med in media[task.id]" class="widget-news margin-bottom-20" id="tm-media-id-@{{ task.id }}"> 
			                               		<img @click="showMediaModal = true,ShowMediaInModal( med.path ,med.filesize , med.created_at)" alt="" src="@{{ med.path }}" class="widget-news-left-elem"> 
			                                    <div class="widget-news-right-body"> 
			                                            <span class="label label-default"> @{{ med.created_at }}</span> 
			                                        <p> @{{ med.filesize }} bytes</p> 
			                                    </div> 
			                                </div> 
			                            <!-- End Todo -->
						     		</div>

						        </div>	
						    </div>	
				     </div>
				     <div class="col-md-3">
				     	 
				     </div>
				</div>
				<!-- end comment area -->

			</div>


<modal :show.sync="showProcedureModal">
    <h3 slot="header">@{{ currentProcedure.title }}</h3>
    <div slot="body" v-html="currentProcedure.description ">
    </div>
</modal>


<modal :show.sync="showMediaModal"  v-bind:filesize="currentMedia.filesize" v-bind:created_at="currentMedia.created_at" v-bind:photo="currentMedia.photo" >
    <h3 slot="header">@{{ currentMedia.created_at}}</h3>
    <div slot="body">
          <img width="100%" src="@{{ currentMedia.photo }}">
    </div>
    <h3 slot="footer">@{{ currentMedia.filesize}} bytes</h3>
</modal>



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
	data: function(){
        
	        	return {	
							currentProcedure : {
								id : '',
								title : '',
								description : '',
							}
						}
	},
			


	ready : function(){
			this.FetchTasks();
			this.FetchProjects();
			this.FetchTaskStatuses();
			this.FetchSkills();
			this.FetchAuthUserCurrentTask();
			this.FetchRoles();
	}

}
	
</script>

@stop																																																																																																																											