<?php

include_once(__DIR__ . "/../includes/header.php");

use App\models\Editeur;
?>

<h1>Editeurs</h1>
<div class="containerLivre">
    <div class="leftLivre">

        <?php
            $editeurs = Editeur::getAll();

            foreach($editeurs as $editeur) :
                echo $editeur->nom;
                echo "<br>";

            endforeach

        ?>

    
    </div>
    <div class="rightLivre">
            <h2>Créer un Editeur</h2>
            <form action="controllers/livreCreate.php" method="POST">
                <label class="" for="nom">Nom</label>
                <input class="form-control" type="text" id="nom" name="nom" required>


                <br>

                <input class="btn btn-success" type="submit" value="Créer Editeur">
            </form>
        </div>

</div>


    

<?php

include_once "../includes/footer.php";
?>