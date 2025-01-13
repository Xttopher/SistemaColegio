<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>SISTEMA DE NOTAS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/LogoAnexoHorizontal.png">

        <!-- jquery.vectormap css -->
        <link href="../assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />  

        <!-- Bootstrap Css -->
        <link href="../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="../assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../assets/css/estilo.css">


    </head>

    <body data-bs-theme="light" data-sidebar="light">  
        <!-- Begin page -->
        <div id="layout-wrapper" style="background-color: #7de193;">            
            <header  id="page-topbar" class="border-bottom" style="background-color: #7de193;">
                <div class="navbar-header barra">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box" style="background-color: #7de193;">                          
                            <a href="home.php" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="../assets/images/LogoAnexoVertical.png" alt="logo-sm-light" height="50">
                                </span>
                                <span class="logo-lg">
                                    <img src="../assets/images/LogoAnexoHorizontal.png" alt="logo-light" height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle c"></i>
                        </button>   
                        <!--<button id="boton-hover">¡Haz click aquí!</button> -->                  
                    </div>

                    <div class="d-flex">     
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <div class="page-title-right mt-4">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item fw-bolder"><a href="javascript: void(0);">USUARIO </a></li>
                                    <li class="breadcrumb-item fw-bolder text-uppercase"><?php echo $_SESSION['usuario']; ?></li>                                    
                                    <li class="breadcrumb-item fw-bolder text-uppercase"><?php echo $_SESSION['nom_perfil']; ?></li>
                                </ol>
                            </div>
                        </div>                
                         <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <i class="ri-fullscreen-line c"></i>
                            </button>
                        </div>                   
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect" onclick="salir();">
                                <i class="mdi mdi-power mdi-36px c"></i>
                            </button>
                        </div>
            
                    </div>
                </div>
            </header>
            <?php require_once 'menu.php';?>
<div class="main-content">
    <div class="page-content" >
        <div class="container-fluid" >        
            <!-- start page title -->
            <div class="row bg-light" >
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between" style="background-color: #7de193;">
                        <h2 class="mb-sm-0 mt-4"><strong>SIGMA - Módulo para Consulta de Evaluaciones</strong></h4>                        
                    </div>
                </div>
            </div>        
        </div>    
    </div>
<!-- ============================================================== -->
<!-- Pagina Superior -->
<!-- ============================================================== -->