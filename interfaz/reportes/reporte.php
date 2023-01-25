
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
    $this->Cell(70,10,'Reporte de Empleados',1,0,'C');
    // Line break
    $this->Ln(20);

    $this->Cell(30,10,utf8_decode("Cédula"), 1 , 0, 'C', 0);
    $this->Cell(40,10,"Nombre", 1 , 0, 'C', 0);
    $this->Cell(40,10,"Apellido", 1 , 0, 'C', 0);
    $this->Cell(40,10,"Edad" , 1 , 0, 'C', 0);
    $this->Cell(40,10,"Imagen" , 1 , 1, 'C', 0);
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
// $query = "SELECT * FROM empleado WHERE CED_EMP IN (SELECT CED_EMP FROM registro_empleado WHERE CASCO = 1)";
$query = "SELECT * FROM registro_empleado";
$result = $conn->query($query);

// Instanciation of inherited class
$pdf = new PDF('P','mm','A4');
$pdf->SetLeftMargin(28);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
      $ano_diferencia--;
    return $ano_diferencia;
  }

  $fill = $pdf->SetFillColor(128,128,128);


  $fill = false;
  
  $ruta = "../../";

while($row = $result -> fetch_assoc()){

    $pdf->Cell(30,10,$row['CED_EMP'],'LR',0,'L',$fill );
    $pdf->Cell(40,10,$row['FECHA_ENTRADA'] ,'LR',0,'L',$fill );     
    $pdf->Cell(40,10, $row['CASCO'] , 'LR',0,'L',$fill);
    $pdf->Cell(40,10,$row['BOTAS'], 'LR',0,'L',$fill);    
    $pdf->Cell(40,10, $pdf->Image($ruta.$row['PATH'],null,null,20,20,'png') , 'LR',1,'L',$fill);    
    $fill = !$fill;

}
$pdf->Output();
?>

