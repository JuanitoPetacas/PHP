<?php 
require_once '../modelo/MySQL.php';
//capturo el dato 
$id= $_GET['id'];

$mysql= new MySQL();

$mysql -> conectar();

$consulta = $mysql->efectuarConsulta("DELETE FROM actividadjuancamilo.productos WHERE id_producto= $id");

$mysql -> desconectar();
    
header("Location: ../productos.php");

?>