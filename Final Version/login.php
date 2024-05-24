<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect('localhost', 'daniel', 'madkam', 'madkam');

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["username"];
    $contraseña = $_POST["password"];

    $contraseña_md5 = md5($contraseña);

    $query = "SELECT u.id, u.nombre, u.contraseña, r.nombre AS rol FROM usuarios u JOIN roles r ON u.rol_id = r.id WHERE u.nombre = '$nombre' AND u.contraseña = '$contraseña_md5'";
    $result = mysqli_query($conexion, $query);

    if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
    }

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);
        $rol = $usuario["rol"];
        $_SESSION["loggedin"] = true;
        $_SESSION["nombre"] = $usuario["nombre"];

        if ($rol === "Administrador") {
            header("Location: Admin1.php");
            exit;
        } elseif ($rol === "Usuario") {
            header("Location: interfaz.php");
            exit;
        }
    } else {
		//echo "Nombre de usuario o contraseña incorrectos.";
		header("Location: index.php?out");
	}
}

mysqli_close($conexion);
?>

