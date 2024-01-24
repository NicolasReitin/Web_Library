<?php

include "includes/header.php";

use App\models\Livre;


?>
<h1>Bienvenue sur Web Library</h1>


<?php



$book = new Livre("test", "Lorem ipsum dolor sit amet, consectetur adipiscing el");






include_once "includes/footer.php";
?>