<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    






</body>
</html>


<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

use App\models\User;
use App\models\Livre;


// require_once "src/bdd.php";
require_once "common/conn.php";


$user = new User("john", "Doe", "test@test.com");
$allUsers = $user->getAllUsers();


$book = new Livre("test", "Lorem ipsum dolor sit amet, consectetur adipiscing el");







?>