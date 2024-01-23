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

        if($result > 0){
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
            echo "Utilisateur créé avec succès en base de données.";
        }else{
            echo "Un utilisateur avec ce mail existe déjà";
        }

    }

    public function updateUser() {
        global $pdo;


    }

    public function getAllUsers() {
        global $pdo;

        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <h2>Liste des utilisateurs</h2>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            <?php 
                foreach ($result as $row) {
            ?>
                <tr>
                    <td scope="row"> <?= $row['id']?> </td>
                    <td> <?= $row['nom']?> </td>
                    <td> <?= $row['prenom']?> </td>
                    <td> <?= $row['email']?> </td>
                    <td> <?= $row['created_at']?> </td>
                    <td> <?= $row['updated_at']?> </td>
                    <td>
                        <button class="btn btn-warning" onclick="editUser( <?= $row['id']?> )">Edit</button>
                        <button class="btn btn-danger" onclick="deleteUser( <?= $row['id']?> )">X</button>
                    </td>
            </tr>

        <?php

        }
    }

}

?>
