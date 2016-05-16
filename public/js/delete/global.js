
var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/


var globals = {

	data: function(){
        
        	return {
        			users: [],

        			developers : [],
					
					skills:[],
					}
	},
	methods :{

		FetchProjects: function(){
			this.$http.get('/api/projects/get',function(data){
				this.$set('projects' , data)
			})
		},

		FetchAuthenticatedUser: function(){
			this.$http.get('/api/auth/user/get',function(data){										
				this.$set('authUser' , data['user']);
				this.authUser.id = data['user']['id'];
				this.authUser.firstName = data['user']['first_name'];
				this.authUser.lastName = data['user']['last_name'];
				this.authUser.name = this.authUser.firstName+' '+this.authUser.lastName;
				this.authUser.role_id = data['user']['role_id'];
			});
		}, 

		FetchTaskStatuses: function(){
			this.$http.get('/api/task/statuses/get',function(data){
				this.$set('statuses' , data)
			})
		},

		FetchSkills: function(){
			this.$http.get('/api/skills/get/',function(data){
				this.$set('skills',data);
			});
		},

		FetchUsers: function(role){
			this.$http.get('/api/users/'+role+'/get/',function(data){
				this.$set('users',data);
			});
		},

		FetchDevelopers: function(){
			this.$http.get('/api/users/developer/get/',function(data){
				this.$set('developers',data);
			});
		},

		FetchRoles: function(){
			this.$http.get('/api/roles/get', function(data){
				this.$set('roles', data);
			})

		},

		FetchProcedures: function(){
			this.$http.get('/api/procedures/get', function(data){
				this.$set('procedures', data)
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


	},

	ready : function(){
		this.FetchAuthenticatedUser();
	}


}


Vue.filter('check_photo', function (value) {
  return (value == '' || (typeof value === 'undefined')) ? '/assets/apps/img/photos/preview.png' : value;
})
