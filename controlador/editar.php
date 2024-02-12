<?php 


if(isset($_POST['nombre']) && !empty($_POST['nombre']) && 
isset($_POST['cantidad']) && !empty($_POST['cantidad']) && 
isset($_POST['estado']) && !empty($_POST['estado'])&& 
isset($_POST['idUsuario']) && !empty($_POST['idUsuario'])&& 
isset($_POST['imagen']) && !empty($_POST['imagen']) )
{ 

require_once '../modelo/MySQL.php';
$id = $_GET['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];
$fk_usuario = $_POST['idUsuario'];
$imagen = $_POST['imagen'];

    $mysql= new MySQL();

    $mysql -> conectar();
    
    $consulta = $mysql->efectuarConsulta("UPDATE actividadjuancamilo.productos
    SET 
    actividadjuancamilo.productos.nombre_producto = '".$nombre."' ,
    actividadjuancamilo.productos.cantidad= '".$cantidad."',
    actividadjuancamilo.productos.estado = '".$estado."' ,
    actividadjuancamilo.productos.id_usuario = '".$fk_usuario."' ,
    actividadjuancamilo.productos.imagen = '".$imagen."' WHERE id_producto = $id ");
    
    $mysql -> desconectar();
        
    header("Location: ../productos.php");
}
else
{
    // poner alerta 
    header("Location: ../editarProducto.php");
}


?>
