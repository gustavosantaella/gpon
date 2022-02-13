<template>
    <div class="card mb-3" style="">
        <div class="card-body">
            <h5 class="card-title">Informacion del proyecto</h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->

            <div class="row">
                <div class="col-md-4">
                    <label class="card-text fw-bold">Ubicacion:</label>
                      <p class="">
                        Estado:
                        {{
                            construction.planification.parish.municipality.state
                                .name
                        }}
                    </p>
                    <p class="">
                        Municipio:
                        {{
                            construction.planification.parish.municipality.name
                        }}
                    </p>
                    <p class="">
                        Parroquia: {{ construction.planification.parish.name }}
                    </p>
                </div>
                 <div class="col-md-4">
                    <label class="card-text fw-bold">Datos:</label>
                      <p class="">
                        Nombre del proyecto:
                        {{
                            construction.planification.name                        }}
                    </p>
                    <p class='d-flex'>
                        Status:
                            <p :class="[this.setClass(), 'fw-bold']">
                             {{
                             construction.planification.status
                        }}
                      </p>
                    </p>
                    <p class="">
                        Construccion numero: #{{ construction.id }}
                    </p>
                </div>
                  <div class="col-md-4">
                    <div id='canvas'>

                        <div>
                            <canvas  id="myChart" width="600" height="400"></canvas>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div>
        <div v-for='(task, i) in construction.answers' :key='task.id'>
            <div class='fw-bold'>
              {{ i+1 }})  {{ task.management.name }}
            </div>

            <div v-for="(line, index) in task.lines" :key='line.id'  class='mx-4 mt-2'>
              <div class='d-flex flex-column mb-3'>
                    <label class='fw-bold' :for="'task'+line.task.id"> {{ `${i+1}.${index+1}) ` }}  {{   line.task.title  }}</label>
                <input type="text" class='mt-2' :value='line.answer' disabled :id="'task'+line.task.id">
              </div>
            </div>

        </div>
    </div>
    <pre>
        <!-- {{ construction }} -->
    </pre>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Chart from "chart.js";
export default {
    props: ["construction", "managements"],
    layout: Dashboard,

    mounted() {
            const ctx = document.getElementById("myChart");
            const data = {
                labels: [
                    'Avance',
                    'Faltante'

                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [this.porcent().original, this.porcent().faltante],
                    backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(54, 162, 23)',

                    ],
                    hoverOffset: 4
                }]
                };
            var myPieChart = new Chart(ctx,{
                type: 'doughnut',
                data: data,

            });
    },
    methods:{
        setClass () {
            const { construction } = this

            let style = {
                APROBADO:'text-success',
                RECHAZADO:'text-danger',
                INCOMPLETO:'text-warning',
            }

            return style[construction.planification.status];
        },

        porcent(){
          const params = new URLSearchParams(window.location.search)
          const porcent =  params.get('porcent');

            let obj = {
                original:0,
                faltante:100
            }
            obj.original = porcent;
            if(porcent >= 100){
                obj.faltante = 100 - porcent;
            }


            return obj

        }
    }
};
</script>
