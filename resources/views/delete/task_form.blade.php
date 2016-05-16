	<div id="task-form-task_id" class="tm-task-wrapper user-admin row">
				<form id="tasks" name="tasks-task_id">
					 <div class="tm-controllers-container col-md-1"> <!--1-->
						  <div class="tm-drag-and-drop  col-md-4 tm-fill"><i class="fa fa-arrows tm-task-icon"></i></div>
						  <div class="tm-add-new-task col-md-4"><button onclick="append_task_form()" class="btn btn-primary" type="button">Add</button ></div>
						  <div class="tm-delete-task col-md-4"><button class="btn btn-danger" type="button">Delete</button></div>
						  <div class="tm-due-date col-md-12">Due: Feb 24th @ 11:30am</div>
					 </div>
					 <div class="tm-project-container col-md-2"> <!--3-->
					  <div class="tm-project-title col-md-9	">Project</div>
					  <div class="tm-task-title col-md-3">passwords</div>
					  <div class="tm-project-field col-md-12"><select name="project_id" id="project_id-task_id" class="form-control">
					  											<option selected>Select</option>
					  											@foreach($projects as $project)
		                                                        	<option value="{{ $project->id }}"
		                                                        	>{{ $project->project_name }}</option>
		                                                        @endforeach                           
		                                                    </select></div>
					 </div>
					 <div class="tm-task-container col-md-2">   <!--4-->
					  <div class="tm-task-title col-md-12">Task</div>
					  <div class="tm-task-field col-md-12"><input id="title-task_id" name="title" type="text" placeholder="Enter task" class="form-control" value=""></div>
					 </div>
					 <div class="tm-comments-files-container col-md-1">  <!--6-->
					  <div class="tm-comments  col-md-8 "> <a href="#">Comments (13) </a></div>
					  <div class="tm-files col-md-4"> <a href="#">Files (23) </a> </div>
					  <div class="tm-comments-and-files col-md-12">Comments & Files</div>
					 </div>
					 <div class="tm-status-container col-md-1">  <!--7-->
					  <div class="tm-status-title col-md-12">Status</div> 
					  <div class="tm-status-field  col-md-12">
					  		<select class="form-control" name="status_id" id="status_id-task_id">
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
					   			<select id="skill_id-task_id" name="skill_id" class="form-control">
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
					   		    <select name="procedure_id" id="procedure_id-task_id" class="form-control">
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
						   		<select class="form-control" id="assign_user_id-task_id" name="assign_user_id">
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
					 
					<input name="estimated_hours" value="" id="estimated_hours-task_id" min="1" max="59" style="width: 40px;"min="1" max="99" > 
					   hrs</div>
					  <div class="tm-estimate-minutes-field col-md-6"><input size="2" style="width: 40px;" type="number" name="estimated_minutes" id="estimated_minutes-task_id"  value="" min="1" max="59"> min.</div>
					 </div>
					 <div class="tm-time-record-container  col-md-2">   <!--2-->
					  <div class="tm-clock col-md-2"><i class="fa fa-clock-o tm-task-icon"></i></div>
					  <div class="tm-time-records-container  col-md-10">
					   <div class="tm-current-record col-md-12">43min - Marlon Dizon</div>
					   <div class="tm-time-records col-md-12"> <a href="#">View Time Records (4)</a></div>
					  </div>
					 </div>
				</form>
			</div>