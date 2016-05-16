var socket = io('http://127.0.0.1:3000');


var vm = new Vue({
	el : '#app',

	mixins : [globals],

	data: function(){
        
        	return {
        			commentShow: [],

		            mediaShow: [],

		            comments: [],

		            timespentShow : [],

		            isSetTime : [],

		            taskTimeSet : [],

		            newComment : [],

		            tasks : {},

		            media : {},

		            roles : {},

		            isTaskStarted : [],

		            openTask : false,

		            authUser : { 
			            			id : '',
			            			 
			            			firstName : '',

			            			lastName : '',

			            			name : '',

			            			role_id : '',

		            			},

		            media : { 
		            			id : '',
		        			
		        			  	path : '/assets/layouts/layout7/img/avatar1.jpg',
		        			},	


		        	}


	},
    
    computed : {



    },

	methods :{

		ShowHideMediaComment: function(task_id , event){

			event.preventDefault();
			this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
			this.commentShow.$set(task_id, this.commentShow[task_id]);
			this.FetchComments(task_id);

			this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
			this.mediaShow.$set(task_id, this.mediaShow[task_id]);
			this.FetchMedia(task_id);

		},

		FetchRoles: function(){
			this.$http.get('/api/roles/get', function(data){
				this.$set('roles', data);
			})

		},

		ShowHideComments: function(task_id ,event){	

			event.preventDefault();
			this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
			this.commentShow.$set(task_id, this.commentShow[task_id]);
			this.FetchComments(task_id);
		},

		ShowHideMedia: function(task_id ,event){	

			event.preventDefault();
			this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
			this.mediaShow.$set(task_id, this.mediaShow[task_id]);
			this.FetchMedia(task_id);
		},

		FetchComments: function(task_id){
			this.$http.get('/api/comments/'+task_id+'/get', function(data){
				this.$set('comments['+task_id+']', data);
			})
		},

		FetchMedia : function(task_id){
			this.$http.get('/api/media/'+task_id+'/get', function(data){
				this.$set('media['+task_id+']', data);
			})
		},

		FetchTasks: function(){
			this.$http.get('/api/tasks/get',function(data){										
				this.$set('tasks' , data);
			});
			
		},

		NewTask : function(id){
			
			if(this.authUser['role_id'] == this.roles['admin']){
				data = {'id' : id };
				this.$http.post('/api/task/new/post', data , function(data){
					if(data['response'] == 'success'){
						this.FetchTasks();
					}
				});
			}else if(this.authUser['role_id'] == this.roles['client']){
				
	
				data = {'id' : id };
				this.$http.post('/api/task/client/new/post', data , function(data){
					if(data['response'] == 'success'){
						this.FetchTasks();
					}
				});


			}

		},

		OnSaveTask: function(id, field , event){
			var value = event.target.value;
			var updatedTask = {  'id' :id , 'field' :field , 'value' : value };
			
			this.$http.post('/api/tasks/post/', updatedTask ,function(data){
				console.log(data['response']);
			})
		},

		FetchProjects: function(){
			this.$http.get('/api/projects/get',function(data){
				this.$set('projects' , data)
			})
		},

		FetchTaskStatuses: function(){
			this.$http.get('/api/task/statuses/get',function(data){
				this.$set('statuses' , data)
			})
		},

		FetchSkills: function(){
			this.$http.get('/api/skills/get/',function(data){
				this.$set('skills',data)
			});
		},

		FetchUsers: function(role){
			this.$http.get('/api/users/'+role+'/get/',function(data){
				this.$set('developers',data)
			});
		},

		FetchProcedures: function(){
			this.$http.get('/api/procedures/get', function(data){
				this.$set('procedures', data)
			});
		},

		DeleteTask: function(id){
			data = {'id' : id};
			this.$http.post('/api/task/delete/', data, function(data){
				this.FetchTasks();
			});
		},

		ShowTimeSpent: function(task_id, timespentCount ,event){
			if( (typeof timespentCount !== 'undefined') && (timespentCount != null ) && (timespentCount > 0 )  ){
				event.preventDefault();
				this.FetchTimeSpent(task_id);
				this.timespentShow[task_id] = ((typeof this.timespentShow[task_id] === 'undefined') || (this.timespentShow[task_id] === false) || (this.timespentShow[task_id] === null) ) ? true : false;
				this.timespentShow.$set(task_id, this.timespentShow[task_id]);
			}else{
				alert(timespentCount);
			}
		},

		FetchTimeSpent: function(task_id){

			this.$http.get('/api/task/timespent/'+task_id+'/get',function(data){
				this.$set('timespents['+task_id+']', data);
			})	
		},

		StartEndTaskTime: function(task_id , event){

			if(!this.openTask){
				if(this.authUser['role_id'] == this.roles['developer']){

				  	var ts_id = ((typeof this.taskTimeSet[task_id] === 'undefined') || (typeof this.taskTimeSet[task_id] === null) || (typeof this.taskTimeSet[task_id] === 0)  ) ? 0 : this.taskTimeSet[task_id]; 

				  	var data = {'task_id': task_id , 'ts_id' : ts_id};

				  	this.$http.post('/api/task/time/post', data ,function(data){
				  		if(data['status'] === 'success' && data['mode'] === 'close'){
		                		//$(event.target).css('color', 'black');
		       					$('#timer-'+task_id).html('');
		       					//this.taskTimeSet.$set(task_id ,0);
		       					//this.FetchTimeSpent(task_id);
		       					this.openTask = false;
		                }else if(data['status'] === 'success' && data['mode'] === 'open'){
		                		//$(event.target).css('color', 'green');
		       					$('#timer-'+task_id).countup();
		       					//this.taskTimeSet.$set(task_id ,data['id']);
		       					this.isTaskStarted.$set(task_id, true);
		       					this.openTask = true;
		                }
				  	});
			  	}
		   }else{
		   		alert("One task at a time!");
		   }
		},

		AddNewComment: function(task_id){
			var data = {'task_id':task_id , 'content' : this.newComment[task_id] };
			
			this.$http.post('/api/comment/post', data , function(data){
					if(data['response']['status'] == 'success'){
						this.newComment.$remove(task_id);
						this.newComment.$set(task_id ,'');
					}
			});
		},




		FetchAuthUserCurrentTask: function(){
			this.$http.get('/api/auth/current/task/get', function(data){

				if(data != 0)
				{			
					var task_id = data['task_id'];
					var ts = data['start_datetime'];
					$('#timer-icon-'+task_id).css('color', 'green');
					this.openTask = true;					
					$('#timer-'+task_id).countup({
						start : parseDate(ts)
					});
					this.taskTimeSet.$set(task_id ,data['id']);
					this.isTaskStarted.$set(task_id, true);
				
				}

			});
		},

		UploadFile: function(task_id , event){

				var request = new XMLHttpRequest();
		        var file = document.querySelector('#file-upload-'+task_id);
		        var form_data = new FormData();

		        form_data.append('file', file.files[0]);
		        form_data.append('task_id',task_id);
		        request.onreadystatechange = function() {
		            if (request.readyState == XMLHttpRequest.DONE) {
		                var obj = jQuery.parseJSON(request.responseText);
		                if(obj['status'] == "success"){
		                    vm.FetchTasks();
		                    vm.FetchMedia(task_id);
		                }else{

		                }
		            }
		        }
		        request.open('post', '/api/media/post', true);
		        request.send(form_data);
		},

		ClientTaskReorder: function(serialize_tasks){
			data = {'serialize_tasks' : serialize_tasks };
			this.$http.post('/api/tasks/client/reorder/post', data ,function(data){
				console.log(data['response']);
			});
		},

		AdminTaskReorder: function(serialize_tasks){
			data = {'serialize_tasks' : serialize_tasks };
			this.$http.post('/api/tasks/reorder/post', data ,function(data){
				console.log(data['response']);
			});
			
		}

	},

	ready : function(){
		this.FetchAuthenticatedUser();
		this.FetchTasks();
		this.FetchProjects();
		this.FetchTaskStatuses();
		this.FetchSkills();
		this.FetchUsers('developer');
		this.FetchProcedures();
		this.FetchAuthUserCurrentTask();
		this.FetchRoles();

	}
});

