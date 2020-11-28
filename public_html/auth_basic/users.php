<?php

class User 
{
    public $UID;
    public $login;
    public $username;
    public $hab;

    public function __construct($UID, $login, $username, $hab)
    {
        $this->UID = $UID;
        $this->login = $login;
        $this->username = $username;
        $this->hab = $hab;
    }
}

$usuariosListado =  [];

$lastUser = shell_exec('tail -1 /etc/passwd');
list($lastU, $contraseña, $uid, $gid, $extra) =  explode(":", $lastUser,5);
$i = 1;

do{
    $user = shell_exec('sed -n \''.$i.'p\' /etc/passwd');
    list($usuario, $contraseña, $uid, $gid, $extra) =  explode(":", $user,5);

    if(intval($uid) >= 1000){
        list($coment,,) = explode(":",$extra,3);
        list($name,$hab,$telWork,) = explode(",",$coment,4);
        
        $u = new User($uid,$usuario,$name, intval($hab));
        array_push($usuariosListado,$u);
        
    }
    $i = $i+1;
    if($lastU == $usuario){
        break;
    }
}while ( true );
//echo($result);

//$users = explode(" ", $result);

//echo($users);




?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gestión de Usuarios</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    

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
                <a class="nav-link" href="tables.php">
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
                <a class="nav-link" href="users.php">
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
                            
                            <div class="row">
                                <div class="col-5">
                                    <h3 class="m-0 font-weight-bold text-primary" style="display: inline;">Administración de usuarios</h3>
                                </div>
                                <div class="col-6">
                                    <form action="saveUser.php" method="post" enctype="multipart/form-data" id="import_form">
                                        <input type="file" accept=".csv" name="file" />
                                        <input type="submit" class="btn btn-info" name="import_data" value="Cargar CSV">
                                    </form>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-success"  onclick="openModal(false,'','','','')" data-toggle="modal" data-target="#userModal">
                                        agregar
                                    </button>
                                </div>
                            
                            
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <h4 style="color:orange;"><?php if(isset($_GET['msg'])){ echo($_GET["msg"]); } ?></h4>
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
            
                                        <?php foreach ($usuariosListado as $value){ ?>
                                        <tr>
                                            <td><?= $value->UID; ?></td>
                                            <td><?= $value->login; ?></td>
                                            <td><?= $value->username; ?></td>
                                            <td><?= $value->hab; ?></td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-primary" onclick="openModal(true,'<?= $value->UID; ?>','<?= $value->login; ?>','<?= $value->username; ?>','<?= $value->hab; ?>')" data-toggle="modal" data-target="#userModal">
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger" onclick="openModal(null,'<?= $value->UID; ?>','<?= $value->login; ?>','<?= $value->username; ?>','<?= $value->hab; ?>')">
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
                        
                        <span>Copyright &copy; Felipe Tejada - Sebastian Tabares 2020</span>
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
                <form class="user" action="saveUser.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="edition" name="edition" value="false">
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
            console.log(edition,UID,username,name,hab);
            if(edition){
                document.getElementById("UID").value = UID;
                document.getElementById("username").value = username;
                document.getElementById("username").readOnly = true;
                document.getElementById("name").value = name;
                document.getElementById("hab").value = hab;
                document.getElementById("edition").value = true;
            }else if(edition==false){
                document.getElementById("UID").value = '';
                document.getElementById("username").value = '';
                document.getElementById("username").readOnly = false;
                document.getElementById("password").value = '';
                document.getElementById("name").value = '';
                document.getElementById("hab").value = 0;
                document.getElementById("edition").value = false;
            }else{
                var dir = "saveUser.php?username="+username;
                console.log(dir)
                location.href=dir;
            }        
        }

    </script>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>