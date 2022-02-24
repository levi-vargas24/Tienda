<?php 
include("Encabezado.php");
include("../Admin\BDD\Conexion.php");

$id = "";
$nombre = "";
$marca = "";
$detalle = "";
$precio = "";
$stock = "";
$foto = "";


if($_SERVER['REQUEST_METHOD']==="POST" AND isset($_POST) AND $_POST["Enviar"]==="Actualizar"){
    $id = $_POST["id"];

    $sql = "select* from productos where id= $id";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $id = $row["id"];
    $nombre = $row["Nombre"];
    $marca = $row["Marca"];
    $detalle = $row["Detalle"];
    $precio = $row["Precio"];
    $stock = $row["Stock"];
    $foto = $row["foto"];
}
?>

<div class="container">
    <div class="row">
    <div class="col-md-4">
        <form action="../IngresoDatos.php" method="POST" enctype="multipart/form-data">
           <label class="form-label"><h1>FORMULARIO TIENDA</h1></label>
        <br>
        <input type="hidden" name="auxiliar" value="<?php echo $foto ?>">
        <input type="hidden" name="id" value= "<?php echo $id?>"/>
        <label class="form-label">Ingrese el Nombre:</label>
        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre" value= "<?php echo $nombre?>"/>
        <label class="form-label">Ingrese la Marca:</label>
        <input type="text" name="marca" class="form-control" placeholder="Ingrese la Marca" value= "<?php echo $marca?>"/>
        <label class="form-label">Ingrese la descripción:</label>
        <input type="text" name="detalle" class="form-control" placeholder="Ingrese la descripcion" value= "<?php echo $detalle?>"/>
        <label class="form-label">Ingrese el precio:</label>
        <input type="text" name="precio" class="form-control" placeholder="Ingrese el precio" value= "<?php echo $precio?>" />
        <label class="form-label">Ingrese el valor de stock:</label>
        <input type="text" name="stock" class="form-control" placeholder="Ingrese el valor de stock" value= "<?php echo $stock?>" />
        <label class="form-label">Seleccione una foto</label>
        <h3>"<?php echo "foto: $foto"?></h3>
        <input type="file" name="foto" class="form-control" />
        <br> 
        <button type="submit" class="btn btn-secondary" name="Enviar" value="Guardar"/> Guardar</button>
        <br> <br>
        
        </form>
    </div>
    </div>
</div>
<!--llamar pie-->
<?php include("Pie.php");?>