<?php

include_once "includes/header.php";

use App\models\User;



$user = new User("john", "Doe", "test@test.com");
$allUsers = $user->getAllUsers();