<?php
/// Powered by Evilnapsis go to http://evilnapsis.com
include "Admin/fpdf/fpdf.php";
include("Admin\BDD\Conexion.php");

$sql = "select * from detalles;";
    $result = $conn->query($sql);
    while($row =$result->fetch_assoc()){
        $idf=$row['idFactura'];
    }

$sql = "SELECT D.id,P.Nombre,D.Cantidad,P.Precio,D.Importe
FROM productos P
JOIN detalles D
ON D.idProducto = P.id
WHERE D.idFactura=$idf";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    $prueba=$row['Cantidad'];
    $ProductoArray = array(
        'id'=>$row['id'],
        'nombre' => $row['Nombre'],
        'cantidad' => $row['Cantidad'],
        'precio' => $row['Precio'],
        'total' => $row['Importe'],

    );
    $_SESSION["Tabla"][$row['id']] = $ProductoArray;
}

$sql = "SELECT C.Nombre,C.Apellido,C.Cedula,C.Telefono
FROM facturas F
JOIN clientes C
ON F.idCliente = C.id
WHERE F.id=$idf";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//print_r($_SESSION["Tabla"][19]['nombre']);

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B','50');    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Image('img\Productos/Logo.jpg',160,5,50,25);
$pdf->Cell(5,$textypos,"PETSHOP CORP.");
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"DE:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,"PETSHOP");
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,"QUITUMBE");
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,"0995320647");
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,"petshop@gmail.com");

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(75);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row["Nombre"]." ".$row["Apellido"]);
$pdf->setY(40);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row["Cedula"]);
$pdf->setY(45);$pdf->setX(75);
$pdf->Cell(5,$textypos,$row["Telefono"]);
/*$pdf->setY(50);$pdf->setX(75);
$pdf->Cell(5,$textypos,"Email del cliente");*/

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"FACTURA #".$idf);
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(135);
// Calculo de Fechas
$mifecha=date('d-m-Y');
$vencimiento=date("d-m-Y",strtotime($mifecha."+ 2 month")); 
$pdf->Cell(5,$textypos,"Emision: ".$mifecha);
$pdf->setY(40);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Vencimiento: ".$vencimiento);
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(65);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Descripcion","Cant.","Precio","Total");
//// Arrar de Productos


$products = array(
    
	array("Producto 1",2,120,0),
	array("Producto 2",5,80,0),
	array("Producto 3",1,40,0),
	array("Producto 3",5,80,0),
	array("Producto 3",4,30,0),
	array("Producto 3",7,80,0),
);
    // Column widths
    $w = array(95, 20, 25, 25);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $total = 0;


    $sql="SELECT D.id
    FROM facturas F
    JOIN detalles D
    ON D.idFactura = F.id
    WHERE F.id=$idf;";
    $result = $conn->query($sql);
    $id_comparar = array();
    $i=0;
    while($row = $result->fetch_assoc()){
        
        $id_comparar[$i] = $row['id'];
        $i++;
    }
    $i=0;
    $j=0;
    //print_r($id_comparar[0]);
    foreach ($_SESSION["Tabla"] as $e) {
        
        while($j<(count($id_comparar))){
            
        $pdf->Cell($w[0],6,$_SESSION["Tabla"][($id_comparar[$j])]['nombre'],1);
        $pdf->Cell($w[1],6,$_SESSION["Tabla"][($id_comparar[$j])]['cantidad'],'1',0,'R');
        $pdf->Cell($w[2],6,$_SESSION["Tabla"][($id_comparar[$j])]['precio'],'1',0,'R');
        $pdf->Cell($w[3],6,$_SESSION["Tabla"][($id_comparar[$j])]['total'],'1',0,'R');

        $pdf->Ln();
        $total+=$_SESSION["Tabla"][($id_comparar[$j])]['cantidad']*$_SESSION["Tabla"][($id_comparar[$j])]['precio'];
        $j++;

    }

    }
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 70 + (count($id_comparar)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
$header = array("", "");
$data2 = array(
	array("Subtotal",$total),
	array("Descuento", 0),
	array("Impuesto (%12) ", $total*0.12),
	array("Total", $total*1.12),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    

$pdf->setY($yposdinamic);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
$pdf->SetFont('Arial','',10);    

$pdf->setY($yposdinamic+10);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
$pdf->setY($yposdinamic+36);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"______________________________________");
$pdf->setY($yposdinamic+40);
$pdf->setX(35);
$pdf->Cell(5,$textypos,"Firma Cliente");


$pdf->Image('img\Productos/firma.png',100,$yposdinamic);
$pdf->setY($yposdinamic+36);
$pdf->setX(100);
$pdf->Cell(5,$textypos,"______________________________________");
$pdf->setY($yposdinamic+40);
$pdf->setX(125);
$pdf->Cell(5,$textypos,"Firma Aurorizada");

$pdf->setY($yposdinamic+50);
$pdf->setX(10);
$pdf->Cell(5,$textypos,"Powered by PetShop");


$pdf->output();