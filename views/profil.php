<?php

include_once(__DIR__ . "/../includes/header.php");

use App\models\Livre;


$listeFavoris = Livre::getAllFavorites();
$favorisJson = $listeFavoris['liste_livre_id'];
$arrayFromJson = json_decode($favorisJson, true);
?>


<form action="controllers/removeFavoris.php" method="POST">

        <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
        foreach ($arrayFromJson as $livreId) : 
                $livre = Livre::getById($livreId);
                $auteurId = $livre['auteur_id'];
                $LivreAuteur= new Livre($livre['titre'], $livre['resume'], $livre['auteur_id']);
                $auteurName = $LivreAuteur->getAuteurName($auteurId);   
        ?>

            <div class="col">
                <div class="card" style="height : 250px; width: 400px">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h3 class="card-title"><?php echo $livre['titre'] ?></h3>
                    <h3 class="card-text"><?php echo $auteurName['prenom'] . " " .$auteurName['nom'] ?></h3>
                    <p class="card-text"><?php echo $livre['resume'] ?></p>
                    <label for="checkbox">Retirer des favoris</label>
                    <input id="checkbox" type="checkbox" name="favoris[]" value=<?= $livreId ?>>
                    <input class="btn btn-outline-success mt-3" type="submit" value="Retirer des favoris">

                </div>
                </div>
            </div>

        <?php
            endforeach
        ?>
        </div>
            
        
        <!-- <input class="btn btn-outline-success mt-3" type="submit" value="Retirer des favoris"> -->
    </form>

    <?php
            

?>