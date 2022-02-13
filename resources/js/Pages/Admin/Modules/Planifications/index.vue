<template>
  <Dashboard>
    <dialog-modal :id="this.modal.id">
      <template v-slot:title>Crear nuevo requerimiento</template>
      <template v-slot:content>
        <app-form
          v-on:submitSuccess="this.success"
          :data="this.form"
          :url="this.form.action"
          :method="this.form.method"
        >
          <template v-slot:content>
            <div>
              <div class="mb-3">
                <label for="states">Seleccione un estado</label>
                <select
                  @change="getMunicipalities()"
                  required
                  v-model="this.form.state_id"
                  id="states"
                  class="form-select"
                >
                  <option
                    v-for="state in this.states"
                    :key="state.id"
                    :value="state.id"
                  >
                    {{ state.name }}
                  </option>
                </select>
              </div>
              <div
                class="mb-3"
                @change="getParishes()"
                v-show="this.municipalities.length"
              >
                <label for="mun">Seleccione un municipio</label>
                <select
                  required
                  v-model="this.form.municipality_id"
                  id="mun"
                  class="form-select"
                >
                  <option
                    v-for="mun in this.municipalities"
                    :key="mun.id"
                    :value="mun.id"
                  >
                    {{ mun.name }}
                  </option>
                </select>
              </div>
              <div class="mb-3" v-show="this.parishes.length">
                <label for="mun">Seleccione una parroquia</label>
                <select
                  required
                  v-model="this.form.parish_id"
                  id="mun"
                  class="form-select"
                >
                  <option
                    v-for="parish in this.parishes"
                    :key="parish.id"
                    :value="parish.id"
                  >
                    {{ parish.name }}
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="model">Seleccione un equipo</label>
                <select
                  required
                  v-model="this.form.model_id"
                  id="model"
                  class="form-select"
                >
                  <option
                    v-for="model in this.models"
                    :key="model.id"
                    :value="model.id"
                  >
                    {{ model.name }}
                  </option>
                </select>
              </div>
              <div class="mb-3">
                <label for="name">Nombre del proyecto</label>
                <input
                  type="text"
                  v-model="this.form.name"
                  id="name"
                  class="form-control"
                />
              </div>
            </div>
          </template>
        </app-form>
      </template>
    </dialog-modal>
    <button
      v-show="this.hasRolesOrPermissions(
              'CREAR REQUERIMIENTO',
              'user',
              'permissions'
            )"
      class="btn btn-sm btn-secondary fw-bold"
      @click="this.openModal()"
    >
      Nuevo requerimiento
    </button>
    <datatable
      v-on:show="this.show"
      :items="this.planifications"
      :url="route('admin.modules.planificaciones.index')"
      :showItems="false"
      :th="[
        {
          original: 'id',
          text: 'id',
        },
        {
          original: 'name',
          text: 'nombre',
        },
        {
          original: 'stateName',
          text: 'estado',
        },
        {
          original: 'munName',
          text: 'municipio',
        },
        {
          original: 'parishName',
          text: 'parroquia',
        },
        {
          original: 'modelName',
          text: 'equipo',
        },
        {
          original: 'status',
          text: 'status',
        },
      ]"
      :options="[
        {
          text: 'editar',
          method: 'edit',
          class: 'btn-primary',
          permission: this.hasRolesOrPermissions(
            'EDITAR REQUERIMIENTO',
            'user',
            'permissions'
          ),
        },
        {
          text: 'delete',
          method: 'delete',
          class: 'btn-danger',
          permission: this.hasRolesOrPermissions(
            'ELIMINAR REQUERIMIENTO',
            'user',
            'permissions'
          ),
        },
        {
          text: 'Ver datos',
          method: 'show',
          class: 'btn-secondary',
          permission: this.hasRolesOrPermissions(
            'VER REQUERIMIENTO',
            'user',
            'permissions'
          ),
        },
      ]"
    >
    </datatable>
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
    AppForm,
    Datatable,
    DialogModal,
  },

  props: ["planifications"],
  data() {
    return {
      states: [],
      models: [],
      municipalities: [],
      parishes: [],
      form: {
        mehtod: null,
        action: null,
        state_id: null,
        municipality_id: null,
        parish_id: null,
        model_id: null,
        name: null,
      },
      modal: {
        open: false,
        id: "newRequeriment",
      },
    };
  },
  methods: {
    show(data) {
      this.$inertia.visit(
        route("admin.modules.planificaciones.show", {
          planificacione: data.id,
        })
      );
    },

    openModal() {
      this.getStates();
      this.getModels();
      this.form.method = "post";
      this.form.action = route("admin.modules.planificaciones.store");
      let element = document.getElementById(this.modal.id);
      let modal = new bootstrap.Modal(element);
      modal.show();
    },
    async getStates() {
      try {
        const response = await axios.get(route("admin.xhr.getStates"));
        this.states = response.data;
      } catch (e) {
        // statements
        alert(e.message);
      }
    },
    async getModels() {
      try {
        const response = await axios.get(route("admin.xhr.getModels"));
        this.models = response.data;
      } catch (e) {
        // statements
        alert(e.message);
      }
    },

    async getMunicipalities() {
      try {
        const response = await axios.get(
          route("admin.xhr.getMunicipalities", {
            state: this.form.state_id,
          })
        );
        this.municipalities = response.data;
      } catch (e) {
        // statements
        alert(e.message);
      }
    },
    async getParishes() {
      try {
        const response = await axios.get(
          route("admin.xhr.getParishes", {
            municipality: this.form.municipality_id,
          })
        );
        this.parishes = response.data;
      } catch (e) {
        // statements
        alert(e.message);
      }
    },

    success() {
      alert(123);
    },
  },
};
</script>
