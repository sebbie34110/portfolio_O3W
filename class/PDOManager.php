<?php
declare(strict_types=1);

/**
 * Gestion de l'instance de PDO
 *
 * Class PDOManager
 */
class PDOManager
{
    protected $pdo;
    private static $instance;

    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_LOGIN, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Singleton pour récuperer l'instance de ma propre classe
     *
     * @return PDOManager
     */
    public static function getInstance(): PDOManager {
        if(self::$instance == null) {
            self::$instance = new PDOManager();
        }

        return self::$instance;
    }


    //Generates a PDOStatement using query or prepare, depending on $params composition
    //$sql is your query
    //$params is an associative array with the form 'placeholderName'=>value. Defaults to empty
    public function makeStatement(string $sql, array $params = array()) : PDOStatement {
        if(!$params) {
            $statement = $this->pdo->query($sql);

            if ($statement === false) {

                $message = "query n'a pas marché";
                throw new Exception($message);
            }
        } elseif (($statement = $this->pdo->prepare($sql)) !== false) {

            foreach ($params as $placeholder => $value) {
                if (is_array($value)) {
                    if ($statement->bindValue($placeholder, $value == '' ? null : $value[0], $value[1]) === false) {
                        $message = "bindValue n'a pas marché";
                        throw new Exception($message);
                    }

                } elseif ($statement->bindValue($placeholder, $value == '' ? null : $value) === false) {
                    $message = "bindValue n'a pas marché";
                    throw new Exception($message);
                }
            }
        }

        if (!$statement->execute()) {
            $message = "execute n'a pas marché";
            throw new Exception($message);
        }

        return $statement;
    }


    public function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    {
        $statement = $this->makeStatement($sql, $params);


        $data = isset($fetchArg) ? $statement->fetchAll($fetchStyle, $fetchArg) : $statement->fetchAll($fetchStyle);
        $statement->closeCursor();

        return $data;
    }
}