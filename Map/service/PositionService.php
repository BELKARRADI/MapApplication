<?php

include_once RACINE . '/classes/Position.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class PositionService implements IDao {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($obj) {
        $query = "INSERT INTO position (latitude, longitude, date, imei) VALUES (?, ?, ?, ?)";
        try {
            $req = $this->connexion->getConnexion()->prepare($query);
            $req->execute([$obj->getLatitude(), $obj->getLongitude(), $obj->getDate(), $obj->getImei()]);
        } catch (PDOException $e) {
            // Handle the error
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete($obj) {
        $query = "DELETE FROM position WHERE id = ?";
        try {
            $req = $this->connexion->getConnexion()->prepare($query);
            $req->execute([$obj->getId()]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAll() {
        $positions = array();
        $query = "SELECT * FROM position";
        try {
            $req = $this->connexion->getConnexion()->prepare($query);
            $req->execute();
            while ($p = $req->fetch(PDO::FETCH_OBJ)) {
                $positions[] = new Position($p->id, $p->latitude, $p->longitude, $p->date, $p->imei);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $positions;
    }

    public function getById($id) {
        $query = "SELECT * FROM position WHERE id = ?";
        try {
            $req = $this->connexion->getConnexion()->prepare($query);
            $req->execute([$id]);
            if ($p = $req->fetch(PDO::FETCH_OBJ)) {
                return new Position($p->id, $p->latitude, $p->longitude, $p->date, $p->imei);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }

    public function update($obj) {
        $query = "UPDATE position SET latitude = ?, longitude = ?, date = ?, imei = ? WHERE id = ?";
        try {
            $req = $this->connexion->getConnexion()->prepare($query);
            $req->execute([$obj->getLatitude(), $obj->getLongitude(), $obj->getDate(), $obj->getImei(), $obj->getId()]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function findAllApi() {
        $query = "select * from position";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}
