<?php

require("Admin/fpdf/fpdf.php");
$x=30;

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img\Productos/comida.jpg',200,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(40,10,'Ejercicio Levi',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF("L","mm","A4");//Inicializamos el objeto fpdf
$pdf->AddPage();//Agregamos una pagina
$pdf->SetFont('Arial','BIU',20);//Configuramos el tipo de letra
$pdf->SetTextColor(166,255,217);
$pdf->SetFont('Arial','BIU',15);

for($i = 0; $i<100;$i++){
    $pdf->Cell(40,10,'¡Hola, Mundo!');//Añadimos una celda de 40 de ancho * 10 de alto con mensaje Hola mundo
    $pdf->Ln(50);//Salto de linea
}
$pdf->Output();//Generamos el archivo
?>