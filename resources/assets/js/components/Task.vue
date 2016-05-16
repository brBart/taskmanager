<template>
	<ul class="list-group">
		<li class="list-group-item" v-for="task in list">
			{{ task.title }}
		</li>
  	</ul>	
</template>



<script>
	
 export default {

	props: ['list'],

	created(){
		this.list = JSON.parse(this.list);
		alert('hello')
	}

}

</script>