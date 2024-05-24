<?php
require_once "session.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = mysqli_connect('localhost', 'daniel', 'madkam', 'madkam');
if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("Location: interfaz.php");
        exit;
}

$nombre = $_SESSION["nombre"];

$sql = "SELECT i.id, i.ruta FROM imagenes i JOIN usuarios u ON u.id = i.usuario_id WHERE u.nombre = '$nombre'";
$result = mysqli_query($conexion, $sql);
if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="interfaz.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>MADKAM</title>
     <link rel="icon" href="logo5.png" type="image/x-icon">
</head>
<body class="d-flex flex-column min-vh-100" style="background: #85858521;">
 <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
           <a class="navbar-brand"> <img src="logo5.png" width="40" height="40"></a>
          <a class="navbar-brand">MADKAM</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="interfaz.php">Imagenes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="Grabaciones.php">Grabaciones</a>
              </li>
              <li class="nav-item">
                 <button type="button" class="btn btn-secondary">
                <a class="nav-link active" aria-current="page" href="Streaming.php" style="padding-left: 1px;
                padding-right: 1px;
                padding-top: 1px;
                padding-bottom: 1px;">Streaming</a>
                </button>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
                          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg>
                      <h6><?php echo $nombre; ?></h6>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="reset-password.php">Restablecer Contraseña</a></li>
                      <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                  </ul>
              </li>
              </li>
            </ul>
            </form>
          </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <div class="container-fluid">
      <div class="row  pb-sm-5 pb-md-0">
         <div class="col-md-6 col-sm-12 mb-3">
          <p>Camara 1</p>
            <div class="ratio ratio-16x9">
                <img src="https://192.168.121.177/camera1">
            </div>
         </div>
         <div class="col-md-6 col-sm-12 mb-3">
          <p>Camara 2</p>
            <div class="ratio ratio-16x9  pb-sm-5 pb-md-0">
              <img src="https://192.168.121.177/camera2">
            </div>
         </div>
       </div>
</body>
<footer class="text-center text-lg-start bg-body-tertiary text-muted fixed-bottom mt-auto">
  <div class="row">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 MADKAM
  </div>
  </div>
</footer>
</html>
<?php
mysqli_close($conexion);
?>
