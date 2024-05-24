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
// Verifica si se ha enviado el formulario de edición
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $rol_id = $_POST['rol_id'];
    $contraseña = $_POST['contraseña'];
    $id = $_POST['id'];

    // Actualiza la información del usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre=?, rol_id=? WHERE id=?";
    if($stmt = $conexion->prepare($sql)){
        $stmt->bind_param("ssi", $nombre, $rol_id, $id);
        if($stmt->execute()){
            // Redirige de nuevo a la página principal después de editar
            header("location: Admin1.php?editado");
            exit();
        } else{
            echo "Error al actualizar el usuario.";
        }
        $stmt->close();
    }
    $conn->close();
} else {
    // Muestra el formulario de edición con los datos actuales del usuario
    $id = $_GET['id'];
    $sql = "SELECT nombre, rol_id FROM usuarios WHERE id=?";
    if($stmt = $conexion->prepare($sql)){
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $stmt->store_result();
            if($stmt->num_rows == 1){
                $stmt->bind_result($nombre, $rol_id);
                $stmt->fetch();
            } else{
                echo "No se encontró ningún usuario con ese ID.";
            }
        } else{
            echo "Error al ejecutar la consulta.";
        }
        $stmt->close();
    }
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Usuarios.css">
    <title>Editar Usuario</title>
</head>
<body>
  <div class="container">
    <div class="col-md-12 col-md-12">
        <br>
        <div class="row">
            <div><img src="logo5.png" alt="logo">
                <br>
                <h2 class="col-md-12 col-sm-12">MADKAM</h2>
                <h2 class="col-md-12 col-sm-12">Editar Usuario</h2>
                <p>Rellena el formulario para Editar Usuarios.</p>
            </div>
        </div>
    </div>
    <div class="wrapper col-md-12 col-sm-12">
        <br>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-12 col-sm-12 text-center">
            <div class="mb-4 col-auto">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>">
            </div>
            <div class="mb-4">
                <label class="form-label">Rol</label>
                <input type="text" name="rol_id" class="form-control is-invalid" value="<?php echo $rol_id; ?>">
            </div>
            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control is-invalid">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Enviar">
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
