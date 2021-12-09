<template>
<pre>
	{{this.form.data}}
</pre>
<Dashboard>
	<app-form>
	<template v-slot:content>
		<div v-for='task in this.tasks' :key='task.id' class='mb-3'>
			<div>
				<label :for="this.label(task)">{{task.title}}</label>
				<input v-model='this.form.data[]' required :id='this.label(task)' type="text" class='form-control'>
			</div>
	</div>
	</template>
</app-form>	
</Dashboard>
</template>

<script>

import Dashboard from '@/Pages/Admin/Dashboard';
import AppForm from '@/Partials/AppForm';

export default{
components:{
Dashboard,
AppForm
},

props:['tasks'],
data(){
	return {
		form:{
			data:[],
		
		}
	}
},
methods: {
	label(task){
		return `task-${task.id}`
	}
}

}
</script>
