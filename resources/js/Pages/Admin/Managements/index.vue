<template>
  <Dashboard>
    <!-- <dialog-modal :id="'newManagement'">
      <template v-slot:content>
        <app-form
          method="post"
          :url="route('admin.gerencias.store')"
          :data="this.management"
          v-on:submitSuccess="this.success"
        >
          <template v-slot:content>
            <Form :data="this.management" />
          </template>
        </app-form>
      </template>
    </dialog-modal>
    <button
      @click="this.openModalNewManagement"
      class="btn btn-sm btn-danger fw-bold mb-2"
    >
      Crear nueva
    </button> -->
    <Datatable
      :url="route('admin.gerencias.index')"
      :filters="true"
      v-on:edit="this.edit"
      v-on:delete="this.delete"
      :items="this.managements"
      :th="[
        {
          original: 'id',
          text: 'id',
        },
        {
          original: 'name',
          text: 'nombre',
        },
      ]"
      :options="[
        {
          icon: 'fas fa-edit',
          method: 'edit',
          class: 'btn-primary',
          permission:  this.hasRolesOrPermissions(
              'editar unidad',
              'user',
              'permissions'
            ),
        },
        {
          icon: 'fas fa-trash',
          method: 'delete',
          class: 'btn-danger',
          permission: this.hasRolesOrPermissions(
            'eliminar unidad',
            'user',
            'permissions'
          ),
        },
      ]"
    >
    </Datatable>
  </Dashboard>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";
import Datatable from "@/Partials/Datatable";
import DialogModal from "@/Jetstream/DialogModal";
import Form from "@/Partials/Dashboard/Managements/Form";
import AppForm from "@/Partials/AppForm";
export default {
  components: {
    Dashboard,
    Datatable,
    DialogModal,
    Form,
    AppForm,
  },
  name: "index",
  props: ["managements", "prevOrNextPageName"],
  data() {
    return {
      modal: null,
      management: {
        name: null,
        position: null,
        acronym: null,
      },
    };
  },

  methods: {
    edit(item) {
      this.$inertia.visit(
        route("admin.gerencias.edit", {
          gerencia: item.id,
        })
      );
    },
    success() {
      this.modal.hide();
    },
    delete(item) {
      const _this = this;
      this.$swal({
        title: "Estas seguro?",
        text: "Si eliminas este registro, se eliminara permanentemente del sistema.",
        icon: "warning",
        dangerMode: true,
        showCancelButton: true,
      }).then((e) => {
        if (e.isConfirmed) {
          _this.$inertia.delete(
            route("admin.gerencias.destroy", {
              gerencia: item,
            })
          );
        }
      });
    },

    openModalNewManagement() {
      let element = document.getElementById("newManagement");
      let modal = new bootstrap.Modal(element);
      this.modal = modal;
      modal.show();
    },
  },
};
</script>

<style lang="css" scoped>
</style>
