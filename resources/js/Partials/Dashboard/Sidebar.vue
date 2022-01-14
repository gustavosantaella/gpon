<template>
	<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <nav-link :navlink="false" :href='route("admin.home")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </nav-link>
                        <div class="sb-sidenav-menu-heading">Modulos</div>

			             <nav-link :navlink="false" :href='route("admin.modules.planificaciones.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Planificaciones
                        </nav-link>

                        <nav-link :navlink="false" :href='route("admin.modules.fibra-optica.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Fibra Optica
                        </nav-link>
                         <nav-link :navlink="false" :href='route("admin.modules.red-local.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Red local
                        </nav-link>
                          <nav-link :navlink="false" :href='route("admin.modules.energia.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Energia
                        </nav-link>
                             <nav-link :navlink="false" :href='route("admin.modules.infraestructura.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Infraestructura
                        </nav-link>
                        <nav-link
                        v-show="this.hasRolesOrPermissions('LISTAR CONSTRUCCIONES','user','permissions')"
                         :navlink="false" :href='route("admin.modules.construcciones.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Construcciones
                        </nav-link>




                        <div class="sb-sidenav-menu-heading">Equipos</div>

                        <nav-link :navlink="false" :href='route("admin.proveedores.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Proveedores
                        </nav-link>
                        <nav-link :navlink="false" :href='route("admin.modelos.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Modelos
                        </nav-link>

                        <div class="sb-sidenav-menu-heading">Cantv</div>

                         <nav-link :navlink="false" :href='route("admin.usuarios.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Usuarios
                        </nav-link>

                        <nav-link :navlink="false" :href='route("admin.usuarios.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Centrales
                        </nav-link>
                        <nav-link :navlink="false" :href='route("admin.gerencias.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Unidades
                        </nav-link>
                        <nav-link   :navlink="false" :href='route("admin.roles.index")'>
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Roles
                        </nav-link>



                        <div class="sb-sidenav-menu-heading">Ubicacion</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#territorio"
                           aria-expanded="false" aria-controls="territorio">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Territorios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="territorio" aria-labelledby="headingOne"
                             data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">REGIONES</a>
                                <a class="nav-link" href="layout-sidenav-light.html">ESTADOS</a>
                                <a class="nav-link" href="layout-sidenav-light.html">MUNICIPIO</a>
                                <a class="nav-link" href="layout-sidenav-light.html">PARROQUIAS</a>
                            </nav>
                        </div>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
</template>

<script>
	import NavLink from '@/Jetstream/NavLink'
	export default{
		components:{
			NavLink
		},
	}
</script>
