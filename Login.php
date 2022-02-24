<?php 
include("Plantillas/Encabezado.php");
include("Admin/BDD/Conexion.php");


$_SESSION["PERMISO"] = false;
$_SESSION["NOMBRE"]= "";
$_SESSION["APELLIDO"]="";

if($_SERVER['REQUEST_METHOD']==="POST" AND isset($_POST) ){

    $usuario = $_POST["usuario"];
    $clave=hash('sha256',md5($_POST["clave"]));
    $sql= "select * from usuarios where Usuario = '$usuario' and clave = '$clave'; ";
    echo"Usuario: ".$usuario."clave: ".$clave ;
    $result = $conn ->query($sql);
    echo ($result ->num_rows);
    if($result ->num_rows == 1){
    
    $_SESSION["PERMISO"] = true;
    $_SESSION["NOMBRE"]= $row["nombres"];
    $_SESSION["APELLIDO"]=$row["apellidos"];

    header("Location:Administrador/Admin.php");
    echo "<script>
    alert ('Bienvenido');
    window.location.href= 'index.php';
    </script>";

    }else {
        echo "<script>alert ('Intente nuevamente');</script> ";
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form method = "POST">
                <label class="form-label">Bienvenidos</label>
                <label class="form-label">Ingrese su usuario</label>
                <input type="text" name="usuario" class="form-control "placeholder="Ingrese su usuario"/>
                <label class="form-label">Ingrese su clave</label>
                <input type="pasword" name="clave" class="form-control "placeholder="Ingrese su clave"/>
                <input type="submit" name="enviarLogin" class="btn btn-primary" value="enviar "/>
            </form>
        </div>
    </div>
</div>
<?php include ("Plantillas/pie.php")?>