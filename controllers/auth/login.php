<?php 


if (isset($_POST['login'])){
    $usermail = htmlspecialchars($_POST['usermail']);
    $usermdp = sha1(htmlspecialchars($_POST['usermdp']));

    $query = "SELECT * FROM stagiaire_add_videos WHERE usermail='$usermail' and usermdp='".sha1($usermdp)."'"; // requête de selection
    $result = mysqli_query($pdo, $query) ;//execution de la requête
    
}
?>