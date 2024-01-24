<?php

include_once(__DIR__ . "/../includes/header.php");

use App\models\Livre;
use App\models\Auteur;

?>

<h1>Livres</h1>
<div class="container">
    <div class="leftLivre">

        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Résumé</th>
                    <th>Nom de l'Auteur</th>
                    <th>Ajout aux Favoris</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $livres = Livre::getAll();
                    
                    

                    
                    foreach ($livres as $livre) :
                        $livreId = $livre->getId();
                        $auteurId = $livre->getAuteurId($livreId);
                        $auteurName = $livre->getAuteurName($auteurId);
                ?>

                    <tr>
                        <td><?php echo $livre->titre; ?></td>
                        <td><?php echo $livre->resume; ?></td>
                        <td><?php echo $auteurName['prenom'] . " " .$auteurName['nom'] ?></td>
                        <td style="text-align: center">
                            <!-- Ajoutez une checkbox ici pour ajouter aux favoris -->
                            <input type="checkbox" name="favoris[]" value="<?php echo $livre->getId(); ?>">
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
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
                    <option  selected>Choisissez un auteur</option>
                
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