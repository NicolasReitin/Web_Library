<?php
    require_once(__DIR__ . "/../common/conn.php");

    use App\models\Auteur;

    if(isset($_POST) && $_POST['nom'] != '' && $_POST['prenom']){
        $nom = htmlspecialchars($_POST['nom']); // On récupère le nom
        $prenom = htmlspecialchars($_POST['prenom']); // On récupère le prénom

        $auteur = new Auteur($nom, $prenom);

        $auteur->create();

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    }
    


?>