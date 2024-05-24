<?php
require_once "session.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect('localhost', 'daniel', 'madkam', 'madkam');
if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: Admin1.php");
        exit;
}
    if (isset($_POST['submit'])) {
    // Obtener y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $rol_id = mysqli_real_escape_string($conexion, $_POST['rol_id']);
    $contraseña = "madkam"; // Reemplaza "tu_contraseña" con la contraseña deseada
    $contraseña_hashed = md5($contraseña);


    // Crear la consulta SQL para insertar el usuario
    $sql = "INSERT INTO usuarios (nombre, contraseña, rol_id) VALUES ('$nombre', '$contraseña_hashed', '$rol_id')";

    // Ejecutar la consulta y verificar si se insertó correctamente
    if (mysqli_query($conexion, $sql)) {
	header("Location: Admin1.php?creado");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Usuarios.css">
    <title>Nuevo Usuario</title>
</head>
<body>
  <div class="container">
    <div class="col-md-12 col-md-12">
        <br>
        <div class="row">
            <div><img src="logo5.png" alt="logo">
                <br>
                <h2 class="col-md-12 col-sm-12">MADKAM</h2>
                <h2 class="col-md-12 col-sm-12">Nuevos Usuarios</h2>
                <p>Rellena el formulario para Crear nuevos Usuarios.</p>
            </div>
        </div>
    </div>
    <div class="wrapper col-md-12 col-sm-12">
        <br>
        <br>
        <form action="" method="post" class="col-md-12 col-sm-12 text-center">
            <div class="mb-4 col-auto">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre" class="form-control" value="">
            </div>
            <div class="mb-4">
		<select class="form-select" aria-label="Default select example" name="rol_id">
  			<option value="1">Administrador</option>
  			<option value="2">Usuario</option>
		</select>
            </div>
            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control is-invalid">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Crear Usuario" name="submit">
                <a class="btn btn-link ml-2" onclick="goBack()" href="#">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</body>
<script>
function goBack() {
  window.navigation.back();
}
</script>
</html>