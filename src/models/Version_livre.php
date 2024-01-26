<?php

namespace App\models;

use PDO;

class Version_livre {
    // private $dbCo;
    protected $id;
    public $categorie;
    protected $editeurId;
    protected $livreId;
    public $created_at;
    public $updated_at;

    // Constructeur
    public function __construct($categorie, $editeurId = null, $livreId = null, $created_at = null, $updated_at = null) {
        $this->categorie = $categorie;
        $this->editeurId = $editeurId;
        $this->livreId = $livreId;
        $this->created_at = $created_at ?: new \DateTime;
        $this->updated_at = $updated_at;
    }

    public function getId() {
        return $this->id;
    }

    public function getLivreId(){
        global $pdo;

        $query = "SELECT livre_id FROM version_livre WHERE id = :version_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":version_id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function getLivreName($livre_id){
        global $pdo;
        $query = "SELECT titre FROM livres WHERE id = :livre_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":livre_id", $livre_id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function getEditeurId(){
        global $pdo;

        $query = "SELECT editeur_id FROM version_livre WHERE id = :version_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":version_id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    public function getEditeurName($editeur_id){
        global $pdo;
        $query = "SELECT nom FROM editeurs WHERE id = :editeur_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":editeur_id", $editeur_id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    // $version_livres = Version_livre::getAll();

    // foreach ($version_livres as $version_livre) :
    //     // var_dump($version_livre->getLivreId());
    //     $editeurId = $version_livre->getEditeurId();
    //     $editeurId = $editeurId['editeur_id'];
    //     $editeurName = $version_livre->getEditeurName($editeurId);
    //     if ($editeurName){
    //         echo $editeurName['nom']."<br>";
    //     }
    // endforeach;

    // $version_livres = Version_livre::getAll();
    // foreach ($version_livres as $version_livre) :
    //     var_dump($version_livre->getLivreId());
    //     $livreId = $version_livre->getLivreId();
    //     $livreId = $livreId['livre_id'];
    //     $livreName = $version_livre->getLivreName($livreId);
    //     echo $livreName['titre']."<br>";
    // endforeach;

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

        $query = "SELECT * FROM version_livre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $version_livres = [];
        foreach ($result as $row) {
            $version_livre = new version_livre($row['categorie'], new \DateTime($row['created_at']));
            $version_livre->id = $row['id'];
            $version_livres[] = $version_livre; 
        }

        return $version_livres;
    }

    public function create(){
        
    }

    public function update($id){
        
    }

    public function delete($id){
        
    }

}

?>