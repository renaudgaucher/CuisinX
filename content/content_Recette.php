<?php
/*
 * On affiche la recette demandee dans $_GET['recette'] (on entre l'id de la recette)
 * 
 */


function getContent($args){
    //require("utilities/SQLHandler.php");
    
    if (!isset($_GET['recette']) || !ctype_digit($_GET['recette'])){
        return false;
    }
    $id_recette = $_GET['recette'];
    $dbh = $args['dbh'];
    $recette = Recette::getRecette($dbh,$id_recette);
    
    if ($recette===null){
        return false;
    }
    //var_dump($recette->image) ;
    //$recette->autoHtmlspecialchars();
    ?>
    <br>
    <div class="jumbotron">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4"> <?php echo "$recette->nom_plat"?> </h1> 
                </div>
                <div class="col-md-3 offset-md-1">
                    <img src="<?php echo "$recette->image" ?>" style="width:200px";>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-2">
                    <p> Temps de cuisson : <?php echo "$recette->temps_cuisson" ?> min</p>
                </div>
                <div class="col-md-3 offset-md-2">
                    <p> Temps de préparation : <?php echo "$recette->temps_preparation" ?> min</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-2">
                    
                    <p> Difficulté : <?php echo Difficulte::id_to_nomDifficulte($dbh, ($recette->id_difficulte)); ?> </p>
                </div>
                <div class="col-md-3 offset-md-2">
                    <p> Contenu : <?php echo Contenu::id_to_contenu($dbh,$recette->id_contenu); ?> </p>
                </div>
                <div class="col-md-3 offset-md-2">
                    <p> Type : <?php echo TypePlat::id_to_nomTypePlat($dbh,$recette->id_type) ?> </p>
                </div>
                <div class="col-md-3 offset-md-2">
                    <p> Par <?php echo "$recette->createur" ?> </p>
                </div>
            </div>
        </div>
        
    </div>
<div class="jumbotron">

        <h1 class="display-4" align="center"> Déroulé de la recette </h1> 
        <hr class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <h4 class="display-4" align="center"> Ingrédients </h4>
                    <br/>
                    <label for="customRange2" class="form-label" id="disp_nb_personne">Nombre de personnes : 1</label>
                    <input type="range" class="range" min="1" max="20" name="nb_personne" value="1" required/>
                    <output></output>
                    <?php
                    echo "<ul id='li_ingredient'>";
                    foreach($recette->liste_ingredient as $ingredient) {
                            echo "<li>$ingredient->quantite $ingredient->unite ". Ingredient::id_to_nomIngredient($dbh,$ingredient->id_ingredient)['nom']."</li>";
                    }

                    echo "</ul>";
                    ?>
                </div>
                <div class="col-md-7 offset-md-2">
                    <h4 class="display-4" align="center"> Recette </h4>
                    <br/>
                    <?php
                    $etaperecette = str_replace( "/h" , "<br><br>" , $recette->consigne );
                    echo "<p>$etaperecette</p>";
                    ?>

                    
                </div>
            </div>
        </div>
        
    </div>
    
    
    

    <?php
    echo"<input type='number' value=$id_recette id='recette' hidden/>";
    var_dump($id_recette);
    
}
