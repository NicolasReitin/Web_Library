<?php
session_start(); // Assurez-vous d'appeler session_start() au début de votre script

// Détruit toutes les données de session
$_SESSION = array();
session_destroy();

// Redirige l'utilisateur vers la page de connexion (ou toute autre page de votre choix)
header("Location: ../../index.php");
exit();
?>
