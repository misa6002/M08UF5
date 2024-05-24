<?php
    include "conexion.php";
    if(isset($_GET['id'])){
    $id = $_GET ['id'];
    $sql = "DELETE from usuarios where id=$id";
    if ($conexion->query($sql) === TRUE){
    } else{
	echo "Error". $conexion->error;
    }
}
    header('location:Admin1.php?delete');
    exit;
?>
