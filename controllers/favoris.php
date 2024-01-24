<?php
if (isset($_POST['favoris']) && is_array($_POST['favoris'])) {
    // Récupérer les valeurs des cases à cocher cochées
    $casesCoches = $_POST['favoris'];

    // Afficher les valeurs (remplacez cela par votre logique de traitement)
    echo "Livres ajoutés aux favoris : " . implode(', ', $casesCoches);
} else {
    echo "Aucun livre ajouté aux favoris.";
}
?>
