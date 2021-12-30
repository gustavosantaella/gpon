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
        <th>INFRAESTRUCTURA</th>
        <th>FIBRA OPTICA</th>
        <th>RED LOCAL</th>
        <th>ENERGIA</th>
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
            :class="{ 'text-danger': this.printPorcent(management) === '0%' }"
            v-for="management in construction.managements"
            :key="management.id"
            v-html="this.printPorcent(management)"
          ></td>
          <td v-html="this.printGeneralPorcent(construction.managements)"></td>
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
  props: ["construction"],
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

    printPorcent(management) {
      if (management.tasks !== undefined && management.tasks.length) {
        let taskLength = management.tasks.length;
            let arr = [];
            let approved = [];
          let s=   management.answers.map((value, index) => {
          if (value.lines.length) {
            return value.lines.map((line) => {
              if (line.approved === true) {

                  approved.push(line)
                  return ((approved.length * 100) / taskLength).toFixed(0);
              }else return 0;

            });
          }
        });
        let porcent  =((approved.length * 100) / taskLength).toFixed(0)

        alert(s)
        this.porcent.total.push(porcent);

        return   porcent + '%'
      }

      return `0%`;
    },

    printGeneralPorcent(management) {
        //alert(this.porcent.total)
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
