<?php
include "../includes/header.php";

use App\models\Version_livre;

$version_livres = Version_livre::getAll();

foreach ($version_livres as $version_livre) :
    // var_dump($version_livre->getLivreId());
    $editeurId = $version_livre->getEditeurId();
    $editeurId = $editeurId['editeur_id'];
    $editeurName = $version_livre->getEditeurName($editeurId);
    if ($editeurName){
        echo $editeurName['nom']." | Version : ";
        echo $version_livre->categorie . "<br>";
    }


endforeach;



include_once "../includes/footer.php";
?>