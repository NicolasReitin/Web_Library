<?php

// include "./common/conn.php";

namespace App\models;

use PDO;

class User {
    // private $dbCo;

    public $nom;
    public $prenom;
    public $email;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($nom, $prenom, $email, $created_at = null, $updated_at = null) {
        // $this->dbCo = MysqlDatabase::get();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

    public function createUser(){
        global $pdo;
        
        //vérifie si l'utilisateur existe déjà avec un mail identique
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        // Récupérer toutes les lignes résultantes
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            echo "ok";
        }
        
        try{
            $pdo->beginTransaction();

            //on effectue les actions

            //créer l'utilisateur
            $query = "INSERT INTO users (nom, prenom, email, created_at) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $values = array($this->nom, $this->prenom, $this->email, $this->created_at);

            $result = $stmt->execute($values);

            $pdo->commit();

        } catch (\Exception $e){
            $pdo->rollBack();
        }

        
        

        

        // // Vérifier le succès de l'insertion
        // if ($result) {
        //     echo "Utilisateur créé avec succès en base de données.";
        // } else {
        //     echo "Erreur lors de la création de l'utilisateur en base de données : " . $stmt->error;
        // }

    }

    public function getAllUsers() {
        global $pdo;

        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row){
            echo $row['nom'];
        }
    }

}

?>
