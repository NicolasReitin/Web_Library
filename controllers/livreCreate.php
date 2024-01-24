<?php
    require_once(__DIR__ . "/../common/conn.php");

    use App\models\Livre;

    if(isset($_POST) && $_POST['titre'] != '' && $_POST['resume'] != '' && $_POST['auteurId'] != ''){
        $titre = htmlspecialchars($_POST['titre']); 
        $resume = htmlspecialchars($_POST['resume']); 
        $auteurId = htmlspecialchars($_POST['auteurId']); 

        $livre = new Livre($titre, $resume, $auteurId);

        $livre->create();

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    }
    


?>