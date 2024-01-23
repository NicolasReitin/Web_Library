<?php

// include "./common/conn.php";

namespace App\models;

class Livre {
    // private $dbCo;

    public $titre;
    public $resume;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($titre, $resume, $created_at = null, $updated_at = null) {
        // $this->dbCo = MysqlDatabase::get();
        $this->titre = $titre;
        $this->resume = $resume;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

}

?>
