<?php
require_once "session.php";
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Por favor, ingresa la nueva contraseña.";
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "La contraseña debe tener al menos 6 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }

    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirma la contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Validación y recuperación de la contraseña actual del formulario
    if(empty(trim($_POST["current_password"]))){
        $current_password_err = "Por favor, ingresa tu contraseña actual.";
    } else{
        $current_password = trim($_POST["current_password"]);
    }

    if(empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)){

        $sql = "SELECT contraseña FROM usuarios WHERE nombre = ?";

        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_nombre);

            $param_nombre = $_SESSION["nombre"];

            if($stmt->execute()){
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $stmt->bind_result($hashed_password);
                    if($stmt->fetch()){
                        if(md5($current_password) === $hashed_password){
                            // Contraseña actual verificada correctamente, permitir el cambio a una nueva contraseña
                            $sql = "UPDATE usuarios SET contraseña = ? WHERE nombre = ?";
                            if($stmt_update = $mysqli->prepare($sql)){
                                $stmt_update->bind_param("ss", $param_password, $param_nombre);
                                $param_password = md5($new_password); // Guardar la nueva contraseña de forma segura
                                $param_nombre = $_SESSION["nombre"];

                                if($stmt_update->execute()){
                                    echo "Contraseña actualizada.";
                                    session_destroy();
                                    header("location: index.php");
                                    exit();
                                } else{
                                    echo "Algo salió mal. Por favor, inténtalo de nuevo.";
                                }

                                $stmt_update->close();
                            }
                        } else{
                            $current_password_err = "La contraseña actual es incorrecta.";
                        }
                    }
                }
            } else{
                exit("Error al ejecutar la consulta SQL: " . $mysqli->error);
            }

            $stmt->close();
        }
    }
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anony>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></scr>    <link rel="stylesheet" href="restablecer.css">
    <title>Reestablecer Contraseña</title>
     <link rel="icon" href="logo5.png" type="image/x-icon">
</head>
<body style="background: #85858521;">
  <div class="container">
    <div class="col-md-12 col-md-12">
        <br>
        <div class="row">
            <div><img src="logo5.png" alt="logo">
                <br>
                <h2 class="col-md-12 col-sm-12">MADKAM</h2>
                <h2 class="col-md-12 col-sm-12">Cambia tu contraseña</h2>
                <p>Rellena el formulario para cambiar tu contraseña.</p>
            </div>
        </div>
    </div>
    <div class="wrapper col-md-12 col-sm-12">
        <br>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-4 col-auto">
                <label class="form-label">Contraseña actual</label>
                <input type="password" name="current_password" class="form-control <?php echo (!empty($current_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $current_password; ?>">
                <span class="invalid-feedback"><?php echo $current_password_err; ?></span>
            </div>
            <div class="mb-4">
                <label class="form-label">Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="mb-4">
                <label class="form-label">Confirma la contraseña</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Enviar">
                <a class="btn btn-link ml-2" onclick="goBack()" href="#">Cancelar</a>
            </div>
        </form>
    </div>
</body>
<script>
function goBack() {
  window.navigation.back();
}
</script>
</html>
