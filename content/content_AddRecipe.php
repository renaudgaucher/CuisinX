<?php




function getContent($args){
    if (session_status() != PHP_SESSION_ACTIVE) session_start();

    
    if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"]!==true || !isset($_SESSION["login"])){
        echo "<h1> Veuillez vous connecter d'abord !</h1>";
        return false;
    }
    
    $dbh=$args['dbh'];
    $li_ingredient_dispo_temp = Ingredient::liste_ingredients($dbh);
    $li_ingredient_dispo=[];
    
    foreach($li_ingredient_dispo_temp as $ingredient_dispo){
        array_push($li_ingredient_dispo,htmlspecialchars($ingredient_dispo['nom']));
    }
    
    $li_difficulte_dispo = Difficulte::liste_difficulte($dbh);
    




$form_values_valid=false;
if(isset($_GET['todo']) && $_GET['todo']=="addRecipe"){
    $id=0;
    // && in_array($_POST["difficulte"],$li_difficulte_dispo)
    
    if(isset($_POST["nom_plat"]) && $_POST["nom_plat"] != "" &&
        isset($_POST["description"]) && $_POST["description"] != "" &&
        isset($_POST["consigne"]) && $_POST["consigne"] != "" &&
        isset($_POST["difficulte"])   && ctype_digit($_POST["difficulte"]) && $_POST["difficulte"] <4 && $_POST["difficulte"] >0 &&
        isset($_POST["nb_personne"]) && ctype_digit($_POST["nb_personne"])&&
        isset($_POST["temps_cuisson"]) && ctype_digit($_POST["temps_cuisson"])&&
        isset($_POST["temps_preparation"]) && ctype_digit($_POST["temps_preparation"]) &&
        isset($_POST["ingredients"]) && isset($_POST["quantites"]) && isset($_POST["unites"]) &&
            function(){
                $res=true;
                foreach($_POST["ingredients"] as $ingredient){
                    $res = $res & in_array($ingredient,$li_ingredient_dispo);
                }
                foreach($_POST["quantite"] as $quantite){
                    $res = $res & ctype_digit($quantite);
                }
            return $res;}
                ){
                if (!empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                    // Le fichier a bien été téléchargé
                    // Par sécurité on utilise getimagesize plutot que les variables $_FILES
                    list($larg,$haut,$type,$attr) = getimagesize($_FILES['photo']['tmp_name']);
                    // JPEG => type=2
                    if ($type == 2) {
                        
                        $insert = Recette::insererRecette($dbh, $_POST['nom_plat'], $_SESSION['login'], null, $_POST['consigne'], $_POST['difficulte'], $_POST['temps_cuisson'], $_POST['temps_preparation'], $_POST['nb_personne']);
                        if($insert){
                            $recipe = Recette::getRecetteByName($dbh,$_POST['nom_plat']);
                            if (move_uploaded_file($_FILES['photo']['tmp_name'],"pictures/recette".$recipe->id.".jpg")) {
                                echo "upload de la photo réussi";
                                $path = "pictures/recette".$recipe->id.".jpg";
                                Recette::changerImage($dbh, $recipe->id,$path);
                                $form_values_valid = true;
                            } 
                            else {
                               echo "upload de la photo échoué";

                            }
                        }
                    } 
                    else
                        echo "mauvais type de fichier";
                }
    }
    if($form_values_valid && count($_POST['ingredients'])== count($_POST['quantites']) && count($_POST['ingredients'])== count($_POST['unites'])) {
        for($i=0;$i<count($_POST['ingredients']);$i++){
            if(!Ingredient::insererIngredientRecette($dbh, $_POST['ingredients'][$i], $recipe->id, $_POST['quantites'][$i], $_POST['unites'][$i])){
                echo "ingredient invalide!";
                $form_value_valid = false;
            }
        }

    }
    
}
    

 
if (!$form_values_valid) {
  // code du formulaire
    //on teste si les champs étaient définis
    if (isset($_POST["nom_plat"])) $nom_plat = htmlspecialchars($_POST["nom_plat"]);
    else $nom_plat = "";
    if (isset($_POST["consigne"])) $consigne = htmlspecialchars($_POST["consigne"]);
    else $consigne = "";
?>

<main>
    <div class="container text-center">
        <form action="index.php?page=AddRecipe&todo=addRecipe" method="post" enctype="multipart/form-data">
            <p> <label> Nom de la recette </label> : <input class="form-control" type="text" name="nom_plat" value="<?php echo $nom_plat ?>" />   </p>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Nom de la recette</span>
                <input class="form-control" type="text" name="nom_plat" value="<?php echo $nom_plat ?>" />
              </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
              </div>
            <p> <label> Photo </label> : <input class="form-control-file" type="file" name="photo" placeholder="photo.jpg"/> </p>
            <p> <label> Description </label> :</br>  
                <textarea class="form-control" name="description"></textarea>
            </p>
            <p> <label> Consignes </label> :</br>  
                <textarea class="form-control" name="consigne"></textarea>
            </p>
            <p> <label> Nombre de Personne </label> : <input class="form-control" type="int" name="nb_personne" /></p>
            <div class="form-group"> <p>Ingrédients</p> 
                <ul>
                    <div  id="add_ingredient">
                    <li> <div class="form-row">
                            <div class="col-md-4 mb-3"><label> ingrédient </label> : <select class="custom-select" name="ingredients[]"><option></option>
                                    <?php
                                    foreach($li_ingredient_dispo as $ingredient_dispo){
                                        echo "<option value=$ingredient_dispo> $ingredient_dispo </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3"><label> quantité </label> : <input class="form-control" type="text" name="quantites[]"/></div>
                            <div class="col-md-4 mb-3"><label> unité </label> : <input class="form-control" type="text" name="unites[]"/></div>
                        </div>
                    </li>
                    </div>
                </ul>
                <input class="btn btn-primary" id="nouvel_ingredient" type="button" value="Nouvel ingrédient">
            </div>
            <br>
            <div>
                <label> Difficulte</label> :
                <select class = "custom-select" name="difficulte">
                    
                    <?php
                    foreach($li_difficulte_dispo as $difficulte_dispo){
                        echo "<option value=$difficulte_dispo->niveau> $difficulte_dispo->difficulte </option>";
                    }
                    ?>
                </select>
            </div>
            <p> <label> Temps de cuisson </label> : <input class="form-control" type="int" name="temps_cuisson" /> mn  </p>
            <p> <label> Temps de préparation </label> : <input class="form-control" type="int" name="temps_preparation" />  mn </p>
            <div class="form-group"><input class="btn btn-success" type = "submit" id="sub" value = "Création de recette"></div>
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

