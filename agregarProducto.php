<?php
require_once 'modelo/usuarios.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
      
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/ProyectoUsuarios/assets/estiloAP.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>
<body class="bodyb">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 contentForm">
                <div class="col-4 form">
                    <div class="col-12 headF">
                        <h1>Agregar Productos</h1>
                    </div>
                    <div class="col-12 bodyF">
                    <form action="#" method="Post" id="formulario" enctype="multipart/form-data">
                        <div class="col-12 input">

                            <label for="exampleInputEmail1" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="nombre">
                        </div>
                        <div class="col-12 input">
                            <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                            <input type="text"  class="form-control" id="cantidad" name="cantidad">
                        </div>
                        <div class="col-12 input">
                            <label for="exampleInputPassword1" class="form-label">Imagen del producto (link)</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="imagen">
                            <div class="col-12 btnEx">
                            <input type="file" class="form-control" id="exampleInputPassword1" name="imgfile">
                            </div>
                           
                        </div>
                        <input type="hidden" class="form-control" value="<?php 
                        session_start();
                        $usuarios = new usuarios();
                        $usuarios = $_SESSION['usuario'];
                        $idUser = $usuarios->getId();
                       
                        echo $idUser; ?>" id="id" name="id">
                        <hr class="sidebar-divider">
                        <div class="col-12 botones">
                        <div class="col-6 btnAgregar">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                        <div class="col-6 btnCancelar">
                        <button type="button" class="btn btn-danger"><a href="productos.php">Cancelar</a></button>
                        </div>                        
                     
                        </div>
                     

                    </form>
                    </div>
                
                 

                

                </div>
            </div>
        </div>
    </div>

                <script src="/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php 

if(isset($_POST['nombre']) && !empty($_POST['nombre']) && 
isset($_POST['cantidad']) && !empty($_POST['cantidad']) ||
isset($_POST['imagen']) && !empty($_POST['imagen']) || isset($_FILES['imgfile']) && !empty($_FILES['imgfile']) )
{

    require_once 'modelo/MySQL.php';
    //capturo los datos 
    $nombre = $_POST['nombre'];
    $cantidad =  $_POST['cantidad'];
   
   
    $archivo = $_FILES['imgfile'];
    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $imgFile = $nombre.".".$extension;
    move_uploaded_file($archivo['tmp_name'], "./assets/image/$imgFile");


  
    $imagen = $_POST['imagen'];
    $id= $_POST['id'];
   
    $mySql  = new MySQL();

    $mySql ->conectar();
   
    if(empty($archivo['name'])){
    $consulta = $mySql->efectuarConsulta("INSERT INTO actividadjuancamilo.productos 
    (`id_producto`, `nombre_producto`, `cantidad`, `imagen`, `estado`, `id_usuario`)
    VALUES(null,'".$nombre."','".$cantidad."','".$imagen."',1,'".$id."') ");

header("Location: productos.php");
    }else if($imagen==''){

        $consulta = $mySql->efectuarConsulta("INSERT INTO actividadjuancamilo.productos 
        (`id_producto`, `nombre_producto`, `cantidad` , `imagen`, `estado`, `id_usuario`)
        VALUES(null,'".$nombre."','".$cantidad."','"."./assets/image/".$imgFile."',1,'".$id."') ");

    header("Location: productos.php");
    }
    else if(strlen($imagen)>0 && strlen($archivo['name'])>0){

        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Oops...",
         text: "Solo elija una imagen!",
         showConfirmButton: true,
         confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             
            }
         });
        </script>';

    }
    else if(strlen($imagen)==0 && strlen($archivo['name'])==0){



        echo '<script>
        Swal.fire({
         icon: "error",
         title: "Oops...",
         text: "Faltan Imagen de Producto!",
         showConfirmButton: true,
         confirmButtonText: "Cerrar"
         }).then(function(result){
            if(result.value){                   
             
            }
         });
        </script>';
    }
   
    
    


    $mySql -> desconectar();

   
}else
{
    echo '<script>
    Swal.fire({
     icon: "error",
     title: "Oops...",
     text: "Faltan datos!",
     showConfirmButton: true,
     confirmButtonText: "Cerrar"
     }).then(function(result){
        if(result.value){                   
         
        }
     });
    </script>';
}


?>