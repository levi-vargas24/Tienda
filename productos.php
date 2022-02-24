<?php include("Plantillas/Encabezado.php");
include("Admin/BDD/Conexion.php");

$sql = "Select * from productos;";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<head>
    <title>Formulario de Productos</title>
</head>
<body>
<body style="background-color: #FFEFD5 ;">

<div class="container">
    <div class="row">
    <?php while($r = $result->fetch_assoc()){?>
    <div class="col-md-3">
        <div class="card text-left">
          <img class="card-img-top" src="img/Productos/<?php echo $r['foto'];?>" alt="">
          <div class="card-body">

            <h4 class="card-title">Nombre:<?php echo $r['nombre'];?> </h4>
            <h4 class="card-title">Marca:<?php echo $r['marca'];?> </h4>
            <h4 class="card-title">Detalle:<?php echo $r['detalle'];?> </h4>
            <h4 class="card-title">Precio:<?php echo $r['precio'];?> </h4>
            <h4 class="card-title">Stock:<?php echo $r['stock'];?> </h4>
            
          </div>
          </div>
          </div>
        <?php
    }
    $conn->close();
    ?>
        </div>
</div>

<?php include("Plantillas/pie.php");?>