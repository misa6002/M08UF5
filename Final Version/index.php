<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Iniciar sesión</title>
     <link rel="icon" href="logo5.png" type="image/x-icon">
</head>
<body style="background: #85858521;">
    <div class="container">
        <div class="col-md-12 col-sm-6">
            <br>
            <div class="row">
                <div class="imagen"><img src="logo5.png" alt="logo">
                <br>
                <h2 class="col-md-12 col-sm-6">MADKAM</h2>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <br>
                <br>
                <br>
                <h1 class="iniciar">Iniciar sesión en Madkam</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <form method="post" action="login.php">
                    <br>
                    <br>
                    <div class="mb-4">
                      <label for="username" class="form-label"></label>
                      <input required type="text" class="form-control-lg  form-control-sm" id="username" name="username" placeholder="Nombre de Usuario">
                    </div>
                    <div class="mb-4">
                      <label for="password" class="form-label"></label>
                      <input required type="password" class="form-control-lg form-control-sm" id="password" name="password" placeholder="Contraseña">
                    </div>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                  </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>
