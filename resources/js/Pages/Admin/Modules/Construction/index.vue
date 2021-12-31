<template>
  <Dashboard>
    <pre
      >{{ this.construction.data }}
	</pre
    >
    <datatable
      :items="this.construction"
      :url="route('admin.modules.planificaciones.index')"
      :showItems="true"
    >
      <template v-slot:th>
        <th>ID</th>
        <th>ESTADO</th>
        <th>MUNICIPIO</th>
        <th>PARROQUIA</th>
        <th>NOMBRE</th>
        <!-- <th>INFRAESTRUCTURA</th>
        <th>FIBRA OPTICA</th>
        <th>RED LOCAL</th>
        <th>ENERGIA</th> -->
        <th v-for="management in this.managements" :key="management.id">
          {{ management.name.replace("CONSTRUCCION", "") }}
        </th>
        <th>AVANCE</th>
        <th>OPCIONES</th>
      </template>
      <template v-slot:items>
        <tr
          v-for="construction in this.construction.data"
          :key="construction.id"
        >
          <td>{{ construction.id }}</td>
          <td>{{ construction.stateName }}</td>
          <td>{{ construction.munName }}</td>
          <td>{{ construction.parishName }}</td>
          <td>{{ construction.name }}</td>
          <td
            class="text-center fw-bold"
            :data-construction="`construction-porcent-${construction.id}`"
            :class="{
               'text-danger': this.printPorcent(construction, key) === '0%',
              'text-warning': this.printPorcent(construction, key) === '50%',
              'text-success': this.printPorcent(construction, key) === '100%',
            }"
            v-for="(management, key) of this.managements"
            :key="management.id"
            :ref="`construction-porcent-${construction.id}`"
            v-html="this.printPorcent(construction, key)"
          ></td>
          <td
            class="fw-bold text-center"
            :class="{
              'text-danger': this.printGeneralPorcent(construction.answers) === '0%',
              'text-warning': this.printGeneralPorcent(construction.answers) === '50%',
              'text-success': this.printGeneralPorcent(construction.answers) === '100%',
            }"
            v-html="this.printGeneralPorcent(construction.answers)"
          ></td>
          <td>
            <button
              @click="this.redirectOnEdi(construction)"
              class="btn btn-sm btn-primary"
            >
              <i class="fas fa-edit"></i>
            </button>
          </td>
        </tr>
      </template>
    </datatable>
  </Dashboard>
</template>
<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Datatable from "@/Partials/Datatable";
import AppForm from "@/Partials/AppForm";
import DialogModal from "@/Jetstream/DialogModal";
export default {
  name: "index",
  components: {
    Datatable,
    Dashboard,
  },
  props: ["construction", "managements"],
  data() {
    return {
      porcent: {
        total: [],
        general: 0,
      },
    };
  },

  methods: {
    edit(construction) {
      alert(JSON.stringify(construction));
    },
    show(construction) {
      alert(JSON.stringify(construction));
    },

    printPorcent(construction, key) {
      let order = construction.answers.sort(function (a, b) {
        return a.id - b.id;
      });
      let porcents = order.map((answer) => {

        return answer.porcent;
      })[key];
      return porcents === undefined ? `0%` : `${porcents}%`;
    },

    printGeneralPorcent(answers) {

       if(answers !== undefined && answers.length)
        return `${Math.floor(answers.map(answer => answer.porcent).reduce((a,b)=>a+b) / 4).toFixed(0)}%`
        else
        return 0+'%';


    },

    redirectOnEdi(construction) {
      let management = this.$page.props.flash.userManagement;

      let ruta = route("admin.modules.construcciones.edit", {
        construccione: construction.id,
      });
      this.$inertia.visit(ruta, {
        management: management.id,
      });
    },
  },
};
</script>

<style lang="css" scoped>
</style>
