<?php

include("Admin/BDD/Conexion.php");

if (isset($_POST["Enviar"]) && $_POST["Enviar"] === "Guardar") {
    
    $id = $_POST['idu'];
    $nombres = $_POST['nombres'];
    $apellidos= $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $aux=$_POST['clave'];
    echo $_POST['clave'];
    $clave = hash('sha256',md5($_POST['clave']));
    

  

    if (empty($id)) {
        $sql = "insert into usuarios(id,Nombres,Apellidos,Usuario,Clave)
    valueS ('null','$nombres','$apellidos','$usuario','$clave');";
  /*  } else {
        $sql = "update usuarios set nombres='$nombres',apellidos='$apellidos',
        usuario='$usuario',clave='$clave', where idu=$id;";
    */
    }

    if ($conn->query($sql)) {
        echo "<script>alert ('Datos guardados corresramnete');</script> ";
    } else {
        echo "<script>alert ('Error al Guardar');</script> ";
    }

    $conn->close();
} else if (isset($_POST["Enviar"]) && $_POST["Enviar"] === "Eliminar") {
    $id = $_POST["idu"];
    $sql = "delete from usuarios where id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert ('Datos eliminados');</script> ";
    } else {
        echo "<script>alert ('Intente nuevamente');</script> ";
    }
    $conn->close();
}

