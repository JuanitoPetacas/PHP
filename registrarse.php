<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sing in</title>

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/ProyectoUsuarios/styles.css">
   
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


    
    <div class="container-fluid contenidox">
      
        <div class="row  rowsito">
            <div class="col-3 login">
            <div class="col-12 head">
              <h1>Sign in</h1>
            </div>
            <div class="col-12 contentLogin">

  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post">
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Ingresa tu correo electronico</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="correo">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Ingresa tu nombre de usuario</label>
        <input type="text" class="form-control" id="exampleInputText1" name="nombre">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Ingresa tu contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    <div class="col-12 botoncitos">
    <div class="col-6 btnRegistrar">
  
    <button type="submit" class="btn btn-success" >Registrarse</button>
    
    </div>
    <div class="col-6 btnCancel">
    <button type="button" class="btn btn-danger" ><a href="index.php">Atras</a></button>
    </div>

    </div>
   
            </div>
           
            </div>
          
        </div>
      
    </div>
   



<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>


<?php

if(isset($_POST['correo']) && !empty($_POST['correo']) && 
isset($_POST['pass']) && !empty($_POST['pass']) && isset($_POST['nombre']) && !empty($_POST['nombre']))
{
    require_once 'modelo/MySQL.php';

    $correo = $_POST['correo'];
    $contrasena = md5($_POST['pass']);
    $nombre = $_POST['nombre'];

    
    $mysql = new MySQL();
    
    $mysql ->conectar();
    
    $validar = $mysql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.correo,
    actividadjuancamilo.usuarios.password
    FROM actividadjuancamilo.usuarios WHERE actividadjuancamilo.usuarios.correo = '".$correo."' " );
    
    
    
    if(mysqli_num_rows($validar) > 0)
    {
        echo '<script>
   Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "Este Correo ya existe",
    showConfirmButton: true,
    confirmButtonText: "Cerrar"
    }).then(function(result){
       if(result.value){                   
        
       }
    });
   </script>';
    
    }else{
    
        
        $consulta = $mysql->efectuarConsulta("INSERT INTO actividadjuancamilo.usuarios (`id_usuario`,`nombre_usuario`,`correo`,`password`,`estado`) values(NULL,'".$nombre."','".$correo."','".$contrasena."',1) ");
        $mysql -> desconectar();
        header("Location: index.php");
    }


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