<?php
/*
 * On affiche la recette demandee dans $_GET['recette'] (on entre l'id de la recette)
 * 
 */


function getContent($args){
    //require("utilities/SQLHandler.php");
    $id_recette = $_GET['recette'];
    if (!ctype_digit($id_recette)){
        return false;
    }
    $dbh = $args['dbh'];
    $recette = Recette::getRecette($dbh,$id_recette);
    if ($recette===null){
        return void;
    }
    $recette->autoHtmlspecialchars();
    ?>
    <div class="jumbotron">
        <h1 class="display-4"> <?php $recette->nom_plat ?></h1>
        <hr class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-2">
                    <p> Temps de cuisson : <?php $recette->temps_cuisson?></p>
                </div>
                <div class="col-md-3 offset-md-2">
                    <p> Temps de préparation : <?php $recette->temps_preparation?></p>
                </div>
            </div>
        </div>
    </div>
    <div> 
        <p> <?php $recette->consigne?> </p>
    </div>

    <?php
}
