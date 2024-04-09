<?php

  require 'BaseDeDatos.php';

  $message = '';

  if (!empty($_POST['correo']) && !empty($_POST['passw'])) {
    $sql = "INSERT INTO registro (correo, passw) VALUES (:correo, :passw)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $_POST['correo']);
    $password = password_hash($_POST['passw']);
    $stmt->bindParam(':passw', $passw);

    if ($stmt->execute()) {
      $message = 'has creado un usuario nuevo';
    } else {
      $message = 'Lo siento, debe haber habido un problema al crear su cuenta';
    }
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content=text/html; charset="UTF-8">
        <title>SignUp</title>
    <link href="css/Registro.css" rel="stylesheet" type="text/css"/>
    </head>
    <body text="#ffffff">
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

        <div class="login-box">
            <h1>Registrate</h1>      
                <span>o <a class="a" href="Login.html" > Inicia Secion</a></span>
                <form action="Login.html" method="POST">
                    <input name="usuario" type="text" placeholder="Introduce tu usuario">
                    <input name="correo" type="text" placeholder="Introduce tu correo">
                    <input name="passw" type="password" placeholder="Crea una contraseña">
                    <input name="c_passw" type="password" placeholder="Confirma tu contraseña">
                    <input class="btn btn-danger btn-block" class="boton" type="submit" value="Registra">
                </form>
        </div>
    </body>
</html>

