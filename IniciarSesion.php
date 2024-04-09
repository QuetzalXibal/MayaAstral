<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /php-login");
    } else {
      $message = 'Sorry, those credentials do not match';
    }
  }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content=text/html; charset="UTF-8">
        <title>Form Login | Fast</title>
        <link href="css/Login.css" rel="stylesheet" type="text/css"/> <!--este solo es para llamar la carpeta de css -->        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>                          
    </head>
    <body text="#ffffff" > <!--en el body se le coloca background para poner un fondo a tu pagina web  -->   
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>     
        <div class="login-box"><!--este div es hacerca del login --> 
            <img class='avatar' src="Imagenes/Logo4.0.png" width="300" alt="" alt="Logo de FAzt"/>
            <h1>Inicia Secion</h1>
            <form action="MenuDesplegable.html">
                <label class="correo">Correo</label>               
                <input type="text" placeholder="ingresa tu correo" name="txtCorreo" class="EnterCorreo" maxlength="30"> <!--USERNAME-->                                     
                <label class="password">Contraseña</label>               
                <input type="password" placeholder="ingresa tu contraseña" name="txtPassword" class="EnterPassword" minlength="4" maxlength="13"><!--PASSWORD-->                                     
                <input  class="boton" type="submit" name="accion" value="LogIn"><!-- Boton-->
               <a class="a" href="RecuperarCuenta.html">¿Perdiste tu contraseña?</a>
               <a class="b" href="Registro.html">Create una cuenta nueva</a> 
            </form>                                                                  
        </div>          
    </body>
</html>
