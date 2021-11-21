<template>
    <Dashboard>
        sdfsdf
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
                                <template v-slot:modalid>hola</template>
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
    props: ['gerencia', 'tasks', 'users']
}
</script>
