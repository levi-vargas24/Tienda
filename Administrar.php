<?php
include("Plantillas/Encabezado.php");
?>

<?php
$serverName = "localhost"; //IP O DOMINIO
$userName = "root";
$password = "";
$dbName = "tienda2022N";

//CRAR LA CONECCION 
$conn = new mysqli($serverName, $userName, $password, $dbName);
//verificar la coneccion
if ($conn->connect_error) {
  die("error al conectar:" . $conn->connect_error);
}
?>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>NOMBRE</th>
      <th>MARCA</th>
      <th>DETALLE</th>
      <th>PRECIO</th>
      <th>STOCK</th>
      <th>FOTO</th>
    </tr>

    <?php
    $consulta = "SELECT * FROM productos";
    $ejecutarConsulta = mysqli_query($conn, $consulta);
    $verFilas = mysqli_num_rows($ejecutarConsulta);
    $fila = mysqli_fetch_array($ejecutarConsulta);

    if (!$ejecutarConsulta) {
      echo "Error en la consulta";
    } else {
      if ($verFilas < 1) {
        echo "<tr><td>Sin registros</td></tr>";
      } else {
        for ($i = 0; $i <= $fila; $i++) {

          echo '
										<tr>
											<td>' . $fila[0] . '</td>
											<td>' . $fila[1] . '</td>
											<td>' . $fila[2] . '</td>
											<td>' . $fila[3] . '</td>
											<td>' . $fila[4] . '</td>
											<td>' . $fila[5] . '</td>
											<td>' . $fila[6] . '</td>
										</tr>
									';
          $fila = mysqli_fetch_array($ejecutarConsulta);
        }
      }
    }


    ?>
  </thead>
</table>

<button type="submit " class="btn btn-info" value="Insert" name="Operacion">Ingresar</button>
<button type="submit " class="btn btn-danger" value="Insert" name="Operacion">Eliminar</button>
<button type="submit " class="btn btn-success" value="Insert" name="Operacion">Actualizar</button>

