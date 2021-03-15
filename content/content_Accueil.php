<?php
/*
 * Juste pour la page d'Accueil, a long terme ne doit pas servir pour afficher ensuite les recherches ou autre
 */
function getContent($args){
}
    // echo <<<CHAINE_DE_FIN
//CHAINE_DE_FIN;
?>  

<?php

$li_alea_recette=Recette::getRecetteAleatoire($dbh, 3);
$recette1 = $li_alea_recette[0];
$recette2 = $li_alea_recette[1];
$recette3 = $li_alea_recette[2];



echo '<div class="jumbotron shadow p-3 mb-5 rounded">
    <h1 class="display-4 text-center" style="font-weight: bold; color: #244b20">Bienvenue sur Cuisin\'X</h1>
    <p class="lead">En panne d\'inspi pour le diner de ce soir ? C\'est dimanche et le magnan est fermé ? On est là pour vous sauver !</p>
    <hr class="my-4">
    <p> Vous êtes ici sur le site de recettes de l\'école polytechnique, qui vous fournit les meilleures recettes et vous permet de poster les votres ! Temps de préparation, du niveau J\'aiDuMalAvecLesPâtes à JeSuisAspiRatatouille, meat-eater/végé/vegan, on a pensé à tout !</p>
    <div class="cat col-md-auto text-center">
        <h2 style="font-size: 25px; color: #244b20">Recettes aléatoires</h2>
        <br>
        <div class="row align-items-center" style="margin:auto; max-width:1200px">
            <div class="col-md-2 align-items-center">
                <a class="bolien" href="index.php?page=Recette&recette='.$recette1->id.'">'.$recette1->nom_plat.'</a>
                <img src="'.$recette1->image.'" style="width:200px" alt="'.$recette1->nom_plat.'">
            </div>

            <div class="col-md-2 ml-auto align-items-center">
                <a class="bolien" href="index.php?page=Recette&recette='.$recette2->id.'">'.$recette2->nom_plat.'</a>
                <img src="'.$recette2->image.'" style="width:200px" alt="'.$recette2->nom_plat.'">
            </div>

            <div class="col-md-2 ml-auto align-items-center">
                <a class="bolien" href="index.php?page=Recette&recette='.$recette3->id.'">'.$recette3->nom_plat.'</a>
                <img src="'.$recette3->image.'" style="width:200px" alt="'.$recette3->nom_plat.'">
            </div>
        </div>
</div>
</div>' ;

?>

<br>

<div class="shadow p-3 mb-5 rounded" style="background-color:#eaf5ea">

    <div class="cat col-md-auto categorie text-center">
        <h2 style="font-weight: bold; font-size: 60px; color: #244b20;">Les difficultés :</h2>
        <hr class="my-4">
        <div class="row align-items-center" style="margin:auto; max-width:1000px">
            <div class="col-md-2">
                <h3>J'ai du mal avec les pâtes</h3>
             </div>

            <div class="col-md-2 ml-auto">
                <h3>Cuistot occasionnel</h3>
            </div>

             <div class="col-md-2 ml-auto">
                <h3>Aspi Ratatouille</h3>
            </div>
            <div class="w-100"></div>
            <div class="col-md-2">
                <img src="pictures/raté.jpg" class="img-fluid" alt="Raté">
             </div>
            <div class="col-md-2 ml-auto">
                <img src="pictures/cuistot.jpg" class="img-fluid" alt="Cuistot">
            </div>
            <div class="col-md-2 ml-auto">
                <img src="pictures/ratatouille.jpg" class="img-fluid" alt="Ratatouille">
            </div>
            <div class="w-100"></div>
            <br>
            <div class="col-md-2">
                <a class="btn btn-success btn-block" style="white-space:normal; color:white" href="http://localhost/CuisinX/index.php?page=Categorie&cat=1">
                    Si vous prenez peur devant une casserole, cette catégorie est pour vous
                </a>
            </div>
            <div class="col-md-2 ml-auto">
                <a class="btn btn-warning btn-block" style="white-space:normal; color:white" href="http://localhost/CuisinX/index.php?page=Categorie&cat=2">
                    Si vous voulez une recette simple et qualitative c'est ici
                </a>
            </div>
            <div class="col-md-2 ml-auto">
                <a class="btn btn-danger btn-block" style="white-space:normal; color:white" href="http://localhost/CuisinX/index.php?page=Categorie&cat=3">
                    Si vous cherchez une recette gastronomique c'est par là
                </a>
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>

</div>



