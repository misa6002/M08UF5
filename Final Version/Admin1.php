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
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conexion, $sql);
if (!$result) {
        die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}
$nombre = $_SESSION["nombre"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="admin.css">
    <link rel="icon" href="logo5.png" type="image/x-icon">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
         <a class="navbar-brand">MADKAM</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                     <h6 class="mb-0 px-2"><?php echo $nombre; ?></h6>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <a class="dropdown-item" href="reset-password.php">Restablecer Contraseña</a>
                     <a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </nav>
    <br>
    <br>
    <div class="col-sm-12 col-md-12 text-center">
            <img src="logo5.png" alt="logo madkam" class="imagen">
            <br>
                <h2 class="col-md-12 col-sm-12">MADKAM</h2>
    </div>
    <br>
    <div class="container-fluid">
        <div class="table-responsive-sm">
            <div class="table">
                <div class="table-title container-fluid">
                    <div class="row">
                        <div class="col"><h2>Tabla de <b>Usuarios</b></h2></div>
                        <div class="col text-right">
                            <a href="Usuari.php"><button type="button" class="btn btn-info add-new">Añadir Usuarios Nuevos.</button></a>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['rol_id']}</td>
            <td>
                <a class='edit btn-success' title='Edit' href='editar.php?id={$row['id']}'><button type='button' class='btn btn-primary add-new'>Editar</button></a>
                <a class='delete' href='Delete.php?id={$row['id']}' data-bs-toggle='tooltip'><button type='button' class='btn btn-danger'>Eliminar</button></a>
            </td>
        </tr>";
    }

    ?>
                    </tbody>
            </table>
            </div>
        </div>
    </div>
<?php
if(isset($_GET['delete'])){
echo "
<div class='alert alert-success' role='alert'>
Se ha eliminado correctamente el Usuario
</div>";
        }
if(isset($_GET['creado'])){
echo "
<div class='alert alert-success' role='alert'>
Se ha creado correctamente el Usuario
</div>";
        }
if(isset($_GET['editado'])){
echo "
<div class='alert alert-success' role='alert'>
Los datos del usuario se han editado correctamente
</div>";
        }
?>
    <footer class="text-center fixed-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                        © 2024 MADKAM
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

