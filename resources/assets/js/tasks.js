//var Vue = require('vue');
//Vue.use(require('vue-resource'));

var vm = new Vue({
	el : '#app',

	methods :{

		FetchTask: function(){

			this.$http.get('/api/tasks/get',function(data){
				this.$set('tasks' , data)
			})

		},

		SaveTask: function(id , value){

			this.$http.post('/api/task/save',,function(data){
				
			})
		}
	},

	ready : function(){
		this.FetchTask()
	}
});

