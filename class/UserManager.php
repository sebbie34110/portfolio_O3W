<?php
declare(strict_types=1);


class UserManager
{

  protected $db;

  function __construct($db)
  {
    $this->setDb($db);
  }

  // SETTER pour la db
  public function setDb($db)
  {
    $this->db = $db;
  }



  /**
   * vérifie le mdp et login de l'utilisateur
   *
   */
  public function loginSuccess(string $login, string $password)
  {
    $query = $this->db->prepare('SELECT u_login, u_password FROM users WHERE u_login = :login AND u_password = :password');

    $query->bindValue('login', $login, PDO::PARAM_STR);
    $query->bindValue('password', $password, PDO::PARAM_STR);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
      return false;
    } elseif (strtolower($result[0]['u_login'])==$login && $result[0]['u_password'] == $password) {
      return true;
    }
    return false;
  }


  public function addUser($login, $password) : bool
  {
    $query = $this->db->prepare('INSERT INTO users(u_login, u_password)
    VALUES(:login, :password)');

    $query->bindValue('login', $login, PDO::PARAM_STR);
    $query->bindValue('password', $password, PDO::PARAM_STR);

    if ($query->execute() !== false) {
      return true;
    }
    return false;
  }
}
