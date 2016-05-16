
var sv = new Vue({
	el : '#app',

	mixins : [globals],

	data: function(){
        
        	return {
        			skill :{

	        				id :'',
	        				name : '',
	        				description : ''
        			},

        			roles : {},

        			invite :{

        					email :'',
        					role_id : '' ,
        			},

        			isEmailExist : false,

			}
	},
    
    computed: {
	    validation: function () {
	      
	      return {
	      	role_id : (this.invite.role_id != ''),
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

	methods :{

		FetchInitialData: function(){
			this.FetchRoles();
		},

		CheckEmailIfUsed: function(){
			if(this.validation.email){
				this.$http.get('/check/email/'+this.invite.email, function(data){
					if(data == 1){
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

				this.$http.post('/send/email/', data , function(data){
						
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


		


	},


	ready : function(){
		this.FetchInitialData();
	}
});

