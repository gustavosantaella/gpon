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
             permission:(is('CONSULTOR'))
           },{
             text:'delete',
             method:'delete',
             class:'btn-danger',
             permission:(is('CONSULTOR'))
   }]"
        >
        <template v-slot:modalProvider>
            <div>
                hola
            </div>
        </template>
        </Datatable>
    </Dashboard>
</template>

<script>
import Dashboard from '@/Pages/Admin/Dashboard';
import Datatable from '@/Partials/Datatable';

export default {
    components: {
        Dashboard,
        Datatable,

    },
    name: 'index',
    props: ['providers'],

    methods: {
        edit(item) {
            this.$inertia.visit(route('admin.proveedores.edit', {
                gerencia: item.id,
            }));
        },
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
        
        openModal(modal){
            modal.show();
        }
    }
}
</script>

<style lang="css" scoped>
</style>

