<template>

<Dashboard>
	<pre>
{{this.construction}}
	</pre>
	<datatable
	:items='this.construction'
	v-on:edit="this.edit"
	v-on:show="this.show"
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
         text:'editar',
         method:'edit',
         class:'btn-primary',
         permission:(is('CONSULTOR'))
     },{
         text:'ver datos',
         method:'show',
         class:'btn-secondary',
         permission:(is('CONSULTOR'))
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
export default {

  name: 'index',
  components:{
  	Datatable,
  	Dashboard
  },
  props:['construction'],
  data () {
    return {

    }
  },

  methods:{
  	edit(construction){
  		alert(JSON.stringify(construction))
  	},
  	show(construction){
  		alert(JSON.stringify(construction))
  	}
  }
}
</script>

<style lang="css" scoped>
</style>