<?php 
require_once '../modelo/MySQL.php';
//capturo el dato 
$id= $_GET['id'];

$mysql= new MySQL();

$mysql -> conectar();

$consulta = $mysql->efectuarConsulta("DELETE FROM actividadjuancamilo.usuarios WHERE id_usuario= $id");

$mysql -> desconectar();
    
header("Location: ../Tusuarios.php");

?>