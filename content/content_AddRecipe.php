<?php

function getContent($args) {
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();


    if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true || !isset($_SESSION["login"])) {
        echo "<h1> Veuillez vous connecter d'abord !</h1>";
        return false;
    }

    $dbh = $args['dbh'];
    $li_ingredient_dispo_temp = Ingredient::liste_ingredients($dbh);
    $li_ingredient_dispo = [];

    foreach ($li_ingredient_dispo_temp as $ingredient_dispo) {
        array_push($li_ingredient_dispo, htmlspecialchars($ingredient_dispo['nom']));
    }

    $li_difficulte_dispo = Difficulte::liste_difficulte($dbh);
    $li_typePlat_dispo = TypePlat::liste_typePlat($dbh);
    $li_contenu_dispo = Contenu::liste_contenu($dbh);
    array_multisort($li_ingredient_dispo);
    





    $form_values_valid = false;
    if (isset($_GET['todo']) && $_GET['todo'] == "addRecipe") {
        $id = 0;
        // && in_array($_POST["difficulte"],$li_difficulte_dispo)

        if (isset($_POST["nom_plat"]) && $_POST["nom_plat"] != "" &&
                isset($_POST["description"]) && $_POST["description"] != "" &&
                isset($_POST["consigne"]) && $_POST["consigne"] != "" &&
                isset($_POST["difficulte"]) && ctype_digit($_POST["difficulte"]) && $_POST["difficulte"] < 4 && $_POST["difficulte"] > 0 &&
                isset($_POST["nb_personne"]) && ctype_digit($_POST["nb_personne"]) &&
                isset($_POST["temps_cuisson"]) && is_numeric($_POST["temps_cuisson"]) &&
                isset($_POST["temps_preparation"]) && is_numeric($_POST["temps_preparation"]) &&
                isset($_POST["contenu"]) && ctype_digit($_POST["contenu"]) &&
                isset($_POST["type"]) && ctype_digit($_POST["type"]) &&
                isset($_POST["ingredients"]) && isset($_POST["quantites"]) && isset($_POST["unites"]))
                {
            $res = true;
            foreach ($_POST["ingredients"] as $ingredient) {
                $res = $res && in_array($ingredient, $li_ingredient_dispo);
            }
            foreach ($_POST["quantites"] as $quantite) {
                $res = $res && is_numeric($quantite);
            }
            
            
            if ($res && !empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
                // Le fichier a bien été téléchargé
                // Par sécurité on utilise getimagesize plutot que les variables $_FILES
                list($larg, $haut, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);
                // JPEG => type=2
                if ($type == 2) {
                    $insert = Recette::insererRecette($dbh, $_POST['nom_plat'], $_SESSION['login'],$_POST['difficulte'],$_POST['contenu'],$_POST['type'], null, $_POST['consigne'],
                                        $_POST['temps_cuisson'], $_POST['temps_preparation'], $_POST['description'], $_POST['nb_personne']);
                    if ($insert) {
                        $recipe = Recette::getRecetteByName($dbh, $_POST['nom_plat']);
                        if (move_uploaded_file($_FILES['photo']['tmp_name'], "pictures/recette" . $recipe->id . ".jpg")) {
                            echo "upload de la photo réussi";
                            $path = "pictures/recette" . $recipe->id . ".jpg";
                            Recette::changerImage($dbh, $recipe->id, $path);
                            $form_values_valid = true;
                        } else {
                            echo "<h2 style='margine:auto;max-width:300px'>upload de la photo échoué </h2>";
                        }
                    }
                } else
                    echo "<h2 style='margine:auto;max-width:300px'> mauvais type de fichier </h2>";
            }
        }
        if ($form_values_valid && count($_POST['ingredients']) == count($_POST['quantites']) && count($_POST['ingredients']) == count($_POST['unites'])) {
            for ($i = 0; $i < count($_POST['ingredients']); $i++) {
                if (!Ingredient::insererIngredientRecette($dbh, $_POST['ingredients'][$i], $recipe->id, $_POST['quantites'][$i], $_POST['unites'][$i])) {
                    echo "ingredient invalide!";
                    $form_value_valid = false;
                }
            }
        }
        else{
            echo "<h2 style='margine:auto;max-width:300px'> Erreur dans la soumission du fichier </h2>";
        }
    if (!$form_values_valid) {
        if(!isset($_POST["nom_plat"]) && !$_POST["nom_plat"] != "") echo "<h2 style='margine:auto;max-width:300px'> Nom du plat manquant </h2>";
        if(!isset($_POST["description"]) && !$_POST["description"] != "") echo "<h2 style='margine:auto;max-width:300px'> Description vide </h2>";
        if(!isset($_POST["consigne"]) && !$_POST["consigne"] != "") echo "<h2 style='margine:auto;max-width:300px'> Consigne manquante </h2>";
        if(!isset($_POST["difficulte"]) && !ctype_digit($_POST["difficulte"]) && $_POST["difficulte"] < 4 && $_POST["difficulte"] > 0) echo "<h2 style='margine:auto;max-width:300px'> Difficulté invalide </h2>";
        if(!isset($_POST["nb_personne"]) && !ctype_digit($_POST["nb_personne"])) echo "<h2 style='margine:auto;max-width:300px'> Nombre de personne invalide </h2>";
        if(!isset($_POST["temps_cuisson"]) && !is_numeric($_POST["temps_cuisson"])) echo "<h2 style='margine:auto;max-width:300px'> Temps de cuisson invalide </h2>";
        if(!isset($_POST["temps_preparation"]) && !is_numeric($_POST["temps_preparation"])) echo "<h2 style='margine:auto;max-width:300px'> Temps de préparation invalide </h2>";
        if(!isset($_POST["contenu"]) && !ctype_digit($_POST["contenu"])) echo "<h2 style='margine:auto;max-width:300px'> Type de contenu invalide </h2>";
        if(!isset($_POST["type"]) && !ctype_digit($_POST["type"])) echo "<h2 style='margine:auto;max-width:300px'> Type de plat invalide </h2>";
        if(!isset($_POST["ingredients"]) || !isset($_POST["quantites"]) || !isset($_POST["unites"])) echo "<h2 style='margine:auto;max-width:300px'> Vous n'avez pas choisi d'ingrédient </h2>";
        if(isset($_POST["ingredients"]) && isset($_POST["quantites"]) && isset($_POST["unites"])){
            $res = true;
            foreach ($_POST["ingredients"] as $ingredient) {
                $res = $res && in_array($ingredient, $li_ingredient_dispo);
            }
            foreach ($_POST["quantites"] as $quantite) {
                $res = $res && is_numeric($quantite);
            }
            if(!$res) echo "<h2 style='margine:auto;max-width:300px'> Liste d'ingrédient invalide ! </h2>";
        }
    }
    }



    if (!$form_values_valid) {
        
        // code du formulaire
        //on teste si les champs étaient définis
        if (isset($_POST["nom_plat"]))
            $nom_plat = htmlspecialchars($_POST["nom_plat"]);
        else
            $nom_plat = "";
        if (isset($_POST["consigne"]))
            $consigne = htmlspecialchars($_POST["consigne"]);
        if (isset($_POST["description"]))
            $description = htmlspecialchars($_POST["description"]);
        else
            $consigne = "";
        ?>

        
            <div class="container text-center">
                <form action="index.php?page=AddRecipe&todo=addRecipe" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nom de la recette</span>
                        <input class="form-control" type="text" name="nom_plat" value="<?php echo $nom_plat; ?>" required/>
                    </div>

                    <p> <label> Photo </label> : <input class="form-control-file" type="file" name="photo" placeholder="photo.jpg" required/> </p>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Description</span>
                        <textarea class="form-control" name="description" value='<?php echo $description; ?>' required></textarea>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Consignes</span>
                        <textarea class="form-control" name="consigne" value='<?php echo $consigne; ?>' required></textarea>
                    </div>

                    <label for="customRange2" class="form-label" id="disp_nb_personne">Nombre de personnes : 1</label>
                    <input type="range" class="range" min="1" max="15" name="nb_personne" value="2" required/>
                    <output></output>

                    <div class="jumbotron shadow p-3 mb-5 rounded">
                        <div class="form-group"> <p>Ingrédients</p> 
                            <div>
                                <div  id="add_ingredient">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3"><label> Ingrédient </label> : <select class="custom-select" name="ingredients[]" required><option></option>
                                                <?php
                                                foreach ($li_ingredient_dispo as $ingredient_dispo) {
                                                    echo "<option value=$ingredient_dispo> $ingredient_dispo </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3"><label> Quantité </label> : <input class="form-control" type="number" name="quantites[]"/></div>
                                        <div class="col-md-4 mb-3"><label> Unité </label> : <input class="form-control" type="text" name="unites[]"/></div>
                                    </div>

                                </div>

                                <input class="btn btn-outline-primary" id="nouvel_ingredient" type="button" value="Ingrédient supplémentaire">
                            </div>
                            <br>
                            </br>
                            <div class="input-group" id="nvlIngr">
                                <span class="input-group-text">Créer un nouvel ingrédient</span>
                                <input class="form-control" id="create_ingredient"/> 
                                <button class="btn btn-outline-success" type="button" id="btn_create_ingredient">Créer</button>
                            </div>
                        </div>
                    </div>



                    <div>
                        <br>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-sm-5 offset-md-1">
                       
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Difficulté</span>
                            <select class = "custom-select" name="difficulte" required>

                                        <?php
                                        foreach ($li_difficulte_dispo as $difficulte_dispo) {
                                            echo "<option value=$difficulte_dispo->niveau> $difficulte_dispo->difficulte </option>";
                                        }
                                        ?>
                                    </select>
                        </div>
                                </div></div></div>
                        <br>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-sm-5 offset-md-1 ">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Temps de cuisson</span>
                                        <input class="form-control" type="number" name="temps_cuisson" required/> 
                                        <span class="input-group-text">min</span>
                                    </div>
                                </div>
                                <div class="col-sm-5 ">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Temps de préparation</span>
                                        <input class="form-control" type="number" name="temps_preparation" required/> 
                                        <span class="input-group-text">min</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Contenu</span>
                        <select class = "custom-select" name="contenu" required> 

                                    <?php
                                    foreach ($li_contenu_dispo as $contenu_dispo) {
                                        echo "<option value=".$contenu_dispo['id'].">". $contenu_dispo['contenu']. "</option>";
                                    }
                                    ?>
                                </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Type de plat</span>
                        <select class = "custom-select" name="type" required>

                                    <?php
                                    foreach ($li_typePlat_dispo as $typePlat) {
                                        var_dump($typePlat);
                                        echo "<option value=".$typePlat['id']."> ".$typePlat['nom']." </option>";
                                    }
                                    ?>
                                </select>
                    </div>

                    <div class="form-group"><input class="btn btn-success" type = "submit" id="sub" value = "Création de recette"></div>
                </form>
            </div>
        


        <?php
    } else {
        //Si le formulaire est valide
        ?>
        <div class="container py-5 text-center">
            <h2> Recette enregistrée ! </h2>
        </div>
        <?php
    }
}
