<template>
  <pre>
        {{ this.answers }}
    </pre
  >
  <Dashboard>

    <div>
      <h1>Revision de tareas</h1>
      <div v-for="answer in this.answers" :key="answer.id">
        <div>
          <h5>{{ answer.management.name }}</h5>
        </div>
        <div v-for="(line, index) in answer.lines" :key="line.id">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <p class="fw-bold">{{ index + 1 }} - {{ line.task.title }}</p>
                </div>
                <div class="col-md-9">
                  <button class="btn btn-sm btn-success">
                    <i class="fas fw-bold fa-check"></i>
                  </button>
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fw-bold fa-times-circle"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3" v-if="line.task.field_type === 'file'">
                <button @click="this.download(line)" class="fw-bold btn btn-sm btn-secondary">Descargar archivo</button>
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
    DialogModal
  },

  props: ["answers"],

  data(){
      return {
          modal:{
              id:'view_data',
              data:null
          }
      }
  },

  methods: {
      async download(data){

        try {

            let response = await fetch(this.access(data.answer, true, true))
            const file = await response.blob()
            let link = document.createElement('a')
            link.href = URL.createObjectURL(file)
            link.setAttribute('download', 'file.pdf');
            link.click();
            URL.revokeObjectURL(link.href)
             link.remove();

        } catch (error) {
             this.$swal('Ups!, ha sucedido un error', error.message, 'error')
        }

      }
  },
};
</script>
