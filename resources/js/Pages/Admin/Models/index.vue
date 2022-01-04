<template>
    <Dashboard>
    
        <Datatable
        :modal="{
            id:'modalProvider',
            title:'Agregar/Editar modelo',
            text:'Nuevo modelo',
            class:true
        }"
        :url="route('admin.modelos.index')"
        :filters="true"
        v-on:edit="this.edit"
        v-on:delete="this.delete"
        v-on:openingModal='this.openModal'
        :showItems='false'
        :items="this.models"
        :th="[{
          original:'id',
          text:'id'
      },{
          original:'prov',
          text:'Proveedor'
          },{
            original:'name',
            text:'Modelo'
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
        <div class="form-control">
            <app-form
            v-on:submitSuccess='this.success'
            :data='this.form'
            :method='this.method'
            :url='this.action'
            >
                <template v-slot:content>
                    <div class="mb-3">
                        <label for="name">Nombre y Modelo del equipo</label>
                        <input required type="text" name="" v-model='this.form.name'  id="name" class="form-control">
                    </div>
                    <div class='mb-3'>
                        <label for='code'> Serial del equipo </label>
                        <input required type="text" v-model='this.form.code' id="code" class="form-control">
                    </div>
                    <div class='mb-3'>
                        <label for='providers'>Seleccione un proveedor</label>
                        <select id='providers' v-model='this.form.provider_id' class="form-control" required>
                            <option :value='provider.id' :selected="this.form.provider_id == provider.id" v-for="provider in this.providers" :key="provider.id">{{provider.name}}</option>
                        </select>
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
        props: ['models', 'providers'],

        data(){
            return {
                method:null,
                action:null,
                form:{
                    code:null,
                    name:null,
                    provider_id:null
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
                        _this.$inertia.delete(route('admin.modelos.destroy',{
                            modelo:item
                        }));
                    }
                });
            },

            edit(model){
                this.method = "put",
                this.action = route('admin.modelos.update', {
                    modelo:model.id
                })
                let element = document.getElementById('modalProvider')
                let modal = new bootstrap.Modal(element)
                this.modal = modal;
                this.form.name = model.name
                this.form.code = model.code
                this.form.provider_id = model.provider_id
                modal.show()

            },

            openModal(modal){
                this.method = "post",
                this.action = route('admin.modelos.store')
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

