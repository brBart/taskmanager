
var sv = new Vue({
	el : '#app',

	mixins : [globals],

	data: function(){
        
        	return {
        			skill :{}, 

        			skills : {},
			}
	},
    
    computed : {



    },

	methods :{

		FetchInitialData: function(){
			this.FetchDevelopers();
		},



		SaveSkillDetail: function(field, old_value , event){
			
			if(typeof event.target.value !== 'undefined'){
				var value = event.target.value;

				if(value != '' ){
					var updated_user = {  'id' : this.skill.id , 'field' :field , 'value' : value };
					
					this.$http.post('/api/skill/post', updated_user ,function(data){
						if(data['response']['status'] == 'success'){
							this.skill['id'] = data['response']['id'];
							this.skill[field] = value;
							
						}
					})
				}
			}	
		},

	},


	ready : function(){
		this.FetchInitialData();
		this.FetchSkills();
	}
});

