<template>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="header-nav">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 fw-bold" href="index.html">GPRA</a>
    <!-- Sidebar Toggle-->
    <button
      class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
      id="sidebarToggle"
      href="#!"
    >
      <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          id="navbarDropdown"
          href="#"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          ><i class="fas fa-user fa-fw"></i
        ></a>
        <ul
          class="dropdown-menu dropdown-menu-end"
          aria-labelledby="navbarDropdown"
        >
         <li class="dropdown-item" >{{ $page.props.auth.user.name }}</li>
          <li ><hr class="dropdown-divider" /></li>
          <li><a class="dropdown-item" href="#!">Settings</a></li>
          <li><a class="dropdown-item" href="#!">Activity Log</a></li>
          <li><hr class="dropdown-divider" /></li>
          <li> <span class="dropdown-item" @click="this.action(this, 'post', route('logout'))">Cerrar sesion</span></li>

        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <sidebar />
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-5 py-3">
          <pre>
{{$page.props.userManagement}}
          </pre>
          <slot></slot>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2021</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>
<style>
#nav-items .nav-link {
  color: #fff !important;
  text-decoration: none;
}

#header-nav{
  background: linear-gradient(184deg,#0606ec, #f2f2f2);
}
</style>

<script>
import Dropdown from "@/Jetstream/Dropdown";
import "@/../sb-admin/dash.css";
import "@/../sb-admin/js.js";
import Sidebar from "@/Partials/Dashboard/Sidebar";
  import NavLink from '@/Jetstream/NavLink'

export default {
  components: {
    Sidebar,
    NavLink
  },

};
</script>
