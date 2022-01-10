<template>
<Dashboard>

    <div class="table-responsive">
      <button class='btn btn-primary mb-3 fw-bold' v-show="this.hasRolesOrPermissions('CREAR USUARIOS', 'user', 'permissions')" @click='this.$inertia.visit(route("admin.usuarios.create"))'>Crear nuevo usuario</button>
   <Datatable

        :url="route('admin.usuarios.index')"
        :filters="true"
        v-on:edit="edit"
        v-on:delete="this.delete"
        v-on:openingModal='this.openModal'
        :showItems='false'
        :items="this.users"
        :th="[{
          original:'id',
          text:'id'
      },{
          original:'name',
          text:'nombre'
          },{
            original:'email',
            text:'correo'
            }]"
      :options="[{
         text:'editar',
         method:'edit',
         class:'btn-primary',
         permission:(is('CONSULTOR'))
     },{
         text:'delete',
         method:'delete',
         class:'btn-danger',
         permission:(is('CONSULTOR'))
     }]">

   </Datatable>
  </div>
</Dashboard>
</template>

<script>
  import Dashboard from '@/Pages/Admin/Dashboard';
  import Datatable from '@/Partials/Datatable';

export default {

  name: 'index',
  components:{
    Dashboard,
    Datatable
  },

  props:['users'],
  data () {
    return {

    }
  },

  methods:{
    edit(user){
      let url = route('admin.usuarios.edit',{
        usuario:user.id
      });
      this.$inertia.visit(url)
    }
  }
}
</script>

<style lang="css" scoped>
</style>
