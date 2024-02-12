<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {


        // Arial bold 15
        $this->SetFont('Times', 'B', 12);
        // Movernos a la derecha
        $this->Cell(50);
        // Título
        $this->Cell(160, 10, 'REPORTE DE PRODUCTOS', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(45, 20, 'id_producto', 1, 0, 'C', 0);
        $this->Cell(45, 20, 'nombre_producto', 1, 0, 'C', 0);
        $this->Cell(45, 20, 'cantidad_producto', 1, 0, 'C', 0);
        $this->Cell(45, 20, 'imagen_producto', 1, 0, 'C', 0);
        $this->Cell(45, 20, 'estado_producto', 1, 0, 'C', 0);
        $this->Cell(48, 20, 'correo_usuario', 1, 0, 'C', 0);
    }


    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
require_once '../modelo/MySQL.php';
require_once '../modelo/usuarios.php';


$mysql  = new MySQL();
$usuarios = new usuarios();
$mysql->conectar();

$consulta = $mysql->efectuarConsulta("SELECT *
FROM actividadjuancamilo.productos ");

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Times', 'B', 10);

while ($row = $consulta->fetch_assoc()) {
    $pdf->Ln();
    $pdf->Cell(45, 20, $row['id_producto'], 1, 0, 'C', 0);
    $pdf->Cell(45, 20, $row['nombre_producto'], 1, 0, 'C', 0);
    $pdf->Cell(45, 20, $row['cantidad'], 1, 0, 'C', 0);
    $url = $row['imagen'];
    $pdf->Cell(45, 20, $pdf->Image($url, $pdf->GetX(), $pdf->GetY(), 44.8, 20 ), 1, 0, 0,0 );
 
   


   if($row['estado']==0)
    {
        $inactivo = 'Inactivo';
        $pdf->Cell(45, 20, $inactivo, 1, 0, 'C', 0);
    }else{
        $activo = 'Activo';
        $pdf->Cell(45, 20, $activo , 1, 0, 'C', 0);
    }
    
  $consulta2 = $mysql->efectuarConsulta("SELECT actividadjuancamilo.usuarios.correo AS correo_usuario FROM actividadjuancamilo.usuarios WHERE actividadjuancamilo.usuarios.id_usuario = '".$row['id_usuario']."'") ;
   $result = $consulta2->fetch_assoc();

    $pdf->Cell(48, 20, $result['correo_usuario'], 1, 0, 'C', 0);
}
$pdf->Output();
