<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Acceuil</title>
</head>
<body>
<header>
  <nav>
    <ul>
      <li><a href="index.php">Acceuil</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="realisations.php">Realisations</a></li>
      <li><a href="cv.php">CV</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
  </nav>

  <?php if (!$_SESSION['userLogin']) {

    echo '<div class="login">
            <form action="" method="post">
                <input type="text" name="u_login" value="" placeholder="Mon login">
                <input type="text" name="u_password" value="" placeholder="Mon mot de passe">
                <input type="submit" name="login_submit" value="Connexion">
            </form>
            <a class="sign_in button_style" href="register.php">S\'inscrire</a>
          </div>';

  } else {


          echo '<div class="account_info">
                  <p>Welcome '.$_SESSION['userLogin'].'!</p>
                  <a class="button_style" href="index.php?logout=1">Log out</a>
                </div>';
  }
    ?>
</header>
