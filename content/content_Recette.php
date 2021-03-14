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
                    <p> Difficulté : <?php echo "$recette->difficulte" ?> </p>
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
                    <?php
                    echo "<ul>";
                    foreach($recette->liste_ingredient as $ingredient) {
                            echo "<li>$ingredient->quantite $ingredient->unite $ingredient->nom_ingredient</li>";
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
}

function addIngredient($ingredientNom,$dbh){
    if (compareWithIngredients($ingredientNom,$dbh)){
        return;
    }
    $sql = "INSERT INTO ingredient(nom) VALUES ('$ingredientNom')";
    $dbh->exec($sql);
}

function compareWithIngredients($ingredientNom,$bdd) {
    $query = $bdd->query("SELECT * FROM ingredient");
    foreach ($query as $r) {
        if(strcasecmp($r['ingredientNom'],$ingredientNom)== 0){
            return TRUE;
        }
    }
    return FALSE;
}
