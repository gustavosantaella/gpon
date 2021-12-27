<template>
  <pre>
        {{ this.answers }}
    </pre
  >
  <Dashboard>
    <div>
      <div class='row'>
        <h1 class='col-md-5'>Revision de tareas</h1>
        <span class='rounded-pill text-white fw-bold col-md-2 d-flex justify-content-center align-items-center' :class="this.setStyleStatus()">{{this.planification.status}}</span>
      </div>
      <div v-for="answer in this.answers" :key="answer.id">
        <div>
          <h5>{{ answer.management.name }}</h5>
        </div>
        <div v-for="(line) in answer.lines" :key="line.id">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <ul>
                      <li class="fw-bold"> {{ line.task.title }}</li>
                  </ul>
                </div>
                <div class="col-md-9">
                  <button @click="this.approved(true, true, line.id)" class="btn ms-1 btn-sm btn-success">
                    <i class="fas fw-bold fa-check"></i>
                  </button>
                  <button @click="this.approved(false, true, line.id)" class="btn ms-1 btn-sm btn-danger">
                    <i class="fas fw-bold fa-times-circle"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3" v-if="line.task.field_type === 'file'">
                <button
                  @click="this.download(line)"
                  class="fw-bold btn btn-sm btn-secondary"
                >
                  Descargar archivo
                </button>
              </div>
              <div class="mb-3" v-else>
                <input
                  disabled
                  :value="line.answer"
                  :type="line.task.field_type"
                  class="form-control"
                />
              </div>
            </div>
          </div>
        </div>
        <hr />

      </div>
        <div v-show="this.checkStatusTasks()">
          <button v-show="this.planification.status !== 'APROBADO'" @click="this.approvedProject('APROBADO', this.planification.id)" class="fw-bold me-3 btn btn-sm btn-success">Aprobar</button>
          <button @click="this.approvedProject('RECHAZADO', this.planification.id)" class="fw-bold me-3 btn btn-sm btn-danger">Declinar</button>
          <button @click="this.approvedProject('POR REVISAR', this.planification.id)" v-show="this.planification.status !== 'POR REVISAR' && this.planification.status !== 'APROBADO'" class="fw-bold me-3 btn btn-sm btn-primary">Solicitar revision</button>
        </div>
    </div>
  </Dashboard>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Datatable from "@/Partials/Datatable";
import AppForm from "@/Partials/AppForm";
import DialogModal from "@/Jetstream/DialogModal";
export default {
  components: {
    Dashboard,
    DialogModal,
  },

  props: ["answers", "planification"],

  data() {
    return {
        tasks:{
            statusTasks:false,
        },
      modal: {
        id: "view_data",
        data: null,
      },
    };
  },

  methods: {
    setStyleStatus(){

      let status = {
        RECHAZADO:'bg-danger',
        APROBADO:'bg-success',
        INCOMPLETO:'bg-warning',
        "POR REVISAR":'bg-primary'
      }
      return status[this.planification.status]
    },
      checkStatusTasks(){

          const _this = this
          const array =  [];
            this.answers.map(function(value, index){
            return value.lines.map(function(value,index){
                    array.push(value.approved )
            })
        })
        return !array.includes(false) ? true : false;

      },

      approved(approved, answerIsLine, object_id){
          this.action(this, 'post', route('admin.answer.approved'), {
              approved,
              answerIsLine,
              object_id
          } )

      },

      approvedProject(approved, object_id){
        this.action(this, 'post', route('admin.modules.planificaciones.approved',{planificacione:object_id}), {
              approved,              
          } )
      },

    async download(data) {
      try {
        let response = await fetch(this.access(data.answer, true, true));
        const file = await response.blob();
        let link = document.createElement("a");
        link.href = URL.createObjectURL(file);
        link.setAttribute("download", "file.pdf");
        link.click();
        URL.revokeObjectURL(link.href);
        link.remove();
      } catch (error) {
        this.$swal("Ups!, ha sucedido un error", error.message, "error");
      }
    },
  },
};
</script>
