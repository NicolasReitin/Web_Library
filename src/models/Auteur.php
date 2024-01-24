<?php

namespace App\models;

use PDO;

class Auteur {
    // private $dbCo;
    protected $id;
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

    public function getId() {
        return $this->id;
    }

    public function exists() {
        return $this->id ? true : false;
    }

    public static function getAll(){
        global $pdo;

        $query = "SELECT * FROM auteurs";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $auteurs = [];
        foreach ($result as $row) {
            $auteur = new Auteur($row['nom'], $row['prenom'], new \DateTime($row['created_at']));
            $auteur->id = $row['id'];
            $auteurs[] = $auteur; 
        }

        return $auteurs;
    }

    public function create(){
        global $pdo;
        try{
            $pdo->beginTransaction();
            //on effectue les actions

            //créer l'utilisateur
            $query = "INSERT INTO auteurs (nom, prenom, created_at) VALUES (?,?,?)";
            $stmt = $pdo->prepare($query);
            $values = array($this->nom, $this->prenom, $this->created_at->format('Y-m-d h:i:s'));
            $result = $stmt->execute($values);

            $pdo->commit();
            // $this->id = $pdo->lastInsertId();
        } catch (\Exception $e){
            // rollback si erreur dans la transaction
            $pdo->rollBack();
            throw $e;
        }
    }

    public function update($id){
        global $pdo;

        $query = "SELECT * FROM auteurs WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        try{
            $pdo->beginTransaction();

            $query = "UPDATE `auteurs` SET `nom` = ?, `prenom` = ?, `updated_at` = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $values = array($this->nom, $this->prenom, date('Y-m-d h:i:s'), $id);
            $result = $stmt->execute($values);

            $pdo->commit();
        } catch (\Exception $e){
            // rollback si erreur dans la transaction
            $pdo->rollBack();
            throw $e;
        }
    }

    public function delete($id){
        global $pdo;

        try{
            $pdo->beginTransaction();

            $query = "DELETE FROM auteurs WHERE id = :id";
            $$stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $pdo->commit();

        } catch (\Exception $e){
            // rollback si erreur dans la transaction
            $pdo->rollBack();
            throw $e;
        }       

    }

}

?>
