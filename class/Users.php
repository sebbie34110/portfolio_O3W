<?php


/**
 *
 */
class Users extends UserManager
{

  private $login;


  function __construct($login)
  {
    $this->setLogin($login);
  }

  public function setLogin($login)
  {
    $this->login = $login;
  }

  public function getLogin()
  {
    return $this->login;
  }
}
