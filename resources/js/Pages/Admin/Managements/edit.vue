<template>
    <Dashboard>

        <pre>
            {{this.$page}}
        </pre>
        <div class="form-responsive">
            <form action="">
                <div class="row mb-3">
                    <div class=" col-md-6">
                        <label for="name">Nombre:</label>
                        <input type="text" required name="name" id="name" class="form-control"
                               v-model="this.gerencia.name">
                    </div>
                    <div class=" col-md-6">
                        <label for="acronimo">Nombre(Acronimo):</label>
                        <input type="text" required name="acronimo" id="acronimo" class="form-control"
                               v-model="this.gerencia.name">
                    </div>

                </div>

                <div class="mb-3 col-md-4">
                    <input type="checkbox" class="form-check-input" id="code">
                    <label class="form-check-label mx-1" for="code">Activo</label>
                </div>
            </form>
                <div class="row">
                    <div class="col-md-6">
                       <div class="row">
                           <h2 class="col-md-6">Actividades</h2>
                       </div>
                        <div>
                            <datatable
                                :modal="{
                                id:'modalid',
                                title:'titulo del modal',
                                text:'Nueva actividad'
                                }"
                                :items="this.tasks"
                                :th="[{
                                    original:'title',
                                    text:'titulo',
                                },{
                                    original:'description',
                                    text:'descripcion',
                                },{
                                    original:'end_days',
                                    text:'Dias de culminacion',
                                }]"
                            >
                                <template v-slot:modalid>
                                    <div class="form-responsive">
                                        <form @submit.prevent="this.sendActivity()">
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
                                            <div>
                                                <input :disabled="this.button" type="submit" value="Enviar"
                                                       class="btn btn-primary">
                                            </div>
                                        </form>
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
                                :th="[{
                                    original:'name',
                                    text:'Nombre',
                                },{
                                    original:'email',
                                    text:'Correo',
                                }]"
                            />


                        </div>
                    </div>

                </div>


        </div>
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

    data(){
        return{
            task:{
                title:null,
                description:null,
                end_days:null,
            }
        }
    },
    props: ['gerencia', 'tasks', 'users'],

    methods:{
        sendActivity(){
            
        }
    }
}
</script>
