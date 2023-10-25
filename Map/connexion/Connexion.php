<?php

class Connexion {

    private $connextion;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'map';
        $login = 'root';
        $password = '';
        try {
            $this->connextion = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
            $this->connextion->query("SET NAMES UTF8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function getConnexion() {
        return $this->connextion;
    }

}

?>