<?php   
    session_start(); 

    $hoy=date("Y-m-d");
    if (!isset($_SESSION['usuario'])){
        echo '<script>window.location="login.php"</script>';
    }
    else{
        $user = $_SESSION['usuario'];
        $sql="SELECT * FROM usuarios where dni='$user' LIMIT 1";
        $resultado=mysqli_query($con,$sql);
        while($filas=mysqli_fetch_assoc($resultado)){
          $nom_usuario=$filas['nombre'];
        }
    } 
?>
<!DOCTYPE html>
<html>  
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GDS App</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="css/editor.dataTables.min.css">
    <style>
        /* Estilo para la capa de fondo */
         #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8); /* Fondo negro semitransparente */
            z-index: 9999; /* Asegúrate de que esté encima del contenido */
            display: flex; /* Usa flexbox para centrar el contenido */
            justify-content: center; /* Alinea horizontalmente al centro */
            align-items: center; /* Alinea verticalmente al centro */
            visibility: hidden; /* Oculto inicialmente */
            opacity: 0; /* Oculto visualmente */
            transition: opacity 0.3s, visibility 0.3s; /* Transiciones suaves */
        }
        
        #loader-container {
            position: relative; /* Necesario para posicionar el logo dentro del contenedor */
        }
        /* Estilo para el indicador de carga */
        #loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #00b5ac;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Centra el logo */
            width: 50px; /* Ajusta el tamaño del logo según sea necesario */
            height: 50px; /* Ajusta el tamaño del logo según sea necesario */
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-info elevation-4" style="background-color: #343a40;">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="images/logo1.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">GDS App Ocupacional</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="dist/img/usuario.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="panel.php?modulo=cambiar_clave" class="d-block"><?php echo $nom_usuario;?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php  if ($_SESSION['tipo_usuario']==1 || $_SESSION['tipo_usuario']==2 || $_SESSION['tipo_usuario']==3){ ?>
                        <li class="nav-item">
                            <a href="panel.php?modulo=inicio" class="nav-link active">
                            
                                <i class="nav-icon fas fa-th" aria-hidden="true"></i>
                                <p>Inicio</p>
                            </a>
                        </li>
                        <?php }?>


                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-copy" aria-hidden="true"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link <?php echo ($modulo == "") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>Ingresar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>





                        
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                <p>
                                    Mis Programaciones
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                               

                                <li class="nav-item">
                                    <a href="panel.php?modulo=programacion_ocupacional" class="nav-link <?php echo ($modulo == "programacion_ocupacional") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>Programaciones Ocupacional</p>
                                    </a>
                                </li>


                            </ul>
                        </li>





                        <?php  if ($_SESSION['tipo_usuario']==1){ ?>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                                <p>
                                    Maestros
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                               

                                <li class="nav-item">
                                    <a href="panel.php?modulo=ma_ocupacional_empresas" class="nav-link <?php echo ($modulo == "ma_ocupacional_empresas") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>EMPRESAS OCUPACIONAL</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="panel.php?modulo=ma_ocupacional_examenes" class="nav-link <?php echo ($modulo == "ma_ocupacional_examenes") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>EXAMENES OCUPACIONAL</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="panel.php?modulo=ma_ocupacional_protocolos" class="nav-link <?php echo ($modulo == "ma_ocupacional_protocolos") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>PROTOCOLO OCUPACIONAL</p>
                                    </a>
                                </li>


                            </ul>
                        </li>




                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-copy" aria-hidden="true"></i>
                                <p>
                                    Reportes
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="panel.php?modulo=rep_ventas_contasis" class="nav-link <?php echo ($modulo == "rep_ventas_contasis") ? " active " : " "; ?>">
                                        <i class="nav-icon fas fa-table" aria-hidden="true"></i>
                                        <p>Reporte Ocupacional</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        

                        <li class="nav-item">
                            <a href="salir.php" class="nav-link active">
                            
                                <i class="nav-icon far fa-circle text-danger" aria-hidden="true"></i>
                                <p>Salir</p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

            </div>

            <!-- /.sidebar -->
        </aside>
        <?php if (isset($_REQUEST['mensaje'])) : ?>
            <div class="alert alert-primary alert-dismissible fade show float-right" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?php echo $_REQUEST['mensaje'] ?>
            </div>
        <?php endif; ?>
        