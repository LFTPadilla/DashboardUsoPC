<!DOCTYPE html>
<?php


?>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PROYECTO LINUX 1</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fab fa-ubuntu"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PROYECTO LINUX 1</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Inicio -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-house-user"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Dashboard
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficos</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tablas de procesos</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión de usuarios
            </div>
            <!-- Nav Item - Gestion de usuarios -->
            <li class="nav-item">
                <a class="nav-link" href="404.html">
                    <i class="fas fa-user-tie"></i>
                    <span>Gestionar Usuarios</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <br>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary" style="display: inline;">Administración de usuarios</h3>
                            
                            <button class="btn btn-success" style="float: right;" onclick="openModal(false,'','','','')" data-toggle="modal" data-target="#userModal">
                                agregar
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Page Heading -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>UID</th>
                                            <th>Login</th>
                                            <th>Nombres completo</th>
                                            <th>Habitación</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
                                        <?php foreach ($resultado as $value){ ?>
                                        <tr>
                                            <td><?= $value['UID']; ?></td>
                                            <td><?= $value['login']; ?></td>
                                            <td><?= $value['username']; ?></td>
                                            <td><?= $value['hab']; ?></td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-primary" onclick="openModal(true,'1000','felipe','Luis Felipe',1000)" data-toggle="modal" data-target="#userModal">
                                                    Edit
                                                </button>
                                                <button class="btn btn-warning">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario Usuario</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" action="php/saveUser.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="edition" value="false">
                        <div class="form-group row">
                            <div class="col-4 col-md-3 mb-3 mb-sm-0">
                                <input type="number" class="form-control form-control-user" id="UID" name="UID"
                                    placeholder="UID" disabled>
                            </div>
                            <div class="col-8 col-md-5">
                                <input type="text" class="form-control form-control-user" id="username" name="username"
                                    placeholder="Login">
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="password" class="form-control form-control-user" id="password" name="password"
                                    placeholder="Contraseña">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-12 col-md-9 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                placeholder="Nombre completo">
                            </div>
                            <div class="col-12 col-md-3">
                                <input type="number" class="form-control form-control-user" id="hab" name="hab"
                                placeholder="Número habitacion">
                            </div>
                        </div>
                            
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function openModal(edition,UID,username,name,hab){
            console.log(edition);
            if(edition){
                document.getElementById("UID").value = UID;
                document.getElementById("username").value = username;
                document.getElementById("name").value = name;
                document.getElementById("hab").value = hab;
                document.getElementById("edition").value = true;
            }else{
                document.getElementById("UID").value = '';
                document.getElementById("username").value = '';
                document.getElementById("password").value = '';
                document.getElementById("name").value = '';
                document.getElementById("hab").value = 0;
                document.getElementById("edition").value = false;
            }
            
        }

    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>