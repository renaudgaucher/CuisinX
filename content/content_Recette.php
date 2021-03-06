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
    $recette = Recette::autoHtmlspecialchars($recette);
    //var_dump($recette->image) ;
    //$recette->autoHtmlspecialchars();
    
    if(isset($_POST) && isset($_POST["delete"]) && $_POST["delete"]=="SUPPRIMER RECETTE"&&
            session_status()==PHP_SESSION_ACTIVE && isset($_SESSION['login']) && Utilisateur::getUtilisateur($dbh, $_SESSION['login'])->admin==1){
        Recette::supprimerRecette($dbh, $recette);
        ?>
    <div class='jumbotron'>
        <h1 class='align-items-center'>
            Vous avez supprimé la recette !
        </h1>
    </div>
    <?php    
    }
    else{
    
    
    ?>
    <br>
    <div class="jumbotron shadow p-3 mb-5 rounded">

        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4" style="font-weight:bold"> <?php echo "$recette->nom_plat"?> </h1> 
                </div>
                <div class="col-md-0 offset-md-0">
                    <img src="<?php echo "$recette->image" ?>" style="width:400px" alt="<?php echo "$recette->image" ?>">
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Temps de cuisson : <?php echo "$recette->temps_cuisson" ?> min</p>
                </div>
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Temps de préparation : <?php echo "$recette->temps_preparation" ?> min</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Difficulté : <?php echo Difficulte::id_to_nomDifficulte($dbh, ($recette->id_difficulte)); ?> </p>
                </div>
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Contenu : <?php echo Contenu::id_to_contenu($dbh,$recette->id_contenu); ?> </p>
                </div>
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Type : <?php echo TypePlat::id_to_nomTypePlat($dbh,$recette->id_type) ?> </p>
                </div>
                <div class="col-md-3 offset-md-2" style="font-style:italic">
                    <p> Par <?php echo "$recette->createur" ?> </p>
                </div>
            </div>
        </div>
        
    </div>
<div class="jumbotron shadow p-3 mb-5 rounded">

        <h1 class="display-4 text-center"> Déroulé de la recette </h1> 
        <hr class="my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <h4 class="display-4 text-center"> Ingrédients </h4>
                    <br/>
                    <label class="form-label" id="disp_nb_personne">Nombre de personnes : <?php echo "$recette->nb_personne" ?></label>
                    <input type="range" class="range" min="1" max="20" name="nb_personne" value="<?php echo "$recette->nb_personne" ?>"/>
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
                    <h4 class="display-4"> Recette </h4>
                    <br/>
                    <?php
                    $etaperecette = str_replace( "/h" , "<br><br>" , $recette->consigne );
                    echo "<p>$etaperecette</p>";
                    ?>

                    
                </div>
            </div>
        </div>
        <?php
        if(session_status()==PHP_SESSION_ACTIVE && isset($_SESSION['login']) && Utilisateur::getUtilisateur($dbh, $_SESSION['login'])->admin==1){
            ?>   
        <div style="margin:auto;max-width:400px;text-align:center">
            <br><br>
            
            <form action="index.php?page=Recette&recette=<?php echo htmlspecialchars($_GET['recette']) ?>" method=post>
                <input type="submit" class="btn btn-outline-danger" value="SUPPRIMER RECETTE" name="delete"\>
            </form>
        </div>
        <?php
        }
        ?>
    </div>
    
    
    

    <?php
    echo"<input type='number' value=$id_recette id='recette' hidden/>";
    
}
}
