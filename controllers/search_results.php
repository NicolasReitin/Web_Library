<?php
// Simples données de démonstration (vous devez remplacer cela par une recherche réelle en base de données)
$livres = [
    ['titre' => 'Livre 1', 'auteur' => 'Auteur 1'],
    ['titre' => 'Livre 2', 'auteur' => 'Auteur 2'],
    ['titre' => 'Livre 3', 'auteur' => 'Auteur 1'],
    // ... ajoutez d'autres livres
];

// Récupérer le terme de recherche
$search_query = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

// Filtrer les résultats en fonction du terme de recherche
$resultats = [];
foreach ($livres as $livre) {
    // Recherche dans le titre du livre ou le nom/prénom de l'auteur
    if (stripos($livre['titre'], $search_query) !== false || stripos($livre['auteur'], $search_query) !== false) {
        $resultats[] = $livre;
    }
}

// Afficher les résultats
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la Recherche</title>
</head>
<body>

<h2>Résultats de la Recherche</h2>

<p>Résultats pour la recherche : <?php echo $search_query; ?></p>

<ul>
    <?php foreach ($resultats as $resultat) : ?>
        <li><?php echo $resultat['titre'] . ' - ' . $resultat['auteur']; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>
