<?php
require "../class/Database.php";
require "../class/Ingredient.php";

$dbh = Database::connect();

$li_ingredient_dispo = Ingredient::liste_ingredients($dbh);
$dbh=null;

?>

<li> <div class="form-row">
        <div class="col-md-4 mb-3"><label> Ingrédient </label> : <select class="custom-select" name="ingredients[]"><option></option>
                <?php
                foreach($li_ingredient_dispo as $ingredient_dispo){
                    $nom_ingredient_dispo = htmlspecialchars($ingredient_dispo['nom']);
                    echo "<option value=$nom_ingredient_dispo> $nom_ingredient_dispo </option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4 mb-3"><label> Quantité </label> : <input class="form-control" type="text" name="quantites[]"/></div>
        <div class="col-md-4 mb-3"><label> Unité </label> : <input class="form-control" type="text" name="unites[]"/></div>
    </div>
</li>
<?php


