

var vm = new Vue({
	el : '#main-content',

	data: function(){
        
        	return {
        			commentShow: [],

        			user :{ id : '',
    			            first_name : '',
    			            last_name : '',
    			            company_id : '',
    			            position : '', //labelled as role
    			            email : '',
    			            city : '',
    			            timezone : '',
    			            phone : '',
    			            country : '',
    			            role_id : '',
        				   }
					}
	},
    
    computed : {



    },

	methods :{

		FetchInitialData: function(){
			this.$http.get('/api/all/get', function(data){
				this.$set('companies', data['companies']);
				this.$set('cities', data['cities']);
				this.$set('timezones', data['timezones']);
				this.$set('countries', data['countries']);
				this.$set('roles', data['roles']);
			});
		},

		SaveUserDetail: function(field, old_value , event){

			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var updated_user = {  'id' : this.user.id , 'field' :field , 'value' : value };
					
					this.$http.post('/api/user/post', updated_user ,function(data){
						if(data['response']['status'] == 'success'){
							this.user['id'] = data['response']['id'];
							this.user[field] = value;
							console.log(this.user['id']+' field-'+value);
						}
					})
				}
			}	
		},


	},


	ready : function(){
		this.FetchInitialData();
	}
});

