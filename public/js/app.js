var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

var config = JSON.parse(config);
var socket = io(config[0].domain+':3000');
var loadingImg = '<img width="45" src="/assets/apps/img/tm-saving.gif">';

Vue.component('modal', {
  template: '#modal-template',
  props: {
  	photo : String,
  	filesize : String,
  	created_at :String,
    show: {
      type: Boolean,
      required: true,
      twoWay: true    
    }
  },


})

var vm = new Vue({
	el : '#app',

	mixins : [mixin, main],

	data: function(){
        
        	return {
	        			commentShow: [],

	        			credentialShow : [],

	        			priorityTaskId : '',

			            mediaShow: [],

			            procedureShow: [],

			            comments: [],

			            timespentShow : [],

			            isSetTime : [],

			            taskTimeSet : [],

			            newComment : [],

			            input : '',

			            skill :{}, 

	        			skills : {},

			            tasks : {},

			            media : {},

			            roles : {},

			            showMediaModal: false,

			            showProcedureModal: false,

			            developers : {},

			            isTaskStarted : [],

						timezones : [],

						cties : [] ,

						countries :[],

			            openTask : false,

			            newEditCredential : false,

			            companies : {},

						managingUsers : [],

						managingCompanies : [],

						skillProcedures: [],

						currentTaskId : 0,

						cities : [],

			            media : { 
			            			id : '',
			        			
			        			  	path : '/assets/layouts/layout7/img/avatar1.jpg',
			        			},	

			        	invite :{

	        					email :'',
	        					role_id : '' ,
	        			},

	        			isEmailExist : false,	

	        			selected : [],

	        			clients : [],

	        			procedure : {},

	        			offset : [],

	        			currentMedia :{
		        						photo : '',
		        						filesize : '',
		        						created_at : '',					        			
	        			},

	        			hideRepeatedProjectTitle : false,

	        			hideRepeatedUserTitle : false,

	        			showHideNotification : false,

	        			tmpId : [],

	        			opennedCommentArea : [],

	        			taskSortBy : 'date',

	        			userNotification : {},

	        			userNotificationCount : 0,

	        			projectFormat : 0,
						
						userFormat : 0,	
			        	
			        	dateFormat : 1,
		        	}

	},

    computed : {
    	validation: function () {
	      
	      return {
	      	role_id : (this.invite.role_id >= 0),
	        email: emailRE.test(this.invite.email),
	        emailExist : !(this.isEmailExist),
	      }

	    },
	    
	    isValid: function () {
	      var validation = this.validation
	      return Object.keys(validation).every(function (key) {
	        return validation[key]
	      })
	    }



    },

    filters : {

    		format_media_links : function(value){
    			if (/(jpg|gif|png|JPG|GIF|PNG|JPEG|jpeg)$/.test(value)){
    				return '<img src="'+value+'" @click="showMediaModal = true,ShowMediaInModal(value)" class="widget-news-left-elem clickable">';                        
    			}else{
    				return '<a href="'+value+'" >'+value+'</a>'; 
    			}
    		},

    		managing_users: function(value){
    			if((typeof value !== 'undefined') || (value > 0) ){
    			    console.log('vakue-->'+value);
    			    ret = '';

    			    for(i = 0 ; i < this.managingUsers.length ; i++)
    			    {
    				    if(this.managingUsers[i] == value){
	    			    	ret = "checked";
	    			    	break;
	    			    }
    				}

    				return ret;
				}

  			},


  			str_limit : function(text, limit){

  				return text.substr(0, limit);
  			},

  			check_profile_photo : function(path){
  			
  				if((typeof path !== 'undefined')){
  					return path;
  				}else{
  					return '/assets/layouts/layout7/img/avatar1.jpg';
  				}

  			},

  			time_since : function(datatime){

				    var seconds = Math.floor((new Date() - date) / 1000);

				    var interval = Math.floor(seconds / 31536000);

				    if (interval > 1) {
				        return interval + " years";
				    }
				    interval = Math.floor(seconds / 2592000);
				    if (interval > 1) {
				        return interval + " months";
				    }
				    interval = Math.floor(seconds / 86400);
				    if (interval > 1) {
				        return interval + " days";
				    }
				    interval = Math.floor(seconds / 3600);
				    if (interval > 1) {
				        return interval + " hours";
				    }
				    interval = Math.floor(seconds / 60);
				    if (interval > 1) {
				        return interval + " minutes";
				    }
				    return Math.floor(seconds) + " seconds";
				
  			}

    },

	methods :{
		DeleteProcedure: function(id, event){
			event.preventDefault();
			var r = confirm("Are you sure?");
			if(r){
				var data = {'id' :id };
				this.$http.post('/api/procedure/delete/post', data , function(data){
					if(data === 'success'){
						this.FetchProcedures();
					}
				});
			}
		},

		DeleteSkill: function(id, event){
			
			event.preventDefault();
			var r = confirm("Are you sure?");
			if(r){
				var data = {'id' :id };
				this.$http.post('/api/skill/delete/post', data , function(data){
					if(data === 'success'){
						this.FetchSkills();
					}
				});
			}
		},

		DeleteProject: function(id, event){
			event.preventDefault();

			var r = confirm("Are you sure?");

			if(r){
				var data = {'id' :id };
				this.$http.post('/api/project/delete/post', data , function(data){
					if(data === 'success'){
						this.FetchProjects();
					}
				});
			}
		},

		DeleteUser: function(id, role , event){
			event.preventDefault();
			var r = confirm("Are you sure?");

			if (r) {
				var data = {'id' : id };
				this.$http.post('/api/user/delete/post',data ,function(data){
					if(data === 'success'){
						if(role === 'admin'){
							this.FetchAdmins();
						}else if(role === 'developer'){
							this.FetchDevelopers();
						}else{
							this.FetchClients();
						}
					}
				});
			}
		},


		DeleteCompany: function(id , event){
			event.preventDefault();
			var r = confirm("Are you sure?");

			if (r) {
				var data = {'id' : id };
				this.$http.post('/api/company/delete/post', data , function(){
					this.FetchCompanies();
				});
			}
		},
					
		TasksPageDisabledBtn: function(){

			if(this.authUser.is_admin){

			}else if(this.authUser.is_developer){

				$('select.tm-select-project').prop('disabled', true);
				$('.tm-skill-field select').prop('disabled', true);
				$('.tm-procedure-field').prop('disabled', true);
				
			}else{
				$('.tm-skill-field select').prop('disabled', true);
				$('.tm-procedure-field').prop('disabled', true);

				$('.tm-assigned-user-select').prop('disabled' ,true);
				$('.estimated-hours').prop('disabled' ,true);
				$('.estimated-minutes').prop('disabled' ,true);
				$('.tm-procedure-select').prop('disabled', true);

				$('.tm-procedure-select').addClass('convert-to-input-text');
				$('.tm-assigned-user-select').addClass('convert-to-input-text');
				$('.tm-skill-select').addClass('convert-to-input-text');
								
			}

		},

		FetchUserNotificationCount : function(){
			if(typeof this.authUser.id !== 'undefined'){
				this.$http.get('/api/user/notifications/count/get',function(data){
					this.$set('userNotificationCount', data);
				});
			}
		},

		FetchUserNotifications: function(){

			if(typeof this.authUser.id !== 'undefined'){
				this.$http.get('/api/user/notifications/get',function(data){
					this.$set('userNotification', data);
					this.FetchUserNotificationCount();
				});
			}

		},

		HideShowRepeatingProjectTitleFields : function( id ){
			if(this.hideRepeatedProjectTitle){
				if(id == this.tmpId){
					this.tmpId = 0;
					return false;
				}else{
					this.tmpId = id;
					return true;
				}
			}else{
				return true;
			}
		},

		ShowHideNotificationArea : function(event){
			event.preventDefault();
			if(this.showHideNotification){
				this.showHideNotification = false;
			}else{
				this.FetchUserNotifications();
				this.showHideNotification = true;				
			}
		},

		SortTask : function(sortyby){
			var tmpProjectId = 0 , tmpUserId = 0 , assignedToUserIdArr = [], projectIdArr = [] , sortByDate= false;
			this.$http.get('/api/tasks/get?sort_by='+sortyby,function(data){										
				this.$set('tasks' , data);
				this.taskSortBy = sortyby;
				if(sortyby === 'project'){
					this.hideRepeatedProjectTitle = true;
					this.hideRepeatedUserTitle = false;
					this.sortByDate =false;
				}else if(sortyby === 'user'){
					this.hideRepeatedUserTitle = true;
					this.hideRepeatedProjectTitle = false;
					this.sortByDate =false;
				}else if(sortyby === 'date'){
					this.hideRepeatedUserTitle = false;
					this.hideRepeatedProjectTitle = false;
					sortByDate = true;
					this.FetchAuthUserCurrentTask();

				}

				tinymce.init({
				    selector: ".tm-comment-area",	
				    theme : "advanced",
				    theme_advanced_buttons1 : "bold,italic,bullist,numlist,link,unlink,charmap,formatselect ",
				    theme_advanced_toolbar_location : "top",
				    theme_advanced_toolbar_align : "left",
				  /*  setup: function(editor) {
				        editor.on('blur', function(e) {
				        	vm.newComment[editor.id] = tinymce.activeEditor.getContent(); 
				        });
				    }*/
				});

			}).success(function(data){
				
				if(this.authUser.role == 'developer'){	
					this.priorityTaskId = data[0].id;
				}else if(this.authUser.role == 'admin'){
					if(sortyby === 'project'){
				

						$.each(data, function(i, obj) {
				    		var project_id = obj['project_id'];
				    		var task_id = obj['id'];
				    		if($.inArray(project_id, projectIdArr)>=0){
				    			$('.tm-project-drag-'+project_id+'-'+task_id).css('visibility' , 'hidden');
				    		}else{
				    			projectIdArr.push(project_id);
				    			$('.tm-project-drag-'+project_id+'-'+task_id).css('visibility' , 'visible');
				    		}
				    		$('.tm-select-project').prop('disabled', true);
				    	});
				    	$('.tm-assign-container').css('display','block');
				    	$('.tm-drag-and-drop').css('visibility','hidden');

				    	$('.sort-by-user').removeClass("sort-by-selected");
				    	$('.sort-by-project').addClass("sort-by-selected");
				    	$('.sort-by-date').removeClass("sort-by-selected");

				    	$('.tm-project-container').removeClass('tm-filter-by-user-selected').removeClass('tm-filter-by-date-selected').addClass('tm-filter-by-project-selected');

				    	$('.tm-project-details').css('display' ,'none');
					}else if(sortyby === 'user'){
						$.each(data, function(i, obj) {
							var assignedToUserId =  obj['assign_user_id'];
							var taskId = obj['id'];
							
							if($.inArray(assignedToUserId, assignedToUserIdArr)>=0){
				    			$('.tm-assign-container-sorted-'+taskId+'-'+assignedToUserId).css('display' , 'none');
				    		}else{
				    			assignedToUserIdArr.push(assignedToUserId);
				    			$('.tm-assign-container-sorted-'+taskId+'-'+assignedToUserId).css('display' , 'block');
				    		}
				    	});

						$('.tm-project-container').removeClass('tm-filter-by-project-selected').removeClass('tm-filter-by-date-selected').addClass('tm-filter-by-user-selected');

						$('.tm-assign-container').css('display','none');
						$('.tm-select-assigned-user ').prop('disabled' , true);			    	
			    		$('.tm-project-drag').css('visibility' , 'visible');
			    		$('.tm-select-project').prop('disabled', false);
			    		$('.tm-drag-and-drop').css('display', 'none');

			    		$('.tm-project-container').removeClass("desk-10-12").addClass("desk-4-12");
			    		$('.tm-project-container').css('float', 'right');

			    		$('.sort-by-date').removeClass("sort-by-selected");
			    		$('.sort-by-user').addClass("sort-by-selected");
				    	$('.sort-by-project').removeClass("sort-by-selected");

				    	$('.tm-project-details').css('display' ,'block');
					}else if(sortyby === 'date'){
						$('.sort-by-user').removeClass("sort-by-selected");
				    	$('.sort-by-project').removeClass("sort-by-selected");
				    	$('.sort-by-date').addClass("sort-by-selected");
				    	$('.tm-drag-and-drop').css('display', 'block');

						$('.tm-project-container').removeClass('tm-filter-by-project-selected').removeClass('tm-filter-by-user-selected').addClass('tm-filter-by-date-selected');

					}
				}else{

				}

			});
		},

		SortReportBy : function(sortby){
			this.sortReportBy = sortby;
			this.FormatShow(sortby);	
			this.QueryTimespent();		
		},

		FormatShow : function(format){
			if(format == 'project'){
				this.projectFormat = true;
				this.userFormat = false;	
	        	this.dateFormat = false;
	        }else if(format == 'user'){
	        	this.projectFormat = false;
				this.userFormat = 1;	
	        	this.dateFormat = false;
	        }else{
	        	this.projectFormat = false;
				this.userFormat = false;	
	        	this.dateFormat = true;
	        }
	        			
		},

		QueryTimespent: function(){

			if(this.queryTimeSpent.startDate == ''){
				alert('Please select start date!'+ this.queryTimeSpent.startDate);
				return;
			}

			if(this.queryTimeSpent.endDate === ''){
				alert('Please select end date!');
				return;
			}

			if(this.queryTimeSpent.companyId === ''){
				alert('Please select company!');
				return;
			}

			//this.FormatShow(this.sortReportBy);
			var data= {'start_date' : this.queryTimeSpent.startDate , 'end_date' : this.queryTimeSpent.endDate ,'company_id' : this.queryTimeSpent.companyId};
			
			this.$http.get('/api/timespent/get?start_date='+this.DateToYMD(this.queryTimeSpent.startDate)+'&end_date='+this.DateToYMD(this.queryTimeSpent.endDate)+'&company_id='+this.queryTimeSpent.companyId+'&sort_by='+this.sortReportBy, function(data){
				if(data != 'error'){
					this.$set('timeSpentReport', data);
				}
			});		
		},

		DateToYMD : function(input){
		    if(input != ''){
		        var raw_date = input.split('/');
		        return raw_date[2]+'-'+raw_date[0]+'-'+raw_date[1];
		    }else{

		        return 0;
		    }
		},

		FilterTask:function( event){
			var status_id = event.target.value;
			for (var k in this.statuses){
			    if (this.statuses.hasOwnProperty(k)) {
					if(status_id == 7){
							$('.tm-project-status-'+this.statuses[k]).css('display' , 'block');

						
					}else{	
						$('.tm-drag-and-drop').css('visibility', 'hidden');
				        if(this.statuses[k] == status_id){
				        	$('.tm-project-status-'+this.statuses[k]).css('display' , 'block');
				        }else{
				        	$('.tm-project-status-'+this.statuses[k]).css('display' , 'none');
				        }
			    	}

			    	if(this.taskSortBy === 'date'){
						$('.tm-drag-and-drop').css('visibility', 'visible');
					}else{
						$('.tm-drag-and-drop').css('visibility', 'hidden');
					}
			    }
			}
		},

		UnFilterTask:function(){
			for (var k in this.statuses){
			    if (this.statuses.hasOwnProperty(k)) {
			        $('.tm-project-status-'+this.statuses[k]).css('display' , 'block');
			    }
			}
		},
		
		ShowMediaInModal: function(photo ,filesize , created_at ){
			
			this.currentMedia.photo=photo;
			this.currentMedia.filesize =filesize;
			this.currentMedia.created_at = created_at;

		},

		ShowProcedureInModal: function(id){
			
			this.$http.get('/api/procedure/'+id+'/get', function(data){
				if(data != 'error'){
					this.currentProcedure.title =data.title;
					this.currentProcedure.description = data.description;
				}
			});

		},

		/*******************************invite_user*********************************************/
		CheckEmailIfUsed: function(){
			if(this.validation.email){
				this.$http.get('/check/email/'+this.invite.email, function(data){
					if(data > 0){
						this.isEmailExist = true;
					}else{
						this.isEmailExist = false;
					}
				});
			}else{
				this.isEmailExist = true;
			}
		},

		SendEmail: function(){

			if (this.isValid) {
				
				data = {'email' : this.invite.email , 'role_id' : this.invite.role_id};

				this.$http.post('/send/email/', data, function(data){
						
						if(data['response'] == 'success'){
							window.location.href ='/sent/email/success/'+this.invite.email;
						}else{
							alert('Error');
						}
				});
		    }else{
		    	alert('Invalid data');
		    }
		},

		ShowHodeTaskDetails: function(id,event){
			event.preventDefault();
			if( $("#tm-more-details-container-"+id).hasClass("mob-l-hide") ){
				$( "#tm-more-details-container-"+id).removeClass("mob-l-hide").addClass("mob-l-show");
			}else{
				$( "#tm-more-details-container-"+id).removeClass("mob-l-show").addClass("mob-l-hide");
			}
		},

		FetchRoles: function(){
			this.$http.get('/api/roles/get', function(data){
				this.$set('roles', data);
			})

		},



		ShowHideMediaComment: function(task_id , event){

			if(this.authUser['role'] == 'admin' || this.authUser['role'] == 'client'){
				event.preventDefault();
				this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
				this.commentShow.$set(task_id, this.commentShow[task_id]);
				this.FetchComments(task_id,event);
				this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
				this.mediaShow.$set(task_id, this.mediaShow[task_id]);
				this.FetchMedia(task_id);
			}else{
				if(this.currentTaskId == task_id){
					event.preventDefault();
					this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
					this.commentShow.$set(task_id, this.commentShow[task_id]);
					this.FetchComments(task_id,event);
					this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
					this.mediaShow.$set(task_id, this.mediaShow[task_id]);
					this.FetchMedia(task_id);
				}
			}

		},


		RemoveItemFromArray: function (arr) {
		    var what, a = arguments, L = a.length, ax;
		    while (L > 1 && arr.length) {
		        what = a[--L];
		        while ((ax= arr.indexOf(what)) !== -1) {
		            arr.splice(ax, 1);
		        }
		    }
		    return arr;
		},

		ShowHideComments: function(task_id ,event){	

			if(this.authUser['role'] == 'admin' || this.authUser['role'] == 'client'){
				event.preventDefault();
				this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
				this.commentShow.$set(task_id, this.commentShow[task_id]);
				this.FetchComments(task_id,event);

			}else{
				if(this.currentTaskId == task_id){
					event.preventDefault();
					this.commentShow[task_id] = ((typeof this.commentShow[task_id] === 'undefined') || (this.commentShow[task_id] === false) ) ? true : false;
					this.commentShow.$set(task_id, this.commentShow[task_id]);
					this.FetchComments(task_id,event);
				}
			}

			if($.inArray(task_id, this.opennedCommentArea)>=0){
				this.opennedCommentArea  
			}else{
				this.opennedCommentArea.push(task_id);
			}

			if(this.commentShow[task_id] ){
				tinymce.init({
				    selector: "#"+task_id,	
				    theme : "advanced",
				    theme_advanced_buttons1 : "bold,italic,bullist,numlist,link,unlink,charmap,formatselect ",
				    theme_advanced_toolbar_location : "top",
				    theme_advanced_toolbar_align : "left",


				  /*  setup: function(editor) {
				        editor.on('blur', function(e) {
				        	vm.newComment[editor.id] = tinymce.activeEditor.getContent(); 
				        });
				    }*/
				});
			}else{
				tinymce.execCommand('mceRemoveControl', true, "#"+task_id );
			}



		},

		ShowHideCredentials: function(task_id,project_id, event){
			event.preventDefault();
			
			if(this.authUser['role'] == 'admin' || this.authUser['role'] == 'client'){
				event.preventDefault();
				this.credentialShow[task_id] = ((typeof this.credentialShow[task_id] === 'undefined') || (this.credentialShow[task_id] === false) ) ? true : false;
				this.credentialShow.$set(task_id, this.credentialShow[task_id]);
				this.FetchProjectCredential(project_id);
			}else{
				if(this.currentTaskId == task_id){
					event.preventDefault();
					this.credentialShow[task_id] = ((typeof this.credentialShow[task_id] === 'undefined') || (this.credentialShow[task_id] === false) ) ? true : false;
					this.credentialShow.$set(task_id, this.credentialShow[task_id]);
					this.FetchProjectCredential(project_id);

				}
			}


		},


		ShowHideProcedure: function(task_id,procedure_id, event){

			event.preventDefault();
			this.procedureShow[task_id] = ((typeof this.procedureShow[task_id] === 'undefined') || (this.procedureShow[task_id] === false) ) ? true : false;
			this.procedureShow.$set(task_id, this.procedureShow[task_id]);

			this.$http.get('/api/procedure/'+procedure_id+'/get', function(data){
				if(data != 'error'){
					this.$set('taskProcedureTitle['+task_id+']', data.title);
					this.$set('taskProcedureDescription['+task_id+']', data.description);
				}else{
					alert('error!')
				}
			});
		},

		ShowHideMedia: function(task_id ,event){	

			if(this.authUser['role'] == 'admin' || this.authUser['role'] == 'client'){
				event.preventDefault();
				this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
				this.mediaShow.$set(task_id, this.mediaShow[task_id]);
				this.FetchMedia(task_id);
			}else{
				if(this.currentTaskId == task_id){
					event.preventDefault();
					this.mediaShow[task_id] = ((typeof this.mediaShow[task_id] === 'undefined') || (this.mediaShow[task_id] === false) ) ? true : false;
					this.mediaShow.$set(task_id, this.mediaShow[task_id]);
					this.FetchMedia(task_id);

				}
			}
		},

		FetchComments: function(task_id,event){
			event.preventDefault();
			this.$http.get('/api/comments/'+task_id+'/'+this.offset[task_id]+'/get', function(data){
					this.$set('comments['+task_id+']', data);
			});

			
			/*if(typeof this.offset[task_id] === 'undefined'){
				this.offset[task_id] = 0;
			}else{
				this.offset[task_id] = this.offset[task_id] + 5;
			}


			this.$http.get('/api/comments/'+task_id+'/'+this.offset[task_id]+'/get', function(data){
				if(this.offset[task_id] == 0){
					this.$set('comments['+task_id+']', data);
				}
				else if (this.offset[task_id] > 0){
					this.comments[task_id].push(data);
					Vue.nextTick(function () {
					 	vm.comments[task_id].push(data);
					});
			
				}
			})*/
		},

		FetchMedia : function(task_id){
			this.$http.get('/api/media/'+task_id+'/get', function(data){
				this.$set('media['+task_id+']', data);
			})
		},

		FetchTasks: function(){
				
			this.$http.get('/api/tasks/get',function(data){										
				this.$set('tasks' , data);	
			}).success(function(data){
				if(this.authUser.role == 'developer'){	
					this.priorityTaskId = data[0].id;
				}

				this.FetchAuthUserCurrentTask();
				this.TasksPageDisabledBtn();
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
		
			if( (field === 'assign_user_id' || field === 'skill_id' || field === 'procedure_id' || field === 'estimated_hours' || field === 'estimated_minutes') && (this.authUser.is_client) ){
				return;
			}else{
				var value = event.target.value;
				var updatedTask = {  'id' :id , 'field' :field , 'value' : value };
				
				$(".saving-"+field+"-"+id).css('display' ,'block!important');
				$(".saving-"+field+"-"+id).html(loadingImg); 

				this.$http.post('/api/tasks/post', updatedTask ,function(data){
					if(data['response']['status'] == 'success'){
						$(".saving-"+field+"-"+id).html('<i class="fa fa-check font-green"></i>');        
		            	$(".saving-"+field+"-"+id).delay(2000).fadeIn('slow');
		            	$(".saving-"+field+"-"+id).delay(2000).fadeOut('slow');
		            }else{
		            	alert('error!');
		            }
				});
			}

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
			this.$http.get('/api/skills/get',function(data){
				this.$set('skills',data)
			});
		},

		FetchUsers: function(role){
			this.$http.get('/api/users/'+role+'/get',function(data){
				this.$set('developers',data)
			});
		},

		FetchClients: function(){
			this.$http.get('/api/users/client/get',function(data){
				this.$set('clients',data)
			});
		},

		FetchProcedures: function(){
			this.$http.get('/api/procedures/get', function(data){
				this.$set('procedures', data)
			});
		},

		FetchCompanies: function(){
			this.$http.get('/api/companies/get', function(data){
				this.$set('companies', data)
			});
		},

		DeleteTask: function(id){
			
			var r = confirm("Are you sure?");

			if (r == true) {
				data = {'id' : id};
				this.$http.post('/api/task/delete', data, function(data){
					this.FetchTasks();
				});
			}
		},

		ShowTimeSpent: function(task_id, timespentCount ,event){

			

			timespentCount = (typeof timespentCount !== 'undefined') ? timespentCount : 0;
			if( (typeof timespentCount !== 'undefined') && (timespentCount != null ) && (timespentCount > 0 )  ){
				event.preventDefault();
				this.FetchTimeSpent(task_id);
				this.timespentShow[task_id] = ((typeof this.timespentShow[task_id] === 'undefined') || (this.timespentShow[task_id] === false) || (this.timespentShow[task_id] === null) ) ? true : false;
				this.timespentShow.$set(task_id, this.timespentShow[task_id]);
			}else{
				alert('No record!');
			}
		},

		FetchTimeSpent: function(task_id){

			this.$http.get('/api/task/timespent/'+task_id+'/get',function(data){
				
				this.$set('timespents['+task_id+']', data.timespent);
				this.$set('total_timespents['+task_id+']', data.task_total_time_spent);
			})	
		},

		StartEndTaskTime: function(task_id , event){

				if(this.authUser.role_id == this.roles['developer']){
					
					  	var ts_id = ((typeof this.taskTimeSet[task_id] === 'undefined') || (typeof this.taskTimeSet[task_id] === null) || (typeof this.taskTimeSet[task_id] === 0)  ) ? 0 : this.taskTimeSet[task_id]; 

					  	var data = {'task_id': task_id , 'ts_id' : ts_id};

					  	if((this.currentTaskId == 0 || this.currentTaskId == task_id) && this.priorityTaskId == task_id){

						  	this.$http.post('/api/task/time/post', data ,function(data){
						  		if(data['status'] === 'success' && data['mode'] === 'close'){
				       					$('#timer-'+task_id).html('');
				       					this.taskTimeSet.$set(task_id ,0);
				       					//this.FetchTimeSpent(task_id);
				       					this.openTask = false;
				       					this.currentTaskId = 0;
				                }else if(data['status'] === 'success' && data['mode'] === 'open'){
				                		//$(event.target).css('color', 'green');
				       					$('#timer-'+task_id).countup();
				       					this.taskTimeSet.$set(task_id ,data['id']);
				       					this.isTaskStarted.$set(task_id, true);
				       					this.currentTaskId = task_id;
				       					this.openTask = true;
				       				
				                }
						  	});		
					  	}		
			  	}

		},


		SaveCredential : function(event){

			event.preventDefault();
				
			var cred = {'mode' : this.mode,
						'project_id' : this.project.id,
						'id': this.newCredential.id, 
						'title' : this.newCredential.title, 
						'url' : this.newCredential.url,
						'username' : this.newCredential.username ,
						'password' : this.newCredential.password ,
						'notes' : this.newCredential.notes, 
			 };

			this.$http.post('/api/credential/post', cred , function(data){
				if(data['response'] == 'success'){
					this.FetchCredential();
					this.mode = '';
					this.newCredential.id = '';
                    this.newCredential.title = '';
                    this.newCredential.url = '';
                    this.newCredential.username = '';
                    this.newCredential.password = '';
                    this.newCredential.notes = '';
                    this.newCredential.project_id = this.project.id;
					this.newEditCredential = false;
					//this.credentials.push(cred);					
				}
			});
		},

		EditCredential : function(credential_id){
			this.$http.get('/api/credential/'+credential_id+'/get', function(data){
				this.newEditCredential = true;
				this.mode = 'edit';
				this.$set('newCredential', data);
			});			
		},

		DeleteCredential : function(credential_id, event){
			event.preventDefault();
			
			var r = confirm("Are you sure?");

			if (r == true) {
				var data = {'id' :  credential_id }; 
				this.$http.post('/api/credential/delete/post', data, function(data){
					if(data['response'] == 'success'){
						this.FetchCredential();
					}
				});	
			}		
		},

		AddNewCredential : function(){
			this.newEditCredential = true;
			this.mode = 'new';
		},

		CancelNewCredential : function(){
			this.newEditCredential = false;
			this.mode = '';
			this.newCredential.id = '';
			this.newCredential.title = '';
			this.newCredential.url = '';
			this.newCredential.username = '';
			this.newCredential.password = '';
			this.newCredential.notes = '';
			this.newCredential.project_id = this.project.id;
		},

		FetchCredential: function(){
			this.$http.get('/api/credentials/'+this.project.id+'/get', function(data){
				this.$set('credentials', data);
			});
		},

		FetchProjectCredential: function(project_id){
			this.$http.get('/api/credentials/'+project_id+'/get', function(data){
				this.$set('credentials['+project_id+']', data);
			});
		},



		AddNewComment: function(task_id){
			var data = {'task_id':task_id , 'content' : tinyMCE.activeEditor.getContent() };

			this.$http.post('/api/comment/post', data , function(data){
					if(data['response']['status'] == 'success'){
						this.newComment.$remove(task_id);			
						this.newComment.$set(task_id ,'');
						tinyMCE.activeEditor.setContent('');
					}
			});
		},



		UploadPhoto: function(id, prefix, table , event){

			if(id > 0){
				$('#preview').css('background-image', 'url("/assets/apps/img/photos/loading_spinner.gif")');
        
				var request = new XMLHttpRequest();
		        var file = document.querySelector("#photo");
		        var form_data = new FormData();

		        form_data.append('file', file.files[0]);
		        form_data.append('id',id);
		        form_data.append('table',table);
		        request.onreadystatechange = function() {
		            if (request.readyState == XMLHttpRequest.DONE) {
		                var obj = jQuery.parseJSON(request.responseText);
		                if(obj['response']['status'] == "success"){		                    
		                	 $('#preview').css('background-image', 'url("' + obj['response']['path'] + '")');
		                }else{
		                	alert('Error');
		                }
		            }
		        }
		        request.open('post', '/api/photo/post', true);
		        request.send(form_data);
		    }
		},

		FetchAuthUserCurrentTask: function(){
			this.$http.get('/api/auth/current/task/get', function(data){

				if(this.authUser.is_developer){
					
					if(data != 0){			
						var task_id = data['task_id'];
						this.currentTaskId = data['task_id'];
						var ts = data['start_datetime'];
						$('#timer-icon-'+task_id).css('color', 'green');
						this.openTask = true;					
						$('#timer-'+task_id).countup({
							start : parseDate(ts)
						});
						this.taskTimeSet.$set(task_id ,data['id']);
						this.isTaskStarted.$set(task_id, true);					
					}

				}else{
					 
					 $.each(data, function(i, obj) {
				    	var task_id = obj['task_id'];
						this.currentTaskId = obj['task_id'];
						var ts = obj['start_datetime'];
						var userInfo = obj['user'];
						$('#timer-icon-'+task_id).css('color', 'green');
						$('#timer-'+task_id).countup({
							start : parseDate(ts)
						});

						if( (typeof userInfo !== 'undefined') && userInfo !== null ){
							$('.tm-current-working-user-name-'+task_id).html(userInfo.first_name);
							$('.tm-user-assigned-preview-'+task_id).css('display' ,'block');
							$('.tm-user-assigned-preview-'+task_id).css('background' ,'url(http://tm.cloudology.codes'+userInfo.photo+') repeat scroll center center / cover');
							$('#timer-icon-'+task_id).css('display', 'none');
							$('.tm-total-time-per-task-'+task_id).css('display', 'none');
						}else{
							$('.tm-total-time-per-task-'+task_id).css('display', 'block');
							$('#timer-icon-'+task_id).css('display', 'block');
							$('.tm-user-assigned-preview-'+task_id).css('display' ,'none');
						}

 					});

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
	                   // vm.FetchTasks();
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
			
		},	

		FetchAuthenticatedUser: function(){
			
			this.$http.get('/api/auth/user/get',function(data){										
				this.$set('authUser' , data['user']);
				this.authUser.id = data['user']['id'];
				this.authUser.firstName = data['user']['first_name'];
				this.authUser.lastName = data['user']['last_name'];
				this.authUser.photo =  ((typeof data['user']['photo'] != 'undefined') || data['user']['photo'] != '' || data['user']['photo'] != null ) ?  data['user']['photo'] : '/assets/layouts/layout7/img/avatar1.jpg' ;
				
				this.authUser.name = this.authUser.firstName+' '+this.authUser.lastName;
				this.authUser.role_id = data['user']['role_id'];
			});
		}, 

		FetchDevelopers: function(){
			this.$http.get('/api/users/developer/get',function(data){
				this.$set('developers',data);
			});
		},

		FetchAdmins: function(){
			this.$http.get('/api/users/admin/get',function(data){
				this.$set('admins',data);
			});
		},

		FetchCountries : function(){
			this.$http.get('/api/countries/get',function(data){
				this.$set('countries',data);
			});

		},

		FetchTimezones: function(){
			this.$http.get('/api/timezones/get',function(data){
				this.$set('timezones',data);
			});

		},

		FetchCities: function(){

			if(typeof this.user !== 'undefined'){
		
				this.$http.get('/api/cities/'+this.user.country+'/get',function(data){
					this.$set('cities',data);
				});

			}
		},

		SaveSkillDetail: function(field, old_value , event){
			
			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var data = {  'id' : this.skill.id , 'field' :field , 'value' : value };

					$(".saving-"+field).html(loadingImg); 
					
					this.$http.post('/api/skill/post', data ,function(data){
						if(data['response']['status'] == 'success'){
							this.skill['id'] = data['response']['id'];
							this.skill[field] = value;
							$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                        	$(".saving-"+field).delay(2000).fadeIn('slow');
                        	$(".saving-"+field).delay(2000).fadeOut('slow');
							
						}else{
                        	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    	}

					})
				}
			}	
		},

		SaveUserDetail: function(field, old_value , event){

			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var updated_user = {  'id' : this.user.id , 'field' :field , 'value' : value };

					$(".saving-"+field).html(loadingImg); 
					
					this.$http.post('/api/user/post', updated_user ,function(data){
						if(data['response']['status'] == 'success'){
							this.user['id'] = data['response']['id'];
							this.user[field] = value;
							//console.log(this.user['id']+' field-'+value);
							$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                        	$(".saving-"+field).delay(2000).fadeIn('slow');
                        	$(".saving-"+field).delay(2000).fadeOut('slow');
                        	if(field == 'country'){
                        		this.$http.get('/api/cities/'+value+'/get',function(data){
                        			//this.$set(this.user.city , '');
									//this.$set('cities',{});
									//data = {'text' : 'city1' , 'text' :'city2'};
									this.$set('user.city' , '');
									
									this.$set('cities', data);

									//$.each(data, function(i, city) {
										//alert(city);
				    					//this.cities.push(city);
				    				//});
									//this.$set('cities', data);
									//this.cities.push('');
								});
                        	}
							
						}else{
                        	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    	}
					})
				}
			}	
		},

		
		SaveCompanyDetail: function(field, old_value , event){

			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var data = {  'id' : this.company.id , 'field' :field , 'value' : value };

					$(".saving-"+field).html(loadingImg); 
					
					this.$http.post('/api/company/post', data ,function(data){
						if(data['response']['status'] == 'success'){
							this.company['id'] = data['response']['id'];
							this.company[field] = value;
							//console.log(this.user['id']+' field-'+value);
							$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                        	$(".saving-"+field).delay(2000).fadeIn('slow');
                        	$(".saving-"+field).delay(2000).fadeOut('slow');
							
						}else{
                        	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    	}
					})
				}
			}	
		},



		SaveProcedureDetail: function(field, old_value , event){
			
			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;
				$(".saving-"+field).html(loadingImg); 
				if(value != '' ){
					var data = {  'id' : this.procedure.id , 'field' :field , 'value' : value };
					
					this.$http.post('/api/procedure/post', data ,function(data){
						if(data['response']['status'] == 'success'){
							this.procedure['id'] = data['response']['id'];
							this.procedure[field] = value;
							$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                        	$(".saving-"+field).delay(2000).fadeIn('slow');
                        	$(".saving-"+field).delay(2000).fadeOut('slow');
							
						}else{
                        	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    	}
					})
				}
			}	
		},

		SaveProcedureDescription: function(field, text){
	
			$(".saving-"+field).html(loadingImg); 
			if(text != '' ){
				var data = {  'id' : this.procedure.id , 'field' :field , 'value' : text };
				
				this.$http.post('/api/procedure/post', data ,function(data){
					if(data['response']['status'] == 'success'){
						this.procedure['id'] = data['response']['id'];
						this.procedure[field] = text;
						$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                    	$(".saving-"+field).delay(2000).fadeIn('slow');
                    	$(".saving-"+field).delay(2000).fadeOut('slow');
						
					}else{
                    	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                	}
				})
			}
			
		},

		SaveProjectDetail: function(field, old_value , event){
			
			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var data = {  'id' : this.project.id , 'field' :field , 'value' : value };

					$(".saving-"+field).html(loadingImg); 
					
					this.$http.post('/api/project/post', data ,function(data){
						if(data['response']['status'] == 'success'){
							this.project['id'] = data['response']['id'];
							this.project[field] = value;
							$(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                        	$(".saving-"+field).delay(2000).fadeIn('slow');
                        	$(".saving-"+field).delay(2000).fadeOut('slow');
							
						}else{
                        	$(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    	}

					})
				}
			}	
		},


		FechSkillProcedure: function (){
			this.$http.get('/api/skill/procedure/'+this.procedure.id+'/get',function(data){
				this.$set('skillProcedures',data);
			});

			
		},

		FetchProjectManagingUsers: function(){
			this.$http.get('/api/project/managing/users/'+this.project.id+'/2/get',function(data){
				this.$set('managingClients',data);
			});
			this.$http.get('/api/project/managing/users/'+this.project.id+'/0/get',function(data){
				this.$set('managingAdmins',data);
			});
		},

		FetchProjectManagingCompanies: function(){
				this.$http.get('/api/project/managing/companies/'+this.project.id+'/get',function(data){
					this.$set('managingCompanies',data);
				})
		},


		SaveProjectManager: function(id,  company_id, user_id, event){



				$(".saving-"+id).html(loadingImg);
				
				if($(event.target).is(':checked')){
					manager = 1;
				}else{
					manager = 0;
				}
				
				data = { 'project_id' : id , 'company_id' : company_id , 'user_id' : user_id , 'manager' : manager};

				this.$http.post('/api/project/manager/post', data ,function(data){
					if(data['response'] == 'success'){
						//console.log('success');
						$(".saving-"+id).html('<i class="fa fa-check font-green"></i>');        
                        $(".saving-"+id).delay(2000).fadeIn('slow');
                        $(".saving-"+id).delay(2000).fadeOut('slow');

                    }else{
                        $(".saving-"+id).html('<i class="fa fa-warning font-red"></i>');
                
                    }

				});
				
		},
	


		SaveSkillProcedure: function(id,  skill_id,  event){

				$(".saving-"+id).html(loadingImg); 
				
				if($(event.target).is(':checked')){
					related = 1;
				}else{
					related = 0;
				}

				data = { 'procedure_id' : id , 'skill_id' : skill_id ,  'related' : related};

				this.$http.post('/api/skill/procedure/post', data ,function(data){
					if(data['response'] == 'success'){
						//console.log('success');
					   	$(".saving-"+id).html('<i class="fa fa-check font-green"></i>');        
                        $(".saving-"+id).delay(2000).fadeIn('slow');
                        $(".saving-"+id).delay(2000).fadeOut('slow');

                    }else{
                        $(".saving-"+id).html('<i class="fa fa-warning font-red"></i>');
                
                    }

				});
				
		}
	

	},


	ready : function(){
	//	this.FetchAuthenticatedUser();
	}
});

