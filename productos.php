<?php
require_once 'modelo/usuarios.php';
require_once 'modelo/MySQL.php';
$mySql  = new MySQL();
session_start();
$usuarios = new usuarios();
$usuarios = $_SESSION['usuario'];
$id = $usuarios->getId();

$mySql->conectar();

$consulta = $mySql->efectuarConsulta("SELECT actividadjuancamilo.productos.id_producto ,
actividadjuancamilo.productos.nombre_producto ,
actividadjuancamilo.productos.cantidad ,
actividadjuancamilo.productos.imagen,
actividadjuancamilo.productos.estado ,
actividadjuancamilo.productos.id_usuario 

 FROM actividadjuancamilo.productos ");

$mySql->desconectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Users</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                
                <div class="sidebar-brand-text mx-3">Productos</div>
            </a>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tablas
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Productos</span>
                </a>
                
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="Tusuarios.php" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Usuarios</span>
                </a>
                
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
          

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="agregarProducto.php" 
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-car"></i>
                    <span>Agregar Producto</span>
                </a>
              
            </li>
          

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                <i class="fas fa-file-pdf"></i>
                    <span>Imprimir PDF</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="controlador/imprimir.php">
                <i class="fas fa-file-excel"></i>
                    <span>Imprimir Excel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                <i class="fas fa-power-off"></i>
                    <span>Sing Out</span></a>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

              

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabla Productos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                            <tr>
                               
                                <th scope="col">Id</th>
                                <th scope="col">name</th>
                                <th scope="col">cantidad</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Agrego el usuario con ID</th>
                                <th scope="col">imagen</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($consulta)) { ?>

                                <tr>
                                    
                                    <td> <?php echo $row['id_producto'] ?></td>
                                    <td> <?php echo $row['nombre_producto'] ?></td>
                                    <td> <?php echo $row['cantidad'] ?></td>
                                    
                                    <td> <?php 
                                    $estado = $row['estado'];
                                    if($estado==1){
                                        echo "Activo";  
                                    }
                                    else{
                                        echo "Inactivo";
                                    }
                                    ?></td>

                                    <td> <?php $idUsuario = $row['id_usuario'];
                                    $mySql->conectar();
                                    $consulta2 = $mySql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.nombre_usuario
                                     as nombre FROM actividadjuancamilo.usuarios where id_usuario = $idUsuario ");

                                     $nombre = mysqli_fetch_array($consulta2);
                                     echo $nombre['nombre'];
                                     
                                    ?></td>
                                    <td> <img src="<?php echo $row['imagen'] ?>" width="80px" height="80px" alt=""></td>
                                    <td>
                                        <form action="controlador/eliminarProducto.php? id=<?php echo $row['id_producto'] ?>" method="post">
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                        <br>
                                        <form action="./editarProducto.php? id=<?php echo $row['id_producto'] ?>" method="post">
                                            <button type="submit" class="btn btn-primary">Editar</button>
                                        </form>
                                    </td>

                                </tr>

                            <?php 
                            $mySql->desconectar();
                         } ?>
                        </tbody>
                                </table>
                            </div>
                        </div>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>