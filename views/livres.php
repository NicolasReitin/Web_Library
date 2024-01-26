<?php

include_once(__DIR__ . "/../includes/header.php");

use App\models\Livre;
use App\models\Auteur;

?>

<h1>Livres</h1>
<div class="containerLivre">
    <div class="leftLivre">


        <form action="controllers/addFavoris.php" method="POST">

            <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php 
                $livres = Livre::getAll();
                foreach ($livres as $livre) :
                            $livreId = $livre->getId();
                            $auteurId = $livre->getAuteurId($livreId);
                            $auteurName = $livre->getAuteurName($auteurId);
                    ?>
                <div class="col">
                    <div class="card" style="height : 250px; width: 400px">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $livre->titre ?></h3>
                        <h5 class="card-text"><?php echo $auteurName['prenom'] . " " .$auteurName['nom'] ?></h5>
                        <p class="card-text"><?php echo $livre->resume ?></p>
                        <label for="checkbox">Ajout aux favoris</label>
                        <input id="checkbox" type="checkbox" name="favoris[]" value=<?php echo $livre->getId(); ?>>
                    </div>
                    </div>
                </div>
            <?php 
                endforeach 
            ?>
            </div>
            <input class="btn btn-outline-success mt-3" type="submit" value="Ajouter aux favoris">
        </form>
    </div>

    <div class="rightLivre">
            <h2>Créer un Livre</h2>
            <form action="controllers/livreCreate.php" method="POST">
                <label class="" for="titre">Titre</label>
                <input class="form-control" type="text" id="titre" name="titre" required>

                <br>

                <label for="resume">Résumé</label>
                <input class="form-control" type="text" id="resume" name="resume" required>

                <br>
                <label for="select">Auteur</label>
                <select class="form-select" name="auteurId" id="select">
                    <option disabled selected>Choisissez un auteur</option>
                
                <?php
                    $auteurs = Auteur::getAll();

                    foreach ($auteurs as $auteur){
                        echo '<option value=' . $auteur->getId() . '>' . $auteur->nom . ' - ' . $auteur->prenom .'</option>';
                    }
                ?>
                </select>

                <br>

                <input class="btn btn-success" type="submit" value="Créer Livre">
            </form>
        </div>

</div>


    

<?php

include_once "../includes/footer.php";
?>