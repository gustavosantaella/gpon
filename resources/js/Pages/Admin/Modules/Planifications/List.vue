<template>
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
         text:'editar',
         method:'edit',
         class:'btn-primary',
         permission:(is('CONSULTOR'))
     }]"
	>

	</datatable>
</template>

<script>
import Datatable from '@/Partials/Datatable';
import AppForm from '@/Partials/AppForm';
import DialogModal from '@/Jetstream/DialogModal'
export default {

  name: 'List',

  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>