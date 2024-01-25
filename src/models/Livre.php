<?php

namespace App\models;

use PDO;

class Livre {
    // private $dbCo;
    protected $id;
    public $titre;
    public $resume;
    protected $auteurId;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($titre, $resume, $auteurId, $created_at = null, $updated_at = null) {
        $this->titre = $titre;
        $this->resume = $resume;
        $this->auteurId = $auteurId;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuteurId($book_id) {
        global $pdo;

        $query = "SELECT auteur_id FROM livres WHERE id = :book_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":book_id", $book_id);
        $stmt->execute();
        $result = $stmt->fetch();
       
        return $result['auteur_id'];
    }

    public function getAuteurName($auteur_id) {
        global $pdo;

        $query = "SELECT nom, prenom FROM auteurs WHERE id = :auteur_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":auteur_id", $auteur_id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public static function getAll(){
        global $pdo;

        $query = "SELECT * FROM livres";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $livres = [];
        foreach ($result as $row) {
            $livre = new Livre($row['titre'], $row['resume'], new \DateTime($row['created_at']));
            $livre->id = $row['id'];
            $livres[] = $livre; 
        }

        return $livres;
    }

    public static function getById($livreId) {
        global $pdo;
    
        $query = "SELECT * FROM livres WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $livreId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }
    
    public static function getAllFavorites(){
        global $pdo;

        $query = "SELECT liste_livre_id FROM liste_favoris WHERE user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":user_id", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function create(){
        global $pdo;
        try{
            $pdo->beginTransaction();
            $query = "INSERT INTO livres (titre, `resume`, auteur_id, created_at) VALUES (?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $values = array($this->titre, $this->resume, $this->auteurId, $this->created_at->format('Y-m-d h:i:s'));
            $result = $stmt->execute($values);
            $pdo->commit();
        } catch (\Exception $e){
            $pdo->rollBack();
            throw $e;
        }
    }

    public function update($id){
        global $pdo;

        $query = "SELECT * FROM livres WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        try{
            $pdo->beginTransaction();

            $query = "UPDATE `livres` SET `titre` = ?, `resume` = ?, `updated_at` = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $values = array($this->titre, $this->resume, date('Y-m-d h:i:s'), $id);
            $result = $stmt->execute($values);
            $pdo->commit();
        } catch (\Exception $e){
            $pdo->rollBack();
            throw $e;
        }
    }

    public function delete($id){
        global $pdo;

        try{
            $pdo->beginTransaction();

            $query = "DELETE FROM livres WHERE id = :id";
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
