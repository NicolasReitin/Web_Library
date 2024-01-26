<?php

require_once(__DIR__ . "/../common/conn.php");
session_start();

global $pdo;
var_dump($_SESSION);

if ($_SESSION){
    if (isset($_POST['favoris'])) {
        if (isset($_POST['favoris']) && $_POST['favoris'] != '') {
            $livresASupprimer = $_POST['favoris'];
            var_dump($livresASupprimer);

            if (!is_array($livresASupprimer)) {
                $livresASupprimer = [$livresASupprimer];
            }

            $livresASupprimer = array_map('intval', $livresASupprimer);
            var_dump($livresASupprimer);

            $querySelect = "SELECT liste_livre_id FROM liste_favoris WHERE user_id = :user_id";
            $stmtSelect = $pdo->prepare($querySelect);
            $stmtSelect->bindParam(":user_id", $_SESSION['user_id']);
            $stmtSelect->execute();
            $resultSelect = $stmtSelect->fetch();

            if ($resultSelect && $resultSelect['liste_livre_id'] !== null) {
                // decode le JSON en tableau
                $arrayFromDatabase = json_decode($resultSelect['liste_livre_id'], true);
                var_dump($arrayFromDatabase);
    
                // Supprimez les IDs des livres de la liste
                foreach ($livresASupprimer as $livreASupprimer) {
                    $index = array_search($livreASupprimer, $arrayFromDatabase);
                    if ($index !== false) {
                        unset($arrayFromDatabase[$index]);
                    }
                }
                var_dump($arrayFromDatabase);
    
                $jsonArrayUpdated = json_encode($arrayFromDatabase);
                var_dump($jsonArrayUpdated);
    
                // update de la BDD
                $queryUpdate = "UPDATE liste_favoris SET liste_livre_id = :jsonArrayUpdated WHERE user_id = :user_id";
                $stmtUpdate = $pdo->prepare($queryUpdate);
                $stmtUpdate->bindParam(":jsonArrayUpdated", $jsonArrayUpdated);
                $stmtUpdate->bindParam(":user_id", $_SESSION['user_id']);
                $stmtUpdate->execute();
    
                header("Location: ../views/profil.php");
            } else {
                header("Location: ../views/profil.php");
            }
        }else {
            header("Location: ../views/livres.php");
        }

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
