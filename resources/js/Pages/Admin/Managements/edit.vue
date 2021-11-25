<template>
    <Dashboard>
        <div class="form-responsive">
            <form action="">
                <div class="row mb-3">
                    <div class=" col-md-6">
                        <label for="name">Nombre:</label>
                        <input type="text" required name="name" id="name" class="form-control"
                        v-model="this.gerencia.name">
                        <small v-if='this.$page.errors'>{{this.$page.errors.name}}</small>
                    </div>
                    <div class=" col-md-6">
                        <label for="acronimo">Nombre(Acronimo):</label>
                        <input type="text" required name="acronimo" id="acronimo" class="form-control"
                        v-model="this.gerencia.name">
                        <small v-if='this.$page.errors'>{{this.$page.errors.name}}</small>
                    </div>

                </div>

                <div class="mb-3 col-md-4">
                    <input type="checkbox" class="form-check-input" id="code">
                    <label class="form-check-label mx-1" for="code">Activo</label>
                </div>
            </form>
            <div class="row mb-3">
                <div class="col-md-6">
                   <div class="row">
                       <h2 class="col-md-6">Actividades</h2>
                   </div>
                   <div>
                    <datatable
                    v-on:editTask="this.editTask"
                    v-on:openingModal='this.openModal'
                    :options="[{
                     text:'editar',
                     method:'editTask',
                     class:'btn-primary',
                     permission:(is('CONSULTOR'))
                 },]"
                 :modal="{
                    id:'modalActivy',
                    title:'Crear/Editar actividad',
                    text:'Nueva actividad'
                }"
                :items="this.tasks"
                :th="[{
                    original:'title',
                    text:'titulo',
                },{
                    original:'end_days',
                    text:'Dias de culminacion',
                }]"
                >
                <template v-slot:modalActivy>
                    <div class="form-responsive">
                        <app-form 
                        :method='this.form.method'
                        :url='this.form.url'
                        :data='this.task'
                        v-on:submitSuccess='this.success'
                        >
                        <template v-slot:content>
                            <div class="mb-3">
                                <label for="title">Titulo de la actividiad:</label>
                                <input required type="text" name="title" v-model="this.task.title"
                                id="title"
                                class="form-control">

                            </div>
                            <div class="mb-3">
                                <label for="descriptionofactivity" >Descripcion de la
                                actividiad:</label>
                                <textarea required v-model="this.task.description"
                                id="descriptionofactivity" cols="30"
                                rows="10"
                                class="form-control">{{this.task.description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="end_days">Numero de dias que demora la actividad</label>
                                <input required  v-model='this.task.end_days' type="number"
                                name="end_days"
                                id="end_days"
                                class="form-control">
                            </div>
                        </template>
                    </app-form>
                </div>
            </template>
        </datatable>


    </div>
</div>

<div class="col-md-6">
    <h2>Empleados</h2>
    <div>
        <datatable
        :items="this.users"
        v-on:openingModal='this.openModalUser'
        v-on:removeUser='this.removeUser'
        :modal="{
            id:'modalUser',
            title:'Asignar/Remover usuario',
            text:'Nuevo usuario',

        }"
        :options="[{
            text:'remover',
            class:'btn btn-sm btn-danger',
            method:'removeUser',
            permission:(is('CONSULTOR'))
        }]"
        :th="[{
            original:'name',
            text:'Nombre',
        },{
            original:'email',
            text:'Correo',
        }]"
        > 
        <template v-slot:modalUser>
            <app-form
            :method='this.form.method'
            :url='this.form.url'
            :data='this.user'
            v-on:submitSuccess='this.success'
            >
            <template v-slot:content>
                <div class="mb-3">
                    <label for="users">Asignar usuario a la gerencia {{this.gerencia.name}}</label>
                    <select required='true' name="user_id" v-model='this.user.user_id' id="users" class="form-control">
                        <option v-for='user in this.managementUsers' :value="user.id" :key='user.id'>{{user.name}}</option>
                    </select>
                </div>
            </template>
        </app-form>
    </template>
</datatable>


</div>
</div>

</div>
    <div>
        <h2>Roles</h2>

    </div>

</div>
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
            AppForm,

        },


        data(){
            return{
                button:false,
                task:{
                    title:null,
                    description:null,
                    end_days:null,
                },
                form:{
                    method:null,
                    url:null,
                    data:null
                },
                user:{
                    user_id:null,
                },
                modal:null,
                managementUsers:[]
            }
        },
        props: ['gerencia', 'tasks', 'users'],

        methods:{
            openModal(modal){
                this.modal = modal;
                this.form.url = route('admin.gerencias.storeTask',{
                    gerencia:this.gerencia.id
                });
                this.form.method = 'post';
                modal.show()

            },
            async openModalUser(modal){
                this.modal = modal
                const response = await axios.get(route('admin.gerencias.getUsers'))
                this.managementUsers = response.data 
                this.form.method = 'post'
                this.form.url = route('admin.gerencias.addUserToManagement', {
                    gerencia:this.gerencia
                })
                modal.show(); 
            },

            success(){

               this.modal.hide()
           },
           editTask(task){
            this.task =  task
            this.form.url = route('admin.gerencias.updateTask',{
                gerencia:this.gerencia.id,
                task:task.id
            });
            this.form.method = 'put';
            let modal = new bootstrap.Modal(document.getElementById('modalActivy'))
            modal.show()
        },
        removeUser(user){
            const _this = this;
            this.$inertia.delete(route('admin.gerencias.removeUser', {
                gerencia:this.gerencia,
                user
            }), {
                onSuccess(){
                    _this.$toast.success('Usuario removido')
                }
            });
        }
    }
}
</script>
