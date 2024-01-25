<?php 
require_once(__DIR__ . "/../common/conn.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <base href="http://localhost/weblibraryPHP/">
    <link rel="stylesheet" href="src/styles/style.css">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Boutons de navigation à gauche -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="views/livres.php">Livres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/version_livre.php">Versions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/auteurs.php">Auteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/editeurs.php">Éditeurs</a>
            </li>
        </ul>

        <!-- Logo au milieu -->
        <a class="navbar-brand mx-auto" href="index.php"><img class="logo" src="src/assets/images/web_library.png" alt="Logo"></a>

        <!-- Boutons de navigation à droite -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Booklist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>

            <?php
                if ($_SESSION){
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="views/profil.php"><?= ucfirst($_SESSION['prenom'])  ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="controllers/auth/logout.php">Logout</a>
                    </li>
                <?php
                    
                }else{
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="views/register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/login.php">Login</a>
                    </li>
                <?php
                }
                ?>
            
        </ul>
    </div>
</nav>
