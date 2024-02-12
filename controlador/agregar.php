<?php 

if(isset($_POST['nombre']) && !empty($_POST['nombre']) && 
isset($_POST['cantidad']) && !empty($_POST['cantidad']) && 
isset($_POST['imagen']) && !empty($_POST['imagen']) )
{

    require_once 'modelo/MySQL.php';
    //capturo los datos 
    $nombre = $_POST['nombre'];
    $cantidad =  $_POST['cantidad'];
  
    $imagen = $_POST['imagen'];
    $id= $_POST['id'];
   
    $mySql  = new MySQL();

    $mySql ->conectar();

    $consulta = $mySql->efectuarConsulta("INSERT INTO actividadjuancamilo.productos 
    (`id_producto`, `nombre_producto`, `cantidad` , `imagen`, `estado`, `id_usuario`)
    VALUES(null,'".$nombre."','".$cantidad."','".$imagen."',1,'".$id."') ");


    $mySql -> desconectar();

    header("Location: productos.php");
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