<template>
  <h1>Crea o edita un usuario</h1>
  <hr />
  <div>
    <div>
        <form-user
        :managements="this.managements"
        :url="route('admin.usuarios.store')"
         method='post'
        />
    </div>
  </div>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";

import Form from './Form';
export default {
  layout: Dashboard,
  props: ["managements"],
  components: {

    'FormUser':Form
  },

};
</script>
