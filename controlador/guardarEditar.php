<?php

require_once '../modelo/MySQL.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$estado = $_POST['estado'];
$idUsuario = $_POST['idUsuario'];
$imagen = $_POST['imagen'];

$mysql= new MySQL();

$mysql -> conectar();

$consulta = $mysql->efectuarConsulta("UPDATE actividadjuancamilo.productos
    SET 
    actividadjuancamilo.productos.nombre_producto = '".$nombre."' ,
    actividadjuancamilo.productos.cantidad= '".$cantidad."',
    actividadjuancamilo.productos.estado = '".$estado."' ,
    actividadjuancamilo.productos.id_usuario = '".$idUsuario."' ,
    actividadjuancamilo.productos.imagen = '".$imagen."' WHERE id_producto = $id");

    $mysql -> desconectar();
        
    header("Location: ../productos.php");
?>
