<?php

include "../includes/header.php";

use App\models\Auteur;

?>
    <h1>Auteurs</h1>
    <div class="container">
        <div class="left">
        <?php
            $auteurs = Auteur::getAll();
            // var_dump($auteurs);
            // exit();

            foreach ($auteurs as $auteur){
                echo $auteur->getId() . " " . $auteur->nom . " " . $auteur->prenom . "<br>";
            }
        ?>
        </div>
        <div class="right">
        <h2>Créer un Auteur</h2>
        <form action="controllers/auteurCreate.php" method="POST">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>

            <br>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <br>

            <input class="btn btn-success" type="submit" value="Créer Auteur">
        </form>
        </div>

    </div>


<?php
include_once "../includes/footer.php";
?>