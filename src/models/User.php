<?php

namespace App\models;

use PDO;

class User {
    // private $dbCo;
    protected $id;
    public string $nom;
    public string $prenom;
    public string $email;
    public string $password;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct(string $nom, string $prenom, string $email, string $password, $created_at = null, $updated_at = null) {
        // $this->dbCo = MysqlDatabase::get();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function create(){
        global $pdo;
        //vérifie si l'utilisateur existe déjà avec un mail identique
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        // Récupérer toutes les lignes résultantes
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        if(!$result){
            try{
                $pdo->beginTransaction();
                //on effectue les actions
    
                //créer l'utilisateur
                $query = "INSERT INTO users (nom, prenom, email, password, created_at) VALUES (?,?,?,?,?)";
                $stmt = $pdo->prepare($query);
                $values = array($this->nom, $this->prenom, $this->email, $this->password, $this->created_at->format('Y-m-d h:i:s'));
                $result = $stmt->execute($values);

                $pdo->commit();
            } catch (\Exception $e){
                // rollback si erreur dans la transaction
                $pdo->rollBack();
                throw $e;
            }
            echo "Utilisateur créé avec succès en base de données.";
        }else{
            echo "Un utilisateur avec ce mail existe déjà";
        }

    }

    public function update($id){
        global $pdo;

        try{
            $pdo->beginTransaction();

            $query = "UPDATE `users` SET `nom` = ?, `prenom` = ?, `email` = ?, `updated_at` = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $values = array($this->nom, $this->prenom, $this->email, date('Y-m-d h:i:s'), $id);
            $stmt->execute($values);

            $pdo->commit();
        } catch (\Exception $e){
            // rollback si erreur dans la transaction
            $pdo->rollBack();
            throw $e;
        }
    }

    public function getAllUsers() {
        global $pdo;

        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        // return $result;

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
