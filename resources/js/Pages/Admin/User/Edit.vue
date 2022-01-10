<template>
  <h1>Crea o edita un usuario</h1>
  <hr />
  <div>
    <div>
        <form-user
        :managements="this.managements"
        :url="route('admin.usuarios.update', {
        	usuario:user.id
        })"
         method='put'
         :user="this.user"
        />
    </div>
  </div>
</template>

<script>
import Dashboard from "@/Pages/Admin/Dashboard";

import Form from './Form';
export default {
  layout: Dashboard,
  props: ["managements", "user"],
  components: {

    'FormUser':Form
  },

};
</script>
