<?php
require('../../reportes/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    // $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(30);
    //color
    $this->SetTextColor(220,50,50);
    // Title
    $this->Cell(90,10,'Reporte de Ingresos',1,0,'C');
    // Line break
    $this->Ln(20);

    $this->Cell(50,10,utf8_decode("Cédula"), 1 , 0, 'C', 0);
    $this->Cell(50,10,"Hora", 1 , 0, 'C', 0);
    //$this->Cell(40,10,"Apellido", 1 , 0, 'C', 0);
    //$this->Cell(40,10,"Edad" , 1 , 0, 'C', 0);
    $this->Cell(50,10,"Imagen" , 1 , 1, 'C', 0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    
}
}

require ('../../servicios/conexion.php');
$query = "SELECT * FROM registro_empleado";
$result = $conn->query($query);

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->SetLeftMargin(28);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

  $ruta = "../../";

while($row = $result -> fetch_assoc()){

  $pdf->Cell(50,25,$row['CED_EMP'], 1, 0, 'C' );
  $pdf->Cell(50,25,$row['FECHA_ENTRADA'] , 1, 0, 'C' );   
  $pdf->Cell(50,25, $pdf->Image($ruta.$row['PATH'],$pdf->GetX()+10, $pdf->GetY()+3, 30,20,'png'), 1,1,'C');
  

}
$pdf->Output();
?>