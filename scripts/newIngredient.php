<?php

require "../class/Database.php";
require "../class/Ingredient.php";

$dbh = Database::connect();

$li_ingredient_dispo = Ingredient::liste_ingredients($dbh);
$nouvel_ingredient = $_POST['nom_ingredient'];
if ($nouvel_ingredient=="" || in_array($nouvel_ingredient, $li_ingredient_dispo)) return false;
else{
    $res=Ingredient::nouvelIngredient($dbh, $nouvel_ingredient);
    $dbh=null;
    return $res;
}
?>