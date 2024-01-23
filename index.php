<?php

include "includes/header.php";

use App\models\User;
use App\models\Livre;

?>
<h1>Bienvenue sur Web Library</h1>


<?php



$user = new User("john", "Doe", "test@test.com");
$allUsers = $user->getAllUsers();


$book = new Livre("test", "Lorem ipsum dolor sit amet, consectetur adipiscing el");






include_once "includes/footer.php";
?>