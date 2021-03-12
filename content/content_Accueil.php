<?php
/*
 * Juste pour la page d'Accuei, a long terme ne doit pas servir pour afficher ensuite les recherches ou autre
 */
function getContent($args){
}
    // echo <<<CHAINE_DE_FIN
//CHAINE_DE_FIN;
?>    


<div class="jumbotron">
    <h1 class="display-4">Bienvenue sur Cuisin'X</h1>
    <p class="lead">En panne d'inspi pour le diner de ce soir ? C'est dimanche et le magnan est fermé ? On est là pour vous sauver !</p>
    <hr class="my-4">
    <p> Vous êtes ici sur le site de recettes de l'école polytechnique, qui vous donne les meilleures recettes, en lien avec les inventaires Chocapix de vos bars d'étage. Temps de préparation, du niveau J'aiDuMalAvecLesPâtes à JeSuisAspiRatatouille, meat-eater/végé/vegan, on a pensé à tout !</p>
    <a class="btn btn-primary btn-lg" href="index.php?page=Accueil" role="button">Bouton bientôt utile</a>
</div>

<div class="container-fluid">

    <div class="cat col-md-auto categorie">
        <h2>Les catégories :</h2>
        <div class="row">
            <div class="col-md-2 offset-md-0">
                <h3>Top Chef</h3>
                <img src="pictures/photo1.jpg" class="img-fluid" alt="Top Chef">
                <p>Si vous êtes chauds pour une maxi déter en cuisine, c'est la bonne catégorie</p>
                <a class="btn btn-secondary" href="https://www.google.com/search?q=%C3%A9clair+au+chocolat&tbm=isch&ved=2ahUKEwj6otqC8qLtAhVJlxoKHcdQAScQ2-cCegQIABAA" role="button">Ne pas appuyer si vous avez faim >></a>
            </div>

            <div class="col-md-2 offset-md-2">
                <h3>Rapide</h3>
                <img src="pictures/photo2.jpg" class="img-fluid" alt="Sablier">
                <p>Si vous voulez une recette bonne et rapide, c'est ici</p>
                <a class="btn btn-danger" href="https://www.google.com/search?q=%C3%A9clair+au+chocolat&tbm=isch&ved=2ahUKEwj6otqC8qLtAhVJlxoKHcdQAScQ2-cCegQIABAA" role="button">En 10 min c'est prêt >></a>
            </div>

            <div class="col-md-2 offset-md-2">
                <h3>Débutant</h3>
                <img src="pictures/photo3.jpg" class="img-fluid" alt="Débutant">
                <p>Si vous prenez peur devant une casserole, cette catégorie est pour vous</p>
                <a class="btn btn-primary" href="https://www.google.com/search?q=%C3%A9clair+au+chocolat&tbm=isch&ved=2ahUKEwj6otqC8qLtAhVJlxoKHcdQAScQ2-cCegQIABAA" role="button">Promis c'est facile >></a>
            </div>
        </div>
    </div>
    <br><br>
    <div class="tem">
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <blockquote class="blockquote citation">
                    <p class="temoignage">
                        Ceci est une citation passionnante.
                    </p>
                    <footer class="blockquote-footer">
                        "M. Ghandi, peace activist"
                    </footer>
                </blockquote>
            </div>
            <div class="col-md-5">
                <blockquote class="blockquote citation">
                    <p class="temoignage">
                        Ceci est une autre citation passionnante.
                    </p>
                    <footer class="blockquote-footer">
                        "A. Einstein, scientist"
                    </footer>
                </blockquote>
            </div>
        </div>
    </div>
    <br><br>
    <div class='row'>
        <div class='col-md-4 offset-md-1'>
            <div class='card' style='border-color: #c82333'>
                <div class='card-header' style="color: #fff; background-color: #c82333">
                    <h3>Liste de définitions</h3>
                </div>
                <div class="card-body">
                    <dl>
                        <dt>Branquignol</dt>
                        <dd>Homme qui n'inspire pas confiance</dd>
                        <dt>Embrouillamini</dt>
                        <dd>Situation très embrouillée</dd>
                        <dt>Foutriquet</dt>
                        <dd>Personne chétive, de petite taille</dd>
                        <dt>Avocette</dt>
                        <dd>Oiseau échassier palmipède</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class='col-md-4 offset-md-1'>
            <div class='card' style='border-color:#34ce57'>
                <div class='card-header' style="color: #fff; background-color: #34ce57">
                    <h3>Prépass des binets</h3>
                </div>
                <div class="card-body">
                    <table class="table table-secondary">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Binet</th>
                                <th>Numérus clausus</th>
                                <th>Potentiel de fissure</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Styx</td>
                                <td>7</td>
                                <td>+++</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BôBar</td>
                                <td>6</td>
                                <td>+++++</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>BB</td>
                                <td>15</td>
                                <td>+++</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>JTX</td>
                                <td>16</td>
                                <td>++</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Binet Love</td>
                                <td>8</td>
                                <td>Fissure?</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>BLF</td>
                                <td>20</td>
                                <td>+</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

