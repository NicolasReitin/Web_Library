<?php

require_once(__DIR__ . "/../common/conn.php");
session_start();
global $pdo;
var_dump($_SESSION);

if ($_SESSION){
    if (isset($_POST['favoris']) && $_POST['favoris'] != '') {
        // Récupérez les IDs des nouveaux livres depuis la requête POST
        $nouveauxLivres = $_POST['favoris'];
        var_dump($nouveauxLivres);
    
        // Assurez-vous que c'est un tableau (au cas où un seul ID est envoyé)
        if (!is_array($nouveauxLivres)) {
            $nouveauxLivres = [$nouveauxLivres];
        }
        // Convertissez les chaînes en entiers
        $nouveauxLivres = array_map('intval', $nouveauxLivres);
    
        // Récupérez $jsonArray depuis la base de données
        $querySelect = "SELECT liste_livre_id FROM liste_favoris WHERE user_id = :user_id";
        $stmtSelect = $pdo->prepare($querySelect);
        $stmtSelect->bindParam(":user_id", $_SESSION['user_id']);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->fetch();
        var_dump($resultSelect);
    


        
        // // Désérialisez le JSON en tableau
        // $arrayFromDatabase = json_decode($resultSelect['liste_livre_id'], true);
        // var_dump($arrayFromDatabase);

        // Vérifiez si la requête a retourné un résultat
        if ($resultSelect && $resultSelect['liste_livre_id'] !== null) {
            // Désérialisez le JSON en tableau
            $arrayFromDatabase = json_decode($resultSelect['liste_livre_id'], true);
            var_dump($arrayFromDatabase);
        } else {
            // La colonne est vide ou n'a pas encore été définie, initialisez le tableau
            $arrayFromDatabase = null;
        }
        
    
        if ($arrayFromDatabase !== null) {
            // Ajoutez les nouveaux IDs de livres à la liste s'ils n'existent pas déjà
            foreach ($nouveauxLivres as $nouveauLivre) {
                if (!in_array($nouveauLivre, $arrayFromDatabase)) {
                    $arrayFromDatabase[] = $nouveauLivre;
                }
            }
            var_dump($arrayFromDatabase);

    
            // Réencodez le tableau mis à jour en JSON
            $jsonArrayUpdated = json_encode($arrayFromDatabase);
            var_dump($jsonArrayUpdated);
    
            // Mettez à jour la base de données avec le tableau mis à jour
            $queryUpdate = "UPDATE liste_favoris SET liste_livre_id = :jsonArrayUpdated WHERE user_id = :user_id";
            $stmtUpdate = $pdo->prepare($queryUpdate);
            $stmtUpdate->bindParam(":jsonArrayUpdated", $jsonArrayUpdated);
            $stmtUpdate->bindParam(":user_id", $_SESSION['user_id']);
            $stmtUpdate->execute();

            header("Location: ../views/profil.php" );


        } else {
            // Le tableau n'existe pas encore dans la base de données, créez-le avec les nouveaux IDs de livres
            $jsonArrayToInsert = json_encode($nouveauxLivres);
    
            // Insérez le nouveau tableau dans la base de données
            $queryInsert = "INSERT INTO liste_favoris (liste_livre_id, user_id) VALUES (:jsonArrayToInsert, :user_id)";
            $stmtInsert = $pdo->prepare($queryInsert);
            $stmtInsert->bindParam(":jsonArrayToInsert", $jsonArrayToInsert);
            $stmtInsert->bindParam(":user_id", $_SESSION['user_id']);
            $stmtInsert->execute();

            header("Location: ../views/profil.php" );

        }
    }else{
        header("Location: ../views/livres.php");
    }
}else{
    header("Location: ../index.php" );
}










// if (isset($_POST['favoris']) && is_array($_POST['favoris'])) {
//     // Récupérer les valeurs des cases à cocher cochées
//     $casesCoches = $_POST['favoris'];

//     $array = [implode(', ', $casesCoches)];
//     $jsonArray = json_encode($array);
//     var_dump($jsonArray);

//     $query = "INSERT INTO liste_favoris (livres_id)";

//     // Afficher les valeurs (remplacez cela par votre logique de traitement)
//     echo "Livres ajoutés aux favoris : " . implode(', ', $casesCoches);
// } else {
//     echo "Aucun livre ajouté aux favoris.";
// }












?>
