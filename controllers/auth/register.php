<?php


    if(isset($_POST) && $_POST['nom'] != '' && $_POST['prenom'] != '' && $_POST['email'] != '' && $_POST['password'] != ''){
        var_dump($_POST);
        $nom = strip_tags($_POST['nom']); // On récupère le nom
        $prenom = strip_tags($_POST['prenom']); // On récupère le prénom
        $email = htmlspecialchars($_POST['email']); // On récupère le mail
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT); // On récupère le mot de passe et on le crypt

        




    }else{
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
?>