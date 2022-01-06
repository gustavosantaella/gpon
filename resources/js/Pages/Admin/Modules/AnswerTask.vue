<template>
  <pre>
	{{ $page.props.flash.userManagement }}
</pre
  >
  <Dashboard>
    <dialog-modal :id="'comment'" v-show='this.management.construction'>
      <template v-slot:title> Detalle </template>

      <template v-slot:content>
        <label for="modal-content">Comentario:</label>
        <textarea
          placeholder="Inserte algun comentario"
          cols="30"
          rows="10"
          id="modal-content"
          class="form-control"
          ref="observation"
        ></textarea>
        <button
          type="button"
          class="btn btn-secondary mt-2 fw-bold"
          ref="setObservationRef"
          @click="this.setObservation()"
        >
          Aceptar
        </button>
      </template>
    </dialog-modal>
    <div>
       <h1 class='fw-bold'> UNIDAD {{ this.management.name }}</h1>
          <hr />
    </div>

    <app-form
      :method="this.method"
      :data="this.form.data"
      :url="this.route"
      :formData="true"
      v-if="this.tasks.length"
    >
      <template v-slot:content>
        {{ this.route }} = {{ this.method }}
        <div v-for="(task, index) in this.tasks" :key="task.id" class="mb-3">
          <div class="row">
            <div class="col-md-11">
              <label class='fw-bold' :for="this.label(task)"> {{ ++index }}) {{ task.title }}</label>
              <div v-if="task.field_type === 'file'">
                <input
                  @change="this.setValue($event, task)"
                  :ref="this.label(task)"
                  :data-type="task.field_type"
                  :id="this.label(task)"
                  :type="task.field_type"
                  class="form-control"
                />
                <iframe :ref="this.label(task)" alt=""></iframe>
              </div>
              <div v-if="task.field_type === 'text'">
                <input
                  @change="this.setValue($event, task)"
                  :ref="this.label(task)"
                  :data-type="task.field_type"
                  :id="this.label(task)"
                  :type="task.field_type"
                  class="form-control"
                />
              </div>
              <div v-if="task.field_type === 'textarea'">
                <input
                  @change="this.setValue($event, task)"
                  :ref="this.label(task)"
                  :data-type="task.field_type"
                  :id="this.label(task)"
                  :type="task.field_type"
                  class="form-control"
                />
              </div>
              <div v-if="task.field_type === 'number'">
                <input
                  @change="this.setValue($event, task)"
                  :ref="this.label(task)"
                  :data-type="task.field_type"
                  :id="this.label(task)"
                  :type="task.field_type"
                  class="form-control ff"
                />
              </div>
              <div v-if="task.field_type === 'date'">
                <input
                  @change="this.setValue($event, task)"
                  :ref="this.label(task)"
                  :data-type="task.field_type"
                  :id="this.label(task)"
                  :type="task.field_type"
                  class="form-control"
                />
              </div>
            </div>
            <div class="col-md-1 fa-2x" v-show='this.management.construction'>
              <button
                @click="this.modalObsertvation(task)"
                type="button"
                :id="`comment-${task.id}`"
                class="mt-4 btn btn-sm btn-secondary"
              >
                <i class="fas fa-comment-dots"></i>
              </button>
            </div>
          </div>
        </div>
      </template>
    </app-form>
    <div v-else>
      <div class="alert alert-warning">
        Por favor, agregue al menos una tarea/actividad para poder rellenar este
        formulario
      </div>
    </div>
  </Dashboard>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import AppForm from "@/Partials/AppForm";
import DialogModal from "@/Jetstream/DialogModal";
export default {
  components: {
    Dashboard,
    AppForm,
    DialogModal,
  },

  props: ["tasks", "answer", "lines", "routeUrl", "management"],

  data() {
    return {
      route: route(this.routeUrl.store.url, this.routeUrl.store.params),
      method: "post",
      form: {
        data: {
          data: [],
        },
      },
    };
  },

  mounted() {
    this.setValueOnEDit;
  },
  computed: {
    async setValueOnEDit() {
      if (this.lines) {
        let params = {
          ...this.routeUrl.update.params,
          answer_id: this.answer.id,
        };
        this.route = route(this.routeUrl.update.url, params);
        this.method = "post";

        for (let line of this.lines) {
          let value;
          let search = `task-${line.task_id}`.trim();
          let ref = this.$refs[search];
          let elem = document.getElementById(search);
          let idComment = `comment-${line.task_id}`.trim();
          let btnComment = document.getElementById(idComment);
          if (line.observation)
            btnComment.setAttribute("data-observation", line.observation);
          if (line.approved === false) {
            elem.style.borderColor = "red";
          }
          if (elem.getAttribute("data-type") === "file") {
            try {
              let response = await fetch(this.access(line.answer, true));
              let blob = await response.blob();
              value = new File([blob], this.access(line.answer, true));
              ref.src = this.access(line.answer, true);
            } catch (e) {
              this.$swal("Ups!, ha sucedido un error", e.getMessage(), "error");
            }
          } else {
            value = ref.value = line.answer;
          }
          this.form.data.data.push({
            line_id: line.id,
            answer: value,
            task_id: parseInt(elem.id.replace("task-", "")),
            observation: btnComment.getAttribute("data-observation"),
          });
        }
      }
    },
  },
  methods: {
    modalObsertvation(task) {
      let btnComment = document.getElementById(`comment-${task.id}`);
      let modalElement = document.getElementById("comment");
      let modal = (this.modal = new bootstrap.Modal(modalElement));
      let observation = btnComment.getAttribute("data-observation");
      let content = document.getElementById("modal-content");
      this.$refs.setObservationRef.id = task.id;
      content.value = observation;

      modal.show();
    },
    setObservation() {
      let taskId = this.$refs.setObservationRef.id;
      let observation = this.$refs.observation.value;
      this.form.data.data.forEach((data) => {
        if (data.task_id == taskId) return (data.observation = observation);
      });

      this.modal.hide();
    },

    setValue(element, task) {
      let value;
      if (task.field_type === "file") {
        value = element.target.files[0];
        let s = URL.createObjectURL(value);
        this.$refs[this.label(task)].src = s;
      } else {
        value = element.target.value;
      }

      let result = this.form.data.data.filter((el) => {
        if (el.task_id === task.id) {
          el.answer =
            task.field_type === "file" ? element.target.files[0] : value;
          return el;
        }
      });
      if (!result.length)
        this.form.data.data.push({ answer: value, task_id: task.id });
    },

    label(task) {
      return `task-${task.id}`;
    },

    submit() {
      alert("envi");
    },
  },
};
</script>
