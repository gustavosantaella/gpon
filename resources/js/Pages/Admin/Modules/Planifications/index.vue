<template>
<pre>
{{this.planifications.data}}
</pre>
<Dashboard>
	<datatable
	:items='this.planifications'
	:url="route('admin.modules.planificaciones.index')"
	:showItems="false"
	:th="[
	{
	original:'id',
	text:'id'
	},
	{
	original:'name',
	text:'nombre'
	},
	{
	original:'stateName',
	text:'estado',
	},
	{	
	original:'munName',
	text:'municipio'
	},
	{
	original:'parishName',
	text:'parroquia'
	},
	{
	original:'status',
	text:'status'
	}
	]"
	>

	</datatable>
</Dashboard>
</template>

<script>

import Dashboard from '@/Pages/Admin/Dashboard';
import Datatable from '@/Partials/Datatable';
import AppForm from '@/Partials/AppForm';


export default{
components:{
Dashboard,
AppForm,
Datatable
},

props:['planifications']

}
</script>
