
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>


    
    <div class="container-fluid contenidox">
      
        <div class="row  rowsito">
            <div class="col-3 login">
            <div class="col-12 head">
              <h1>Login</h1>
            </div>
            <div class="col-12 contentLogin">

  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post">
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Ingresa tu correo electronico</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Ingresa tu contraseña</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </div>
    <div class="col-12 botoncitos">
    <div class="col-6 btnRegis ">
  
    <button type="button" class="btn btn-primary boton"><a href="registrarse.php">Registrarse</a></button>
    
    </div>
    <div class="col-6 btnEnviar">
    <button type="submit" class="btn btn-primary" >Enviar</button>
    </div>

    </div>
   
  
    


    
   
    
<?php


if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['pass']) && !empty($_POST['pass'])) {


    require_once 'modelo/MySQL.php';
    require_once 'modelo/usuarios.php';
    session_start();
    $usuarios = new usuarios();

    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $faltanDatos = false;
    $passIncorrecta = false;
 
    $mysql = new MySQL();
    $mysql->conectar();
    $consultaId = $mysql->efectuarConsulta("SELECT id_usuario FROM actividadjuancamilo.usuarios WHERE actividadjuancamilo.usuarios.correo = '".$email."'");
    $idUsuario = mysqli_fetch_array($consultaId);
    
    $usuarios->setId($idUsuario['id_usuario']);
    $mysql->desconectar();

    $mysql->conectar();



    $usuarios = $mysql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.id_usuario ,
    actividadjuancamilo.usuarios.correo, actividadjuancamilo.usuarios.password FROM  actividadjuancamilo.usuarios where
    actividadjuancamilo.usuarios.correo= '" . $email . "' and  actividadjuancamilo.usuarios.password = '" . $pass . "' ");



    //se cuentan las filas de la consulta , por cada usuario que coincida es  una fila
    // si la consulta arroja 1 y es mayor a cero existe el usuario sino no
    $fila = mysqli_fetch_assoc($usuarios);


    if ($fila > 0) {
        //inicia sesion
        //session_star();
        //traiga el modelo 
        if (mysqli_num_rows($usuarios)) {
            session_start();

            require_once 'modelo/usuarios.php';

            $usuarios = new usuarios();

            $usuarios->setId($fila['id_usuario']);

            $_SESSION['usuario'] = $usuarios;

            $_SESSION['acceso'] = true;

            header("Location: productos.php");
        }
    } else {
      $passIncorrecta = true;
        $mysql->desconectar();
    }
} else {
    $faltanDatos= true;

    }
   ?>
 <?php
   echo '<script>
   Swal.fire({
    icon: "error",
    title: "Verifica tus datos",
    text: "¡El correo o contraseña no coincide!",
    showConfirmButton: true,
    confirmButtonText: "Cerrar"
    }).then(function(result){
       if(result.value){                   
        
       }
    });
   </script>';
 if ($faltanDatos) {
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

  



            </div>
           
            </div>
          
        </div>
      
    </div>
   



<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>

