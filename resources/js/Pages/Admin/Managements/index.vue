<template>
    <Dashboard>

        <Datatable
            :prevOrNextPageName="this.prevOrNextPageName"
            :url="route('admin.gerencias.index')"
            :filters="true"
            v-on:edit="this.edit"
            v-on:delete="this.delete"
            :items="this.managements"
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
    props: ['managements', 'prevOrNextPageName'],

    methods: {
        edit(item) {
            this.$inertia.visit(route('admin.gerencias.edit', {
                gerencia: item.id,
            }));
        },
        delete(item) {
            this.$swal({
                title: 'Estas seguro?',
                text: 'Si eliminas este registro, se eliminara permanentemente del sistema.',
                icon: 'warning',
                dangerMode: true,
            }).then(e => {
                alert(1)
            });
        }
    }
}
</script>

<style lang="css" scoped>
</style>
