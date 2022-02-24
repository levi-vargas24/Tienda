<?php
include("Admin/BDD/Conexion.php");
$ruta ="img/Productos/";//Guardar las fotos 

if(!$_SESSION['PERMISO']){
    header("Location: Admin.php");
}

if(isset($_POST["Enviar"]) && $_POST["Enviar"]==="Guardar"){

    $id =$_POST['id'];
    $nombres =$_POST['nombre'];
    $marca =$_POST['marca'];
    $detalle =$_POST['detalle'];
    $precio =$_POST['precio'];
    $stock =$_POST['stock'];
    $nombreArchivo = $_FILES["foto"]["name"];

    $ruta = $ruta.basename($_FILES["foto"]["name"]);
    if(!(move_uploaded_file($_FILES ["foto"]["tmp_name"],$ruta))){
        echo "Error al subir el archivo ";
        return false;
    }

   
    if(empty($id)){

    $sql="insert into productos (id, nombre,marca,detalle,precio,stock,foto) 
    VALUES (null,'$nombres','$marca','$detalle','$precio','$stock','$nombreArchivo');";
    }else{
        $sql="update productos set nombre = '$nombres',marca='$marca'
        ,detalle ='$detalle',precio = '$precio',stock = '$stock',foto ='$nombreArchivo' where id = $id;";
    }

    if($conn->query($sql)){
        echo"Datos guardados correctamente";
    }else{
        echo"Eror al guardar ";
    }

    $conn-> close();

}else if(isset($_POST["Enviar"]) && $_POST["Enviar"]==="Eliminar"){
    $id = $_POST ["id"];
    $sql="delete from productos where id = $id";

    if($conn->query($sql)){
        echo"Datos eliminados correctamente";
    }else{
        echo"Eror al eliminar ";
    }

    //$conn-> close();
}