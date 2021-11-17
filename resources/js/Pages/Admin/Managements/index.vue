<template>
	<Dashboard>
    <Datatable
    v-on:edit="this.edit"
    :th="[{
      original:'id',
      text:'id'
    },{
      original:'name',
      text:'nombre'
    }]"
    :options="[{
     text:'edit',
     method:'edit',
     class:'btn-primary',
     permission:(is('CONSULTOR'))
   },{
     text:'delete',
     method:'delete',
     class:'btn-danger',
     permission:(is('CONSULTOR'))
   }]"
   :items="this.managements"
   />
 </Dashboard>
</template>

<script>
  import Dashboard from '@/Pages/Admin/Dashboard';
  import Datatable from '@/Partials/Datatable';
  export default {
    components:{
      Dashboard,
      Datatable
    },
    name: 'index',
    props:['managements'],
    methods:{
      edit(item){
        alert(JSON.stringify(item))
      }
    }
  }
</script>

<style lang="css" scoped>
</style>