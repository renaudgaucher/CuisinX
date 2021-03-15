<?php

require "../class/Database.php";
require "../class/Ingredient.php";
require "../class/Recette.php";

$dbh = Database::connect();

if(!isset($_POST['id_recette'])){
    return "is_recette";
}
if(!isset($_POST['nb_personne'])){
    return "nb_personne";
}
$id_recette = $_POST['id_recette'];

$nb_personne = $_POST['nb_personne'];

if (!ctype_digit($id_recette) || !ctype_digit($nb_personne)) return false;
else{
    $recette = Recette::getRecette($dbh, $id_recette);
    $nb_personne_theorique = $recette->nb_personne;
    if ($recette === null) {
        return false;
    }
    foreach ($recette->liste_ingredient as $ingredient) {
        echo "<li>".($ingredient->quantite *$nb_personne/$nb_personne_theorique)." ".htmlspecialchars("$ingredient->unite"). " " . htmlspecialchars(Ingredient::id_to_nomIngredient($dbh, $ingredient->id_ingredient)['nom']) . "</li>";
    }
    $dbh=null;
}

