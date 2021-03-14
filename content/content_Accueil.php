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

$dbh = $args['dbh'];
$res = $dbh->prepare("SELECT COUNT(*) FROM `recettes`");
$res->execute();
$tab = $res->fetch(PDO::FETCH_NUM) ;
$nb = $tab[0] ;
$id_recette1 = rand (1, $nb) ;
$id_recette2 = (($id_recette1 + 1) % $nb) + 1;
$id_recette3 = (($id_recette2 + 1) % $nb) + 1;
$recette1 = Recette::getRecette($dbh,$id_recette1);
$recette2 = Recette::getRecette($dbh,$id_recette2);
$recette3 = Recette::getRecette($dbh,$id_recette3);

?> 

<div class="jumbotron shadow p-3 mb-5 rounded">
    <h1 class="display-4 text-center" style="font-weight: bold; color: #244b20">Bienvenue sur Cuisin'X</h1>
    <p class="lead">En panne d'inspi pour le diner de ce soir ? C'est dimanche et le magnan est fermé ? On est là pour vous sauver !</p>
    <hr class="my-4">
    <p> Vous êtes ici sur le site de recettes de l'école polytechnique, qui vous donne les meilleures recettes, en lien avec les inventaires Chocapix de vos bars d'étage. Temps de préparation, du niveau J'aiDuMalAvecLesPâtes à JeSuisAspiRatatouille, meat-eater/végé/vegan, on a pensé à tout !</p>
    <div class="cat col-md-auto categorie text-center">
        <h2 style="font-size: 25px; color: #244b20">Nos meilleures recettes</h2>
        <br>
        <div class="row align-items-center" style="margin:auto; max-width:1000px">
            <a class="col-md-auto" href="index.php?page=Recette&recette=1"> <?php echo "$recette1->nom_plat" ?></a>
            <a class="col-md-auto ml-auto" href="index.php?page=Recette&recette=2"> <?php echo "$recette2->nom_plat" ?></a>
            <a class="col-md-auto ml-auto" href="index.php?page=Recette&recette=3"> <?php echo "$recette3->nom_plat" ?></a>
            <div class="w-100"></div>
            <div class="col-md-2">
                <img src="<?php echo "$recette1->image" ?>" style="width:200px"; class="img-fluid" alt="<?php echo "$recette1->nom_plat" ?>">
            </div>

            <div class="col-md-2 ml-auto">
                <img src="<?php echo "$recette2->image" ?>" style="width:200px"; class="img-fluid" alt="<?php echo "$recette2->nom_plat" ?>">
            </div>

            <div class="col-md-2 ml-auto">
                <img src="<?php echo "$recette3->image" ?>" style="width:200px"; class="img-fluid" alt="<?php echo "$recette3->nom_plat" ?>">
            </div>
        </div>
</div>
</div>

<br>

<div class="shadow p-3 mb-5 rounded" style="background-color:#d9eeda">

    <div class="cat col-md-auto categorie text-center">
        <h2 style="font-weight: bold; font-size: 60px; color: #a72424;">Les catégories :</h2>
        <br>
        <div class="row align-items-center" style="margin:auto; max-width:1000px">
            <div class="col-md-2">
                <h3>Aspi Ratatouille</h3>
            </div>

            <div class="col-md-2 ml-auto">
                <h3>Cuistot occasionnel</h3>
            </div>

            <div class="col-md-2 ml-auto">
                <h3>J'ai du mal avec les pâtes</h3>
             </div>
            <div class="w-100"></div>
            <div class="col-md-2">
                <img src="pictures/ratatouille.jpg" class="img-fluid" alt="Ratatouille">
            </div>

            <div class="col-md-2 ml-auto">
                <img src="pictures/cuistot.jpg" class="img-fluid" alt="Cuistot">
            </div>

            <div class="col-md-2 ml-auto">
                <img src="pictures/raté.jpg" class="img-fluid" alt="Raté">
             </div>
            <div class="w-100"></div>
            <br>
            <div class="col-md-2">
                <a class="btn btn-danger btn-block" style="white-space:normal; color:white" href="">
                    Si vous cherchez une recette gastronomique c'est par là
                </a>
            </div>
            <div class="col-md-2 ml-auto">
                <a class="btn btn-warning btn-block" style="white-space:normal; color:white" href="">
                    Si vous voulez une recette simple et qualitative c'est ici
                </a>
            </div>
            <div class="col-md-2 ml-auto">
                <a class="btn btn-success btn-block" style="white-space:normal; color:white" href="">
                    Si vous prenez peur devant une casserole, cette catégorie est pour vous
                </a>
            </div>
            <br>
        </div>
    </div>
    <br>
    <br>

</div>



