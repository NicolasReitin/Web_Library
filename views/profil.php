<?php

include_once(__DIR__ . "/../includes/header.php");

use App\models\Livre;


$listeFavoris = Livre::getAllFavorites();
$favorisJson = $listeFavoris['liste_livre_id'];
$arrayFromJson = json_decode($favorisJson, true);
?>
    <form action="controllers/removeFavoris.php" method="POST">
        
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Résumé</th>
                    <th>Nom de l'Auteur</th>
                    <th>Retirer des Favoris</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
            // var_dump($arrayFromJson);
            
            foreach ($arrayFromJson as $livreId) : 
                $livre = Livre::getById($livreId);
                
                $auteurId = $livre['auteur_id'];
                
                $LivreAuteur= new Livre($livre['titre'], $livre['resume'], $livre['auteur_id']);
                $auteurName = $LivreAuteur->getAuteurName($auteurId);
                
                ?>
                <tr>
                    <td><?php echo $livre['titre']; ?></td>
                    <td><?php echo $livre['resume']; ?></td>
                    <td><?php echo $auteurName['prenom'] . " " .$auteurName['nom'] ?></td>
                        <td style="text-align: center">
                            <!-- Ajoutez une checkbox ici pour ajouter aux favoris -->
                            <input type="checkbox" name="favoris[]" value=<?= $livreId ?>>
                        </td>
                    </tr>
                <?php
                    endforeach
                ?>
            </tbody>
        </table>
        <input class="btn btn-outline-success" type="submit" value="Retirer des favoris">
    </form>

    <?php
            

?>