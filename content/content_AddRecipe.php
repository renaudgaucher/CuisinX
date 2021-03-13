<?php

function getContent($args){
    $dbh=$args['dbh'];
    $li_ingredient_dispo = Ingredient::liste_ingredients($dbh);
    $li_difficulte_dispo = Difficulte::liste_difficulte($dbh);




$form_values_valid=false;

if(isset($_POST["nom_plat"]) && $_POST["nom_plat"] != "" &&
        isset($_POST["consigne"]) && $_POST["consigne"] != "" &&
        isset($_POST["difficulte"]) && $_POST["difficulte"] != "" &&
        isset($_POST["temps_cuisson"]) && ctype_digit(["temps_cuisson"])&&
        isset($_POST["temps_preparation"]) && ctype_digit(["temps_preparation"])){
    
    
    $insert = Recette::insererRecette($dbh, $_POST['nom_plat'], $_SESSION['login'], $_POST['image'], $_POST['consigne'], $_POST['difficulte'], $_POST['temps_cuisson'], $_POST['temps_preparation']);
    $form_values_valid = $insert;
}
 
if (!$form_values_valid) {
  // code du formulaire
    //on teste si les champs étaient définis
    if (isset($_POST["nom_plat"])) $nom_plat = htmlspecialchars($_POST["nom_plat"]);
    else $nom_plat = "";
    if (isset($_POST["consigne"])) $consigne = htmlspecialchars($_POST["consigne"]);
    else $consigne = "";
    if (isset($_POST["temps_cuisson"])) $temps_cuisson = htmlspecialchars($_POST["temps_cuisson"]);
    else $temps_cuisson = "";
    if (isset($_POST["temps_preparation"])) $temps_preparation = htmlspecialchars($_POST["temps_preparation"]);
    else $temps_preparation = "";
    
       
?>

<main>
    <div class="container text-center">
        <form action="index.php?page=AddRecipe&todo=addRecipe" method=post>
            <div class="my-1">
                <input type="text" required name="nom_plat" value="<?php echo $nom_plat ?>" placeholder="Pâtes bolo">
            </div>
            <div class="my-1">
                <select name="difficulte">
                    <?php
                    foreach($li_difficulte_dispo as $difficulte_dispo){
                        $nom_difficulte_dispo = htmlspecialchars($difficulte_dispo['difficulte']);
                        echo "<option value=$nom_difficulte_dispo> $nom_difficulte_dispo </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="my-1">
                <select name="ingredient">
                    <?php
                    foreach($li_ingredient_dispo as $ingredient_dispo){
                        $nom_ingredient_dispo = htmlspecialchars($ingredient_dispo['nom']);
                        echo "<option value=$nom_ingredient_dispo> $nom_ingredient_dispo </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="my-1">
                <input type="text" required name="consigne" value="<?php echo $consigne ?>" placeholder="1)mettez les pates au four 2) ajouter de l'eau">
            </div>
            <div class="my-1">
                <input type="text" required name="temps_cuisson" value="<?php echo $temps_cuisson ?>" placeholder="temps cuisson">
                <label>mn</label>
            </div>
            <div class="my-1">
                <input type="text" required name="temps_preparation" value="<?php echo $temps_preparation ?>" placeholder="temps preparation">
                <label>mn</label>
            </div>
        </form>
    </div>
</main>

<?php

}
else{
    //Si le formulaire est valide
    

?>
<main class="container py-5 text-center">
    <h2> Recette enregistrée ! </h2>
</main>
<?php
}
}
