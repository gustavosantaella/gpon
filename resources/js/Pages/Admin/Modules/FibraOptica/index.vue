<template>

<Dashboard>

	<datatable
	:items='this.planifications'
	v-on:edit="this.edit"
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
	:options="[{
         icon:'fas fa-edit',
         method:'edit',
         class:'btn-primary',
        permission:(this.hasRolesOrPermissions('completar requerimiento', 'user', 'permissions'))
     }]"
	>

	</datatable>
</Dashboard>
</template>

<script>

import Dashboard from '@/Pages/Admin/Dashboard';
import Datatable from '@/Partials/Datatable';
import AppForm from '@/Partials/AppForm';
import DialogModal from '@/Jetstream/DialogModal'


export default{
components:{
Dashboard,
AppForm,
Datatable,
DialogModal
},

props:['planifications'],
data(){
	return {

	}
},
methods: {
	edit(data){
		let url = route('admin.modules.fibra-optica.edit',{
			fibra_optica:data.id
		});
		this.$inertia.visit(url);
	}
}

}
</script>
