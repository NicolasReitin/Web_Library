<?php

namespace App\models;

use PDO;

class Editeur {
    // private $dbCo;
    protected $id;
    public $nom;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($nom, $created_at = null, $updated_at = null) {
        // $this->dbCo = MysqlDatabase::get();
        $this->nom = $nom;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function exists() {
        return $this->id ? true : false;
    }

    public static function getAll(){
        global $pdo;

        $query = "SELECT * FROM editeurs";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $editeurs = [];
        foreach ($result as $row) {
            $editeur = new Editeur($row['nom'], new \DateTime($row['created_at']));
            $editeur->id = $row['id'];
            $editeurs[] = $editeur; 
        }
        return $editeurs;
    }

    public function create(){
        
    }

    public function update($id){
        
    }

    public function delete($id){
       
    }

}

?>
