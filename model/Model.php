<?php

namespace model;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 *
 */
abstract class Model
{
    static private ?PDO $db = null;

    /**
     * @return PDO
     */
    private function getDB() : PDO
    {
        if (self::$db=== null) {
            try {
                self::$db = new PDO('mysql:host=localhost;dbname=grp-436_s3_progweb',
                    'grp-436',
                    'pkzhwAcr'
                    , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return self::$db;
    }

    /**
     * @param string $sql
     * @param array|null $params
     * @return PDOStatement|false
     */
    protected function execRequest(string $sql, array $params = null) : PDOStatement|false
    {
        $res = false;

        if ($params === null) {
            $res = $this->getDB()->query($sql); // requête sans paramètre
        }
        else {
            $res = $this->getDB()->prepare($sql); // requête préparée avec des paramètres
            $res->execute($params);
        }

        return $res;
    }


}