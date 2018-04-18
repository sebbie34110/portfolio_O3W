<?php

if ($_GET) {
  if ((int)$_GET['logout']=1) {
    session_unset();
    header('Location: index.php');
    exit();
  }
}
