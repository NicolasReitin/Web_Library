<?php 
    require_once(__DIR__ . "/../../common/conn.php");

    session_start();

    if ($_SESSION){
        header("Location: ../../index.php");
        
    }else{

        if (isset($_POST) && $_POST['email']!= "" && $_POST['password']!= "" ){
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']); // On récupère le mot de passe et on le crypt
    
            // $passwordUsed = 
    
            try{
                $query = "SELECT * FROM users WHERE email = :email";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                // Récupérer toutes les lignes résultantes
                $userFind = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if (password_verify($password, $userFind['password'])) {
                    $_SESSION['user_id'] = $userFind['id'];
                    $_SESSION['email'] = $userFind['email'];
                    $_SESSION['prenom'] = $userFind['prenom'];
                    $_SESSION['nom'] = $userFind['nom'];
    
    
                    header("Location: ../../index.php");
                    exit();
        
                }else{
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
    
            } catch (\Exception $e){
                // rollback si erreur dans la transaction
                $pdo->rollBack();
            }
            
            
        
        }
    }


?>