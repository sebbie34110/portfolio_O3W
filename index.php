<?php
declare(strict_types=1);
require('ini.php');
require('class/Autoloader.php');
Autoloader::register();
$error_msg = '';

if (!isset($_SESSION['userLogin'])) {
  $_SESSION['userLogin'] = '';
}

$db = PDOManager::getInstance();

if (isset($_POST['login_submit'])) {
  $login = htmlentities($_POST['u_login']);
  $password = htmlentities($_POST['u_password']);

  if (empty($login) || empty($password)) {
    $error_msg = 'Veuillez entrer un login et un mot de passe';
  } else {
    $user = new UserManager($db);
    if ($user->loginSuccess($login, $password)==true) {
        $error_msg = 'Vous êtes connecté';

        session_start();
        $userData = $user->getUserData($login);

        $currentUser = new Users($userData);

        $_SESSION['userLogin'] = $currentUser->getLogin();

      // setter la session
    } else {
      $_SESSION['userLogin'] = null;
      $error_msg = 'Cet utilisateur n\'existe pas';
    }
  }
}

include('inc/header.php');
include('inc/logout.php');

?>


      <div class="message">
      <?php if($error_msg!==''){ ?>
      <p class="error_msg"><?= $error_msg ?></p>
      <?php } ?>
      </div>

  <!-- MAIN BODY -->
      <section class="banner">

      </section>

      <div class="wrapper">

          <section class="introduction">
              <h2>Présentation</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda at aut, ipsa laboriosam
                  magni nemo possimus provident quibusdam quo quos reiciendis repudiandae rerum tenetur, totam unde, voluptatibus.
                  Optio, recusandae? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda at aut, ipsa laboriosam
                  magni nemo possimus provident quibusdam quo quos reiciendis repudiandae rerum tenetur, totam unde, voluptatibus.
                  Optio, recusandae?</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur assumenda at aut, ipsa laboriosam
                  magni nemo possimus provident quibusdam quo quos reiciendis repudiandae rerum tenetur, totam unde, voluptatibus.
                  Optio, recusandae? Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
          </section>
          <section class="last_projects">
              <h2>Mes dernières réalisations</h2>
              <div class="realisations">
                  <!-- AFFICHER 5 DERNIERES REALISATIONS -->
              </div>
              <a class="button_style" href="realisations.php">Voir plus...</a>
          </section>

      </div> <!-- END OF WRAPPER -->

  <!-- FOOTER -->
<?php include('inc/footer.php');  ?>
