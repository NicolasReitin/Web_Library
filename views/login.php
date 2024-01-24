<?php 
    include "../includes/header_login.php";

    session_start();

    if ($_SESSION){
        header("Location: ../index.php");
    }
?>

    <div class="parent">
        <div class="blocLogin"> 
            <a href="index.php"><img class="logo" src="src/assets/images/web_library.png" alt=""></a>
            <div class="connexion">
                <h2>Déjà client ?</h2>
                <form action="controllers/auth/login.php" method="POST">
                    <div class="mail">
                        <img class="icon" src="src/assets/icones/enveloppe.png" alt="">
                        <input type="email" name="email" placeholder="E-mail"><br>
                    </div>
                    <div class="password">
                        <img class="icon" src="src/assets/icones/lock.png" alt="">
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <div>
                        <p><a href="#">Mot de passe oublié ?</a></p>
                        <input type="submit" name="login" value="Se connecter" class="btn btn-warning">
                    </div>
                </form>
            </div>
            <hr>
            <div class="newClient">
                <h2>Nouveau client ?</h2>
                <a href="views/register.php" class="btn btn-outline-warning">Créer un compte</a>
            </div>
            <div class="mention">Web Library, en tant que responsable de traitement, traite les données recueillies à des fins de gestion de la relation client, gestion des commandes et des livraisons, personnalisation des services, prévention de la fraude, marketing et publicité ciblée. Pour en savoir plus, reportez-vous à la Politique de protection de vos données personnelles</div>
        </div>
    </div> 

<?php
include "../includes/footer_login.php"
?>