Vue.filter('to_int', function (value) {
  return (value == '' || (typeof value === 'undefined')) ? 0 : value;
})


Vue.filter('remove_path', function(path){
	return path.replace( '/assets/apps/img/photos/','');
});

Vue.filter('format_datetime', function (value) {


	if(typeof value === 'undefined')
		value = new Date();


	var date = parseDate(value);	
	var utc = false;
	var format = "dddd h:mm tt - d MMM yyyy, ";

    var MMMM = ["\x00", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var MMM = ["\x01", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var dddd = ["\x02", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var ddd = ["\x03", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    function ii(i, len) {
        var s = i + "";
        len = len || 2;
        while (s.length < len) s = "0" + s;
        return s;
    }

    var y = utc ? date.getUTCFullYear() : date.getFullYear();
    format = format.replace(/(^|[^\\])yyyy+/g, "$1" + y);
    format = format.replace(/(^|[^\\])yy/g, "$1" + y.toString().substr(2, 2));
    format = format.replace(/(^|[^\\])y/g, "$1" + y);

    var M = (utc ? date.getUTCMonth() : date.getMonth()) + 1;
    format = format.replace(/(^|[^\\])MMMM+/g, "$1" + MMMM[0]);
    format = format.replace(/(^|[^\\])MMM/g, "$1" + MMM[0]);
    format = format.replace(/(^|[^\\])MM/g, "$1" + ii(M));
    format = format.replace(/(^|[^\\])M/g, "$1" + M);

    var d = utc ? date.getUTCDate() : date.getDate();
    format = format.replace(/(^|[^\\])dddd+/g, "$1" + dddd[0]);
    format = format.replace(/(^|[^\\])ddd/g, "$1" + ddd[0]);
    format = format.replace(/(^|[^\\])dd/g, "$1" + ii(d));
    format = format.replace(/(^|[^\\])d/g, "$1" + d);

    var H = utc ? date.getUTCHours() : date.getHours();
    format = format.replace(/(^|[^\\])HH+/g, "$1" + ii(H));
    format = format.replace(/(^|[^\\])H/g, "$1" + H);

    var h = H > 12 ? H - 12 : H == 0 ? 12 : H;
    format = format.replace(/(^|[^\\])hh+/g, "$1" + ii(h));
    format = format.replace(/(^|[^\\])h/g, "$1" + h);

    var m = utc ? date.getUTCMinutes() : date.getMinutes();
    format = format.replace(/(^|[^\\])mm+/g, "$1" + ii(m));
    format = format.replace(/(^|[^\\])m/g, "$1" + m);

    var s = utc ? date.getUTCSeconds() : date.getSeconds();
    format = format.replace(/(^|[^\\])ss+/g, "$1" + ii(s));
    format = format.replace(/(^|[^\\])s/g, "$1" + s);

    var f = utc ? date.getUTCMilliseconds() : date.getMilliseconds();
    format = format.replace(/(^|[^\\])fff+/g, "$1" + ii(f, 3));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])ff/g, "$1" + ii(f));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])f/g, "$1" + f);

    var T = H < 12 ? "AM" : "PM";
    format = format.replace(/(^|[^\\])TT+/g, "$1" + T);
    format = format.replace(/(^|[^\\])T/g, "$1" + T.charAt(0));

    var t = T.toLowerCase();
    format = format.replace(/(^|[^\\])tt+/g, "$1" + t);
    format = format.replace(/(^|[^\\])t/g, "$1" + t.charAt(0));

    var tz = -date.getTimezoneOffset();
    var K = utc || !tz ? "Z" : tz > 0 ? "+" : "-";
    if (!utc) {
        tz = Math.abs(tz);
        var tzHrs = Math.floor(tz / 60);
        var tzMin = tz % 60;
        K += ii(tzHrs) + ":" + ii(tzMin);
    }
    format = format.replace(/(^|[^\\])K/g, "$1" + K);

    var day = (utc ? date.getUTCDay() : date.getDay()) + 1;
    format = format.replace(new RegExp(dddd[0], "g"), dddd[day]);
    format = format.replace(new RegExp(ddd[0], "g"), ddd[day]);

    format = format.replace(new RegExp(MMMM[0], "g"), MMMM[M]);
    format = format.replace(new RegExp(MMM[0], "g"), MMM[M]);

    format = format.replace(/\\(.)/g, "$1");

    return format;
});

