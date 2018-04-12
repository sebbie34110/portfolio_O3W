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
  $password = htmlentities($_POST['u_password']);

  if (empty($login) || empty($password)) {
    $error_msg = 'Please fill all the fields';
  } else {
    $newUser = new UserManager($db);
    if ($newUser->addUser($login, $password) !== false) {
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
        <label for="login">Your login :</label>
        <input type="text" id="login" name="u_login" value="" placeholder="Ex: sebastien *" required>
        <label for="password">Your password :</label>
        <input type="password" id="password" name="u_password" value="" placeholder="(not 123 ...) *" required>
        <input type="submit" name="submit_register" value="Register">
      </form>
      <?php if ($loginSatus=='success'): ?>
        <p class="login_success">Registration successful</p>
        <a href="index.php">Back to log in page</a>
      <?php endif; ?>
    </div>
  </body>
</html>
