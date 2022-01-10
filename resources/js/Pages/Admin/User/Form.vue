<template>
  <app-form :url="url" :method="method" :data="form">
    <template v-slot:content>
      <div class="mb-4">
        <div class="row">
          <div class="col-md-4">
            <label class="fw-bold" for="name">Nombre y apellido  </label>
            <input
              class="form-control"
              v-model="form.name"
              type="text"
              id="name"
            />
          </div>
          <div class="col-md-4">
            <label class="fw-bold" for="email">Correo</label>
            <input
              class="form-control"
              v-model="form.email"
              type="email"
              id="email"
            />
          </div>
          <div class="col-md-4">
            <label class="fw-bold" for="number">P00</label>
            <input
              class="form-control"
              v-model="form.dni"
              type="number"
              id="number"
            />
          </div>
        </div>
      </div>
      <div class="mb-4">
        <label class="fw-bold" for="management">Seleccione una unidad</label>
        <select v-model='form.management_id' class='form-select' lass="form-select" name="" id="management">
          <option
            v-for="management in this.managements"
            :key="management.id"
            :value="management.id"
          >
            {{ management.name }}
          </option>
        </select>
      </div>
    </template>
  </app-form>
</template>

<script>
import AppForm from "@/Partials/AppForm";
export default {
  components: {
    AppForm,
  },
  props: ["url", "method", "managements", "user"],
  data() {
    return {
      form: {
        name: null,
        email: null,
        dni: null,
        management_id:null
      },
    };
  },

  mounted() {
   
   if(this.user !== undefined) this.setValues();
  },

  methods: {
    setValues() {
      
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.dni = this.user.dni;
      this.form.management_id = this.user.management.id
    },
  },
};
</script>
