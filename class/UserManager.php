<?php
declare(strict_types=1);


class UserManager
{


    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function loginSuccess(string $login, string $password)
  {
    $pdo = PDOManager::getInstance();

    $result = $pdo->makeSelect('
        SELECT u_login, u_password 
        FROM users 
        WHERE u_login = :login AND u_password = :password',
        ['login' => $login, 'password' => $password]);

    if (empty($result)) {
      return false;
    } elseif (strtolower($result[0]['u_login'])==$login && $result[0]['u_password'] == $password) {
      return true;
    }
    return false;
  }


    /**
     * @param string $login
     * @param string $prenom
     * @param string $nom
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function addUser(string $login, string $prenom, string $nom, string $email, string $password) : bool
  {
      $pdo = PDOManager::getInstance();


      $query = $pdo->makeStatement('
        INSERT INTO users (u_login, u_firstname, u_lastname, u_password, u_email) 
        VALUES(:u_login, :u_firstname, :u_lastname, :u_password, :u_email)', ['u_login' => $login, 'u_firstname' => $prenom, 'u_lastname' => $nom, 'u_password' => $password, 'u_email' => $email]);


      if($query !== false) {
        return true;
      }
    return false;
  }


    /**
     * @param string $login
     * @return array
     */
    public function getUserData(string $login) : array
    {
      $pdo = PDOManager::getInstance();

      $userData = $pdo->makeSelect('
          SELECT `u_id` AS `id`, `u_login` AS `login`, `u_firstname` AS `prenom`, `u_lastname` AS `nom`, `u_email` AS `email`, `u_role` AS `role` 
          FROM `users` WHERE `u_login`= :login', ['login' => $login]);

      return $userData;
    }

}
