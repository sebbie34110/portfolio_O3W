<?php
declare(strict_types=1);
require('ini.php');
require('class/Autoloader.php');
Autoloader::register();


// connexion database
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_LOGIN, DB_PWD);

$error_msg = '';
$loginSatus = 'fail';

if (isset($_POST['submit_register'])) {

  $login = htmlentities($_POST['u_login']);
  $prenom = htmlentities($_POST['u_firstname']);
  $nom = htmlentities($_POST['u_lastname']);
  $email = htmlentities($_POST['u_email']);
  $password = htmlentities($_POST['u_password']);

  if (empty($login) || empty($password)) {
    $error_msg = 'Veuillez remplir tout les champs';
  } else {
    $newUser = new UserManager($db);
    if ($newUser->addUser($login, $prenom, $nom, $email, $password) !== false) {
      $loginSatus = 'success';
    } else {
      $error_msg = 'Login already exists';
    }
  }
}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register_style.css">
    <title>Register</title>
  </head>
  <body>
    <div class="wrapper">
      <?php if ($error_msg!==''): ?>
        <p class="error_msg"><?= $error_msg ?></p>
      <?php endif; ?>
      <form action="" method="post">
          <label for="login">Mon login :</label>
          <input type="text" id="login" name="u_login" value="" " required>

          <label for="firstname">Mon prénom :</label>
          <input type="text" id="firstname" name="u_firstname" value="" " required>

          <label for="lastname">Mon nom :</label>
          <input type="text" id="lastname" name="u_lastname" value="" " required>

          <label for="email">Mon adresse mail :</label>
          <input type="email" id="email" name="u_email" value="" " required>

          <label for="password">Votre mot de passe :</label>
          <input type="password" id="password" name="u_password" value="" " required>

          <input type="submit" name="submit_register" value="S'inscrire">
      </form>
      <?php if ($loginSatus=='success'): ?>
        <p class="login_success">Vous avez bien été enregisté!</p>
        <a href="index.php">Retour sur la page de connexion</a>
      <?php endif; ?>
    </div>
  </body>
</html>
