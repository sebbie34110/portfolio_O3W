<?php
declare(strict_types=1);
require('ini.php');
require('class/Autoloader.php');
Autoloader::register();
$error_msg = '';

// connexion database
$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_LOGIN, DB_PWD);

if (isset($_POST['login_submit'])) {
  $login = htmlentities($_POST['u_login']);
  $password = htmlentities($_POST['u_password']);

  if (empty($login) || empty($password)) {
    $error_msg = 'Please enter your login and password';
  } else {
    $user = new UserManager($db);
    if ($user->loginSuccess($login, $password)==true) {

      session_start();

      $error_msg = 'login successful';
      $currentUser = new Users($login);

      if(!isset($_SESSION['userLogin'])){
        $_SESSION['userLogin'] = $currentUser->getLogin();
      }

      // setter la session
    } else {
      $error_msg = 'User doesn\'t exists';
    }
  }
}

// LOGOUT

if ($_GET) {
  if ((int)$_GET['logout']=1) {
    session_unset();
    header('Location: index.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>LoginPage</title>
  </head>
  <body>
    <header>
      <?php if (!isset($_SESSION['userLogin'])){ ?>
        <form class="login" action="" method="post">
          <input type="text" name="u_login" value="" placeholder="Enter your login here">
          <input type="text" name="u_password" value="" placeholder="Enter your password here">
          <input type="submit" name="login_submit" value="Log in">
        </form>
        <a href="register.php">Register</a>
      <?php } else { ?>

        <nav>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
        <a href="index.php?logout=1">Log out</a>
      <?php } ?>
    </header>
    <div class="message">
     <?php if($error_msg!==''){ ?>
      <p class="error_msg"><?= $error_msg ?></p>
    <?php } ?>
    </div>
  </body>
</html>
