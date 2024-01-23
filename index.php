<?php

include_once "includes/header.php";

use App\models\User;
use App\models\Livre;


// require_once "src/bdd.php";
require_once "common/conn.php";


$user = new User("john", "Doe", "test@test.com");
$allUsers = $user->getAllUsers();


$book = new Livre("test", "Lorem ipsum dolor sit amet, consectetur adipiscing el");






include_once "includes/footer.php";
?>