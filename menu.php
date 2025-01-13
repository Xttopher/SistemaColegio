<!-- ========== pagina Menu ========== -->
<div class="vertical-menu" style="background-color: #7de193;">

    <div data-simplebar class="h-120">

        <!--- Sidemenu -->
        <?php
        if ($_SESSION['tipo_usuario'] == "Administrador") {
            ?>
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title fs-5">Menu</li>

                    <li>
                        <a href="home.php" class="waves-effect fs-5">
                            <i class="ri-home-5-line"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="usuarioDatosPersonales.php" class="waves-effect fs-5">
                            <i class="ri-home-5-line"></i>
                            <span>Datos Personales</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect fs-5">
                            <i class="ri-account-circle-line"></i>
                            <span>Adminitración</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="usuarios.php" class=" fs-5"><i class="ri-user-settings-line"></i>Usuario</a></li>
                            <li><a href="AdminEstudiantes.php" class=" fs-5"><i class="ri-user-settings-line"></i>Estudiantes</a></li>
                            <li><a href="AdminMatricula.php" class=" fs-5"><i class="ri-group-line"></i>Matrícula</a></li>
                            <li><a href="AdminAñoAcademico.php" class=" fs-5"><i class="ri-user-settings-line"></i>Año Académico</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect fs-5">
                            <i class="ri-account-circle-line"></i>
                            <span>REPORTES</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="null.php" class=" fs-5"><i class="ri-user-settings-line"></i>Usuario</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
        if ($_SESSION['tipo_usuario'] == "Docente") {
            ?>
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title fs-5">Menu</li>

                    <li>
                        <a href="home.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarioDatosPersonales.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Datos Personales</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect fs-5">
                            <i class="ri-account-circle-line"></i>
                            <span>Evaluación</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="DocenteCursos.php" class="waves-effect fs-5">
                                    <i class="ri-home-4-line"></i>
                                    <span>Mis Cursos y Competencias</span>
                                </a>
                            </li>
                            <li>
                                <a href="NotasEstudiantes.php" class="waves-effect fs-5">
                                    <i class="ri-home-4-line"></i>
                                    <span>Notas Estudiantes</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
        if ($_SESSION['tipo_usuario'] == "Practicante") {
            ?>
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title fs-5">Menu</li>

                    <li>
                        <a href="home.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarioDatosPersonales.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Datos Personales</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect fs-5">
                            <i class="ri-account-circle-line"></i>
                            <span>Evaluación</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="DocenteCursos.php" class="waves-effect fs-5">
                                    <i class="ri-home-4-line"></i>
                                    <span>Mis Cursos</span>
                                </a>
                            </li>
                            <li>
                                <a href="NotasEstudiantes.php" class="waves-effect fs-5">
                                    <i class="ri-home-4-line"></i>
                                    <span>Notas Estudiantes</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="estudianteCursosPersonales.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Mis Cursos y Notas</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php
        }
        if ($_SESSION['tipo_usuario'] == "Estudiante") {
            ?>
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title fs-5">Menu</li>

                    <li>
                        <a href="home.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarioDatosPersonales.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Datos Personales</span>
                        </a>
                    </li>

                    <li>
                        <a href="usuarioResidencia.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Mi residencia y Salud</span>
                        </a>
                    </li>
                    <li>
                        <a href="usuarioSacramentos.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Sacramentos</span>
                        </a>
                    </li>
                    <li>
                        <a href="DatosFamiliares.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Datos Familiares</span>
                        </a>
                    </li>
                    <li>
                        <a href="DatosPadres.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Mis Padres</span>
                        </a>
                    </li>
                    <li>
                        <a href="DatosEmergencias.php" class="waves-effect fs-5">
                            <i class="ri-home-4-line"></i>
                            <span>Emergencias</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php
        }
        ?>



        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->