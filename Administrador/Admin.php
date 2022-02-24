<?php 
include("Encabezado.php");
include("../Admin/BDD/Conexion.php");

    $sql = "Select * from productos;";
    $result = $conn->query($sql);

  //  header("Location: Login.php");

?>
<div class="container">
    <div class="row">
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>MARCA</th>
                    <th>DETALLE</th>
                    <th>PRECIO</th>
                    <th>STOCK</th>
                    <th>Foto</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php while($r = $result->fetch_assoc()){?>
                    <tr>

                        <td><?php echo $r['id'];?></td>
                        <td><?php echo $r['Nombre'];?></td>
                        <td><?php echo $r['Marca'];?></td>
                        <td><?php echo $r['Detalle'];?></td>
                        <td><?php echo $r['Precio'];?></td>
                        <td><?php echo $r['Stock'];?></td>
                        <td><?php echo $r['foto'];?></td>
                        <td>
                            <form action= "../ProductosCrud.php" method="POST">
                                <input type="hidden" name ="id" value="<?php echo $r['id'];?>">
                                <button type="submit" class="btn btn-danger" name="Enviar" value="Eliminar">Eliminar</button>
                            </form>
                        </td>

                        <td>
                            <form action= "../Ingreso.php" method="POST">
                                <input type="hidden" name ="id" value="<?php echo $r['id'];?>">
                                <button type="submit" class="btn btn-success" name="Enviar" value="Actualizar">Actualizar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    $conn->close();
                    ?>
                </tbody>
        </table>
    </div>
</div>
<?php include ("Pie.php")?>