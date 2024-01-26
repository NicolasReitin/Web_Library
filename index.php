<?php
include "includes/header.php";
use App\models\Version_livre;

?>


<h1>Bienvenue sur Web Library</h1>

<h3>Recherche Livres et Auteurs</h3>

<form class="d-flex col-md-6" action="controllers/search_results.php" method="GET">
    <input class="form-control me-2" type="text" id="search_query" name="search" placeholder="Rechercher" required>
    <input class="btn btn-outline-warning" type="submit" value="Rechercher">
</form>

<?php



include_once "includes/footer.php";
?>