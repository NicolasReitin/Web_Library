<?php

// include "./common/conn.php";

namespace App\models;

class Auteur {
    // private $dbCo;

    public $nom;
    public $prenom;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($nom, $prenom, $created_at = null, $updated_at = null) {
        // $this->dbCo = MysqlDatabase::get();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

}

?>
