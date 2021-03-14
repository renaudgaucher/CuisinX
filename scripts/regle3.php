<?php

require "../class/Database.php";
require "../class/Ingredient.php";

$dbh = Database::connect();

$li_ingredient_dispo = Ingredient::liste_ingredients($dbh);
$id_recette = $_POST['id_recette'];
$nb_personne = $_POST['nb_personne'];
if (!ctype_digit($id_recette) || !ctype_digit($nb_personne)) return false;
else{
    $recette = Recette::getRecette($dbh, $id_recette);

    if ($recette === null) {
        return false;
    }
    foreach ($recette->liste_ingredient as $ingredient) {
        echo "<li>$ingredient->quantite $ingredient->unite " . Ingredient::id_to_nomIngredient($dbh, $ingredient->id_ingredient)['nom'] . "</li>";
    }
    $dbh=null;
    return $res;
}

