<template>
    <Dashboard>
        <Datatable
        :modal="{
            id:'modalProvider',
            title:'Agregar/Editar proveedor',
            text:'Nuevo proveedor',
            class:true
        }"
        :url="route('admin.proveedores.index')"
        :filters="true"
        v-on:edit="this.edit"
        v-on:delete="this.delete"
        v-on:openingModal='this.openModal'
        :items="this.providers"
        :th="[{
          original:'id',
          text:'id'
      },{
          original:'name',
          text:'nombre'
      }]"
      :options="[{
         text:'editar',
         method:'edit',
         class:'btn-primary',
         permission:(hasRolesOrPermissions('editar proveedor', 'user', 'permissions'))
     },{
         text:'delete',
         method:'delete',
         class:'btn-danger',
         permission:(hasRolesOrPermissions('eliminar proveedor', 'user', 'permissions'))
     }]"
     >
     <template v-slot:modalProvider>
        <div class="form-control">
            <app-form
            v-on:submitSuccess='this.success'
            :data='this.form'
            :method='this.method'
            :url='this.action'
            >
                <template v-slot:content>
                    <div class="mb-3">
                        <label for="name">Nombre del proveedor</label>
                        <input required type="text" name="" v-model='this.form.name'  id="name" class="form-control">
                    </div>
                </template>
            </app-form>
        </div>
    </template>
</Datatable>
</Dashboard>
</template>

<script>
    import Dashboard from '@/Pages/Admin/Dashboard';
    import Datatable from '@/Partials/Datatable';
    import AppForm from '@/Partials/AppForm';

    export default {
        components: {
            Dashboard,
            Datatable,
            AppForm

        },
        name: 'index',
        props: ['providers'],

        data(){
            return {
                method:null,
                action:null,
                form:{
                    name:null,
                },
                modal:null,
            }
        },

        methods: {
            delete(item) {
                const  _this = this;
                this.$swal({
                    title: 'Estas seguro?',
                    text: 'Si eliminas este registro, se eliminara permanentemente del sistema.',
                    icon: 'warning',
                    dangerMode: true,
                    showCancelButton: true,
                }).then(e => {
                    if(e.isConfirmed)
                    {
                        _this.$inertia.delete(route('admin.proveedores.destroy',{
                            proveedore:item
                        }));
                    }
                });
            },

            edit(provider){
                this.method = "put",
                this.action = route('admin.proveedores.update', {
                    proveedore:provider.id
                })
                let element = document.getElementById('modalProvider')
                let modal = new bootstrap.Modal(element)
                this.modal = modal;
                this.form.name = provider.name
                modal.show()

            },

            openModal(modal){
                this.method = "post",
                this.action = route('admin.proveedores.store')
                this.modal = modal;
                modal.show();
            },

            success(){
                this.modal.hide()
            }
        }
    }
</script>

<style lang="css" scoped>
</style>

