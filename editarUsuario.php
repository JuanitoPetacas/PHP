<?php

require_once 'modelo/MySQL.php';
//capturo el dato 
$id = $_GET['id'];

$mysql = new MySQL();

$mysql->conectar();


$consulta = $mysql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.id_usuario, actividadjuancamilo.usuarios.nombre_usuario,
actividadjuancamilo.usuarios.correo,
actividadjuancamilo.usuarios.password,
actividadjuancamilo.usuarios.estado
FROM actividadjuancamilo.usuarios WHERE id_usuario= $id");


$fila = mysqli_fetch_array($consulta);


$mysql->desconectar();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/estilosEU.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Editar Usuario</title>
</head>

<body class="bodyb">

    <div class="container">
        <div class="row">
            <div class="col-12 contentForm">
            <div class="col-4 form">
                <div class="col-12 headF">
                <h1>Editar Usuario</h1>
                </div>
                <div class="col-12 bodyF">
                <form action="#" method="post">
                <div class="col-12 input">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>" <label for="exampleInputPassword1" class="form-label">Nuevo Nombre del Usuario</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $fila['nombre_usuario'] ?>" id="nombre">
                    </div>
                    <div class="col-12 input">
                        <label for="exampleInputEmail1" class="form-label">Nuevo correo del Usuario</label>
                        <input type="text" class="form-control" name="correo" value="<?php echo  $fila['correo'] ?>" id="correo" aria-describedby="emailHelp">
                    </div>
                    <div class="col-12 input">
                        <label for="exampleInputEmail1" class="form-label">Nueva contraseña del Usuario</label>
                        <input type="text" class="form-control" name="pass" value="<?php echo  $fila['password'] ?>" id="pass" aria-describedby="emailHelp">
                    </div>
                    <div class="col-12 input">
                    <label for="exampleInputEmail1" class="form-label">Estado</label>
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
                  
    

                  
                            <div class="col-12 botones">
                    <div class="col-6 btnAgregar">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    <div class="col-6 btnCancelar">
                    <button type="button" class="btn btn-danger"><a href="Tusuarios.php">Cancelar</a></button>
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
isset($_POST['correo']) && !empty($_POST['correo']) && 
isset($_POST['pass']) && !empty($_POST['pass']) &&
isset($_POST['estado']) && !empty($_POST['estado']) )
{ 

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$pass = $_POST['pass'];
$estado = $_POST['estado'];
  echo $nombre;

if($estado =="Activo"){

    $estado = 1;
}
else{
    $estado = 0;
}



//verificacion de correo
$mysql->conectar();

$verificarCorreo = $mysql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.correo from actividadjuancamilo.usuarios where
 actividadjuancamilo.usuarios.correo = '".$correo."'");



$row = mysqli_fetch_array($verificarCorreo);
$mysql->desconectar();



if(strlen($row['correo'])>0){

    echo '<script>
    Swal.fire({
     icon: "error",
     title: "Oops...",
     text: "Este correo ya esta en uso!",
     showConfirmButton: true,
     confirmButtonText: "Cerrar"
     }).then(function(result){
        if(result.value){                   
         
        }
     });
    </script>';
}
else if(empty($row['correo'])){

    $mysql->conectar();
    $consulta2 = $mysql->efectuarConsulta("UPDATE actividadjuancamilo.usuarios
    SET 
    actividadjuancamilo.usuarios.nombre_usuario = '".$nombre."' ,
    actividadjuancamilo.usuarios.correo = '".$correo."',
    actividadjuancamilo.usuarios.password = '".$pass."' ,
    actividadjuancamilo.usuarios.estado = '".$estado."' WHERE id_usuario = $id ");
    $mysql->desconectar();
        

    header("Location: Tusuarios.php");
    

}



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