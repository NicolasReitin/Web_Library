<?php
    require_once(__DIR__ . "/../../common/conn.php");

    use App\models\User;

    session_start();

    if(isset($_POST) && $_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['email'] != '' && $_POST['password'] != ''){
        // var_dump($_POST);
        $nom = strip_tags($_POST['nom']); // On récupère le nom
        $prenom = strip_tags($_POST['prenom']); // On récupère le prénom
        $email = htmlspecialchars($_POST['email']); // On récupère le mail
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT); // On récupère le mot de passe et on le crypt
        

        $user = new User($nom, $prenom, $email, $password);
        // var_dump($user);
        $user->create();

        header("Location: ../../index.php");
        exit();
        
    }else{
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
?>