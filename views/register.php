<?php
include "../includes/header_login.php";
?>

    <div class="parent">
        <div class="blocLogin"> 
            <a href="index.php"><img class="logo" src="src/assets/images/web_library.png" alt=""></a>
            <div class="connexion">
                <h2>Inscription</h2>

                <form action="controllers/auth/register.php" method="POST">
                    <div class="nom" >
                        <div class="blocItem">
                            <img class="icon" src="src/assets/icones/profil.png" alt="login">
                        </div>
                        <input type="text" name="nom" placeholder="Nom"><br>
                    </div>
                    <div class="prenom">
                        <div class="blocItem">
                        </div>
                        <input type="text" name="prenom" placeholder="Prénom"><br>
                    </div>
                    <div class="mail">
                        <div class="blocItem">
                            <img class="icon" src="src/assets/icones/enveloppe.png" alt="enveloppe">
                        </div>
                        <input type="email" name="email" placeholder="E-mail"><br>
                    </div>
                    <div class="password">
                        <div class="blocItem">
                            <img class="icon" src="src/assets/icones/lock.png" alt="cadenas">
                        </div>
                        <input type="password" name="password" placeholder="Password">                    
                    </div>
                    <div>
                        <input type="submit" class="btn btn-warning" name="register" value="Inscription">
                    </div>
                </form>
                
            </div>
            <hr>
            <div class="newClient">
                <h2>Déjà client ?</h2>
                <a href="views/login.php" class="btn btn-outline-warning">Se connecter</a>
            </div>
            
            <div class="mention">Web Library, en tant que responsable de traitement, traite les données recueillies à des fins de gestion de la relation client, gestion des commandes et des livraisons, personnalisation des services, prévention de la fraude, marketing et publicité ciblée. Pour en savoir plus, reportez-vous à la Politique de protection de vos données personnelles</div>
        </div>
    </div> 

<?php
include "../includes/footer_login.php"
?>