Vue.filter('to_int', function (value) {
  return (value == '' || (typeof value === 'undefined')) ? 0 : value;
})

Vue.filter('extract_hours', function (value) {
  return (( (value == null) || (value == '') || (typeof value === 'undefined' )) || value < 59 ) ? 0 : parseInt(value/60);
})

Vue.filter('extract_minutes', function (value) {
  return (value == null || value == '' || (typeof value === 'undefined')) ? 0 : value%60;
})

 socket.on("task-channel:App\\Events\\TaskEvent", function(message){
 	    //TODO : fetch only the newly created task, then insert
 	    
 	    //alert(message);
 	   /* for(var i = 0; i < myArray.length; i++) {
		   if(myArray[i].color === 'blue') {
		     return i;
		   }
		}
		*/
 	    vm.FetchTasks();
 	    if(vm.authUser['role_id'] == vm.roles['developer']){
 	    	vm.FetchAuthUserCurrentTask();
 		}
 });

socket.on("task-timer-channel:App\\Events\\StartEndTaskTimerEvent", function(message){
 	var task_id = message.data['task_id'];
 	if(message.data['status'] === 'success' && message.data['mode'] === 'close'){
    		$('#timer-icon-'+message.data['task_id']).css('color', 'black');
			//$('#timer-'+task_id).html('');
			vm.taskTimeSet.$set(task_id ,0);
			vm.FetchTimeSpent(task_id);
    }else if(message.data['status'] === 'success' && message.data['mode'] === 'open'){
    		$('#timer-icon-'+message.data['task_id']).css('color', 'green');
			//$('#timer-'+task_id).countup();
			vm.taskTimeSet.$set(task_id ,message.data['id']);
    }

 });

 socket.on("comment-channel:App\\Events\\CommentEvent", function(message){
 	
 		var str_message = message.data;
 		var unbracketed_str_obj = str_message.substring(1, str_message .length-1); // removing [], so we can append this to comment obj
 		var unbracketed_json_obj = JSON.parse(unbracketed_str_obj);      
 		var obj = JSON.parse(message.data);                                  //converting this to json, to get specific index   
		vm.comments[obj[0].task_id].push(unbracketed_json_obj);
        //vm.FetchComments(message['data']);
 });


if(vm.authUser['role_id'] == vm.roles['admin'] || vm.authUser['role_id'] == vm.roles['client'])
	$('#app').sortable({
		handle: '.handle',

		start: function(evt, ui){
			$(ui.item).data('startIndex' , ui.item.index());
		},

		update: function(evt, ui) {
			var old_index = $(ui.item).data('startIndex');
			var new_index = ui.item.index();

			var title = vm.tasks[old_index].title;

			//TODO : seriazlize the tasks object if possible
			var serialize_tasks = $('.tm-tasks-main-container').find("input[name='task_order']").serialize();
			
			if(vm.authUser.role_id == vm.roles['client']){	
				vm.ClientTaskReorder(serialize_tasks);
			}else if(vm.authUser.role_id == vm.roles['admin']){	
				vm.AdminTaskReorder(serialize_tasks);
			}
		
		
		}
	});

function parseDate( input ){
	var date_time = input.split(' ');
	var ymd = date_time[0].split('-');
	var hms = date_time[1].split(':');
	
	return new Date(ymd[0] ,ymd[1]-1 , ymd[2] , hms[0] , hms[1] , hms[2]);
}



//# sourceMappingURL=tasks.js.map
