<?php

declare(strict_types=1);


/**
 *
 */
class Users extends UserManager
{
  private $id;
  private $login;
  private $prenom;
  private $nom;
  private $email;
  private $role;



  function __construct(array $userData)
  {
    $this->hydrate($userData);
  }

  /*
   *        GETTERS
   */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }



    /*
    *          SETTERS
    */

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }


    /**
     * @param array $userData
     */
    public function hydrate(array $userData)
    {
        foreach ($userData as $key){
            foreach ($key as $field => $val) {

                $method = 'set' . ucfirst($field);

                if (method_exists($this, $method)){
                    $this->$method($val);
                }

            }

        }
    }










}
