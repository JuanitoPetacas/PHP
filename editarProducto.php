<?php

require_once 'modelo/MySQL.php';
//capturo el dato 
$id = $_GET['id'];

$mysql = new MySQL();

$mysql->conectar();


$consulta = $mysql->efectuarConsulta("SELECT actividadjuancamilo.productos.nombre_producto,
actividadjuancamilo.productos.cantidad,
actividadjuancamilo.productos.imagen,
actividadjuancamilo.productos.estado,
actividadjuancamilo.productos.id_usuario
FROM actividadjuancamilo.productos WHERE id_producto= $id");


$fila = mysqli_fetch_array($consulta);
$fk_usuario= $fila['id_usuario'];

$mysql->desconectar();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/estilosEP.css">
    <title>Editar Producto</title>
</head>

<body class="bodyb">

    <div class="container">
        <div class="row">
            <div class="col-12 contentForm">
            <div class="col-4 form">
                <div class="col-12 headF">
                <h1>Editar Productos</h1>
                </div>
                <div class="col-12 bodyF">
                <form action="#" method="post">
                <div class="col-12 input">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" <label for="exampleInputPassword1" class="form-label">Nuevo Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre_producto'] ?>" id="nombre">
                    </div>
                    <div class="col-12 input">
                        <label for="exampleInputEmail1" class="form-label">Nueva Cantidad del Producto</label>
                        <input type="text" class="form-control" name="cantidad" value="<?php echo  $fila['cantidad'] ?>" id="cantidad" aria-describedby="emailHelp">
                    </div>
                    <div class="col-12 input">
                    <label for="exampleInputEmail1" class="form-label">Estado del producto</label>
                    <select class="form-select" name="estado" aria-label=" <?php
  if($fila['estado'] == 1 ){

    echo "Activo";
  }
  else{
    echo "Inactivo";
  }
  ?>" id="estado">

  <option value="1">Activo</option>
   <option value="2">Inactivo</option>
   </select>
                       
                    </div>
                  
                    <div class="col-12 input">
                            <label for="exampleInputPassword1" class="form-label">Imagen del producto (link)</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="imagen"
                            value="<?php echo  $fila['imagen'] ?>">
                           
                           
                        </div>

                  
                            <div class="col-12 botones">
                    <div class="col-6 btnAgregar">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    <div class="col-6 btnCancelar">
                    <button type="button" class="btn btn-danger"><a href="productos.php">Cancelar</a></button>
                    </div>

                </div>

                </div>
               
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php 


if(isset($_POST['nombre']) && !empty($_POST['nombre']) && 
isset($_POST['cantidad']) && !empty($_POST['cantidad']) && 
isset($_POST['estado']) && !empty($_POST['estado']) &&
isset($_POST['imagen']) && !empty($_POST['imagen']) )
{ 

$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$estado = $_REQUEST['estado'];
$imagen = $_POST['imagen'];
  

if($estado =="Activo"){

    $estado = 1;
}
else{
    $estado = 0;
}
$mysql -> conectar();
    
$consulta = $mysql->efectuarConsulta("UPDATE actividadjuancamilo.productos
SET 
actividadjuancamilo.productos.nombre_producto = '".$nombre."' ,
actividadjuancamilo.productos.cantidad= '".$cantidad."',
actividadjuancamilo.productos.estado = '".$estado."' ,
actividadjuancamilo.productos.id_usuario = '".$fk_usuario."' ,
actividadjuancamilo.productos.imagen = '".$imagen."' WHERE id_producto = $id ");

$mysql -> desconectar();
    
header("Location: productos.php");
    
}
else
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