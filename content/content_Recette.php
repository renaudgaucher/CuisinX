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
    //$recette->autoHtmlspecialchars();
    ?>
    <div class="jumbotron">

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4"> <?php echo "$recette->nom_plat"?> </h1> 
                </div>
                <div class="col-md-4 offset-md-2">
                    <img src="<?php echo "$recette->image" ?>" style="width:400px";>
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
            </div>
        </div>
        
    </div>
    <div class="jumbotron">
        <h1 class="display-4"> Ingrédients </h1>
        <hr class="my-4">
        
        
        <?php
        echo "<ul>";
        foreach($recette->liste_ingredients as $ingredient) {
                    echo "<li>$ingredient->quantite $ingredient->unite $$ingredient->nom</li>";
            }

        echo "</ul>";
        ?>
        
        
    </div>
    <div> 
        <p> <?php echo "$recette->consigne" ?> </p>
    </div>

    <?php
}
