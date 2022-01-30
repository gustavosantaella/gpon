<template>
    <canvas id="myChart" width="400" height="200"></canvas>
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
        <tr v-for="construction in this.construction" :key="construction.id">
          <td>{{ construction.id }}</td>
          <td>{{ construction.planification.parish.municipality.state.name }}</td>
          <td>{{ construction.planification.parish.municipality.name }}</td>
          <td>{{ construction.planification.parish.name }}</td>
          <td>{{ construction.planification.name }}</td>
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
              'text-danger':
                this.printGeneralPorcent(construction.answers) == '0',
              'text-warning':
                this.printGeneralPorcent(construction.answers) == '50',
              'text-success':
                this.printGeneralPorcent(construction.answers) == '100',
            }"
          >
            {{ `${this.printGeneralPorcent(construction.answers)}%` }}
          </td>
          <td>
            <button
            v-show="!this.$page.props.flash.userManagement.construction"
              @click="this.redirectOnEdi(construction)"
              class="btn btn-sm btn-primary"
            >
              <i class="fas fa-edit"></i>
            </button>
              <button
              v-show=" this.hasRolesOrPermissions(
            'eliminar construccion',
            'user',
            'permissions'
          )"
              @click="this.destroy(construction)"
              class="btn btn-sm btn-danger"
            >
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </template>
    </datatable>

</template>
<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Datatable from "@/Partials/Datatable";
import AppForm from "@/Partials/AppForm";
import DialogModal from "@/Jetstream/DialogModal";
import Chart from "chart.js";
export default {
  name: "index",

  layout:Dashboard,

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

  mounted() {
    const _this = this;
    const ctx = document.getElementById("myChart");
    const myChart = new Chart(ctx, {
      type: "line",
      data: {
        tension: 0.1,
        labels: this.construction.map((construction) => construction.planification.name),
        datasets: this.managements.map((management) => {
          return {
            label: management.name,
             fill: false,
             tension: 0.1,
            borderColor: _this.randomColor(),
            data: this.construction.map((construction) =>
              this.printGeneralPorcent(construction.answers)
            ),
          };
        }),
      },
      options: {
        tooltips: {
          mode: "index",
          callbacks: {
            label: function (tooltipItem, data) {
              let label = data.datasets[tooltipItem.datasetIndex].label;
              let d =
                _this.construction[tooltipItem.index].answers[
                  tooltipItem.datasetIndex
                ] === undefined
                  ? 0
                  : _this.construction[tooltipItem.index].answers[
                      tooltipItem.datasetIndex
                    ].porcent;
              return `${label}: ${d}%`;
            },
          },
        },
        hover: {
          mode: "index",
        },
      },
    });
  },

  methods: {
    randomColor() {
      const randomBetween = (min, max) =>
        min + Math.floor(Math.random() * (max - min + 1));
      const r = randomBetween(0, 255);
      const g = randomBetween(0, 255);
      const b = randomBetween(0, 255);
    return`rgb(${r},${g},${b})`;
    },
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
      this.porcent.total.push(porcents);
      return porcents === undefined ? `0%` : `${porcents}%`;
    },

    printGeneralPorcent(answers) {
      if (answers !== undefined && answers.length)
        return Math.floor(
          answers.map((answer) => answer.porcent).reduce((a, b) => parseInt(a) + parseInt(b)) / this.managements.length
        ).toFixed(0);
      else return 0;
    },

    redirectOnEdi(construction) {
      let management = this.$page.props.flash.userManagement;

      let ruta = route("admin.modules.construcciones.edit", {
        construccione: construction.id,
      });
      this.$inertia.visit(ruta, {
         management: management.id,
       // management: management.id,
      });
    },

    destroy(construction){
        this.$destroyNotify(route('admin.modules.construcciones.destroy', {
            construccione: construction.id,
        }))
    }
  },
};
</script>

<style lang="css" scoped>
</style>
