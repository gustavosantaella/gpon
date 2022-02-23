<template>
    <div class="card mb-3" style="">
        <div class="card-body">
            <h5 class="card-title">Informacion del proyecto</h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->

            <div class="row">
                <div class="col-md-3">
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
                   <!-- <div class="col-md-3">
                    <label class="card-text fw-bold">Equipo:</label>
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
                </div> -->
                 <div class="col-md-3">
                    <label class="card-text fw-bold">Datos:</label>
                      <p class="">
                        Nombre del proyecto:
                        {{
                            construction.planification.name                        }}
                    </p>
                    <!-- <p class='d-flex'>
                        Status:
                            <p :class="[this.setClass(), 'fw-bold']">
                             {{
                             construction.planification.status
                        }}
                      </p>
                    </p> -->
                    <p class="">
                        Construccion numero: #{{ construction.id }}
                    </p>
                </div>
                 <div class="col-md-3">
                    <label class="card-text fw-bold">Equipo:</label>
                      <p class="">
                     Modelo:
                        {{
                            construction.planification.model.name                        }}
                    </p>
                     <p class="">
                     Serial:
                        {{
                            construction.planification.model.code                        }}
                    </p>
                        <p class="">
                     Tecnologia:
                        {{
                            construction.planification.technology[0].type                        }}
                    </p>
                    <!-- <p class='d-flex'>
                        Status:
                            <p :class="[this.setClass(), 'fw-bold']">
                             {{
                             construction.planification.status
                        }}
                      </p>
                    </p> -->
                    <p class="">
                        Construccion numero: #{{ construction.id }}
                    </p>
                </div>
                  <div class="col-md-3">
                    <div id='canvas'>

                        <div>
                            <canvas  id="myChart" width="600" height="400"></canvas>
                        </div>
                    </div>

                </div>
                 <div class="col-md-3">
                    <div id='canvas'>

                        <div>
                        <button class='btn btn-secondary' @click="download()">Descargar documentacion</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div>
        <div v-for='(task, i) in construction.answers' :key='task.id'>
            <div class='fw-bold'>
              {{ i+1 }})  {{ task.management.name }} ({{task.management.porcent}}%)
              <i @click="showMore(task.id)" class="fas fa-bars"></i>
            </div>

            <div class='fade-out d-none' :style="{
                transition:'all 1s'
            }" :ref='"container-"+task.id'>
                  <div v-for="(line, index) in task.lines" :key='line.id'  class='mx-4 mt-2'>
              <div class='d-flex flex-column mb-3'>
                    <label class='fw-bold' :for="'task'+line.task.id"> {{ `${i+1}.${index+1}) ` }}  {{   line.task.title  }} {{ line.task.porcent }}</label>
              <div class="row">
                    <!-- <input type="text" class='mt-2 col-md-2' :value='line.answer+"%"' disabled :id="'task'+line.task.id">
                  <span class=" mt-2 col-md-1">/</span>
                        <input type="text" class='mt-2 col-md-3' :value='line.task.porcent+"%"' disabled >
                        <span class=" mt-2 col-md-1">=</span> -->
                        <input type="text" class='mt-2 col-md-3' :value='Math.ceil(line.answer / line.task.porcent, 2)+"%"' disabled >
              </div>
              </div>
            </div>

            <div class='d-flex flex-row align-items-center mx-4 '>
                  <div clas='col-md-12'>

                    <!-- <input type="text" class='mt-2 col-md-1' :value='sumIndividualPercentages(task)+"%"' disabled >
                    <span class='fw-bold text-uppercase'>/ </span>
                    <input type="text" class='mt-2 col-md-1' :value='(task.management.porcent)+"%"' disabled >
                      <span class='fw-bold text-uppercase'>=</span> -->
                       <input type="text" class='mt-2 col-md-7' :value='"Avance: "+setTotalIndividualPercentages(task)+"%"' disabled >

                  </div>
            </div>
            </div>
            <hr>

        </div>
    </div>

</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Chart from "chart.js";
export default {
    props: ["construction", "managements"],
    layout: Dashboard,

    data(){
        return {
 totalPorcent:[],
    show:false,
        }
    },
    mounted() {
            this.construction.answers.forEach(a => this.sumIndividualPercentages(a))
            const ctx = document.getElementById("myChart");
            const _this = this

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
                    'red',

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
        showMore(id){
            this.$refs[`container-${id}`].classList.toggle('fade-in')
            this.$refs[`container-${id}`].classList.toggle('d-none')
        },
        setTotalIndividualPercentages({lines, management}){
             var percentage = 0;
           lines.forEach((line)=> {
                if(line.task){
                    percentage += Math.ceil(line.answer / line.task.porcent)
                }
            });



            return Math.ceil((percentage / management.porcent));
        },

        setTotalPercentage(){
        
            return !this.totalPorcent.length  ? 0 : Math.ceil(this.totalPorcent.reduce((previous, current) => parseInt(previous) + parseInt(current)));
        },

        sumIndividualPercentages({lines, management}){

            var percentage = 0;
           lines.forEach((line)=> {
                if(line.task){
                    percentage += Math.round((line.answer * line.task.porcent)/100)
                }
            });

            this.totalPorcent.push(Math.ceil((percentage  * management.porcent) /100));

            return ((percentage));

        },
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
          const porcent = this.setTotalPercentage()

            let obj = {
                original:0,
                faltante:100
            }
            obj.original = porcent;
            if(porcent <= 100){
                obj.faltante = 100 - porcent;
            }


            return obj

        },

        download(){
            const file = this.construction.planification.file
            if(file){
              let url  = file.file

              this.$download(this.access(url,true), `documentacion-${this.construction.planification.name}.zip`)
            }

        }
    }
};
</script>