Vue.filter('strip_tags' , function(value, limit){
	if(typeof value !== 'undefined'){
		var rex = /(<([^>]+)>)/ig;
		value =  value.replace(rex , "");
		return value.substr(0, limit);
	}else{
		return;
	}
});


Vue.filter('extract_hours', function (value) {
  return (( (value == null) || (value == '') || (typeof value === 'undefined' )) || value < 59 ) ? 0 : parseInt(value/60);
});

Vue.filter('extract_minutes', function (value) {
  return (value == null || value == '' || (typeof value === 'undefined')) ? 0 : value%60;
});

Vue.filter('managing_companies', function (value) {
  return vm.managingCompanies.indexOf(value) > -1 ? 'checked' : '';
});

socket.on("notification-channel:App\\Events\\NotificationEvent", function(message){
 	    vm.FetchUserNotificationCount();
 });

 socket.on("task-channel:App\\Events\\TaskEvent", function(message){
 	    //TODO : fetch only the newly created task, then insert
 	    
 	   /* for(var i = 0; i < myArray.length; i++) {
		   if(myArray[i].color === 'blue') {
		     return i;
		   }
		}
		*/
 	    vm.FetchTasks();
 	    if(vm.authUser['role_id'] == vm.roles['developer']){
 	    //	vm.FetchAuthUserCurrentTask();
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


if(vm.authUser.role == 'admin' || vm.authUser.role == 'client'){
	$('#main').sortable({
		handle: '.handle',

		start: function(evt, ui){
			tinymce.execCommand('mceRemoveControl', true, "#1" );
			tinymce.execCommand('mceRemoveControl', true, "#2" );
			tinymce.execCommand('mceRemoveControl', true, "textarea" );

			$(ui.item).data('startIndex' , ui.item.index());
			//tinymce.EditorManager.execCommand('mceRemoveEditor', false, "content_txt");
			//alert('remove');
			
		},

		update: function(evt, ui) {
			var old_index = $(ui.item).data('startIndex');
			var new_index = ui.item.index();

			//var title = vm.tasks[old_index].title;

			//TODO : seriazlize the tasks object if possible
			var serialize_tasks = $('.tm-tasks-main-container').find("input[name='task_order']").serialize();
			
			if(vm.authUser.role_id == vm.roles['client']){	
				vm.ClientTaskReorder(serialize_tasks);
			}else if(vm.authUser.role_id == vm.roles['admin']){	
				vm.AdminTaskReorder(serialize_tasks);
			}
			
			tinymce.execCommand('mceAddControl', true, "#1" );
			tinymce.execCommand('mceAddControl', true, "#2" );
			tinymce.execCommand('mceAddControl', true, "textarea" );
		
		}
	});
}






//# sourceMappingURL=tasks.js.map