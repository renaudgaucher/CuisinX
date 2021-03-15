<?php

    function getContent($args){
    if (isset($_GET["recherche"])) {
        $dbh = $args['dbh'];

        echo '<br><div class="container jumbotron shadow p-3 mb-5 rounded">
        <h3 style="margin: 25px; color: #244b20">
            Résultats pour : '.htmlspecialchars($_GET["recherche"]).'
        </h2>';
        $query = "SELECT recettes.id,recettes.nom_plat, recettes.createur,recettes.id_difficulte,recettes.id_contenu,
        recettes.id_type,recettes.image,recettes.consigne,recettes.temps_cuisson,recettes.temps_preparation,
        recettes.description,recettes.nb_personne 
        FROM recettes, type_plat, contenu WHERE type_plat.id = recettes.id_type AND contenu.id = recettes.id_contenu 
        AND (recettes.nom_plat LIKE CONCAT('%',?,'%') OR recettes.consigne LIKE CONCAT('%',?,'%') OR recettes.description 
        LIKE CONCAT('%',?,'%') OR type_plat.nom LIKE CONCAT('%',?,'%') OR contenu.contenu LIKE CONCAT('%',?,'%'))";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_GET["recherche"],$_GET["recherche"],$_GET["recherche"],$_GET["recherche"],$_GET["recherche"]));
        $nb_resultat = 0;
        while ($element = $sth->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row shadow p-3 mb-5 bg-white rounded align-items-center" style="margin: 3%">
                <div class="col-4">
                    <h3 style="font-weight:bold" class="text-center">'.htmlspecialchars($element["nom_plat"]).'</h3>
                    <br>
                    <p style="font-style:italic">Temps de cuisson : '.htmlspecialchars($element["temps_cuisson"]).' min</p>
                    <p style="font-style:italic">Temps de préparation : '.htmlspecialchars($element["temps_preparation"]).' min</p>
                    <p style="font-style:italic">Difficulté : '.htmlspecialchars(Difficulte::id_to_nomDifficulte($dbh, ($element["id_difficulte"]))).'</p>
                    <p class="text-center"> <a class="bolien" href="index.php?page=Recette&recette='.htmlspecialchars($element["id"]).'">Voir plus</a> </p>
                </div>
                <div class="col-4">
                    <p>'.htmlspecialchars($element["description"]).'</p>
                </div>
                <div class="col-4">
                    <a href="index.php?page=Recette&recette='.$element["id"].'">
                    <img src='.$element["image"].' alt="Image" width="100%">
                    </a>
                </div>
            </div>';
            $nb_resultat++;
        }

        echo '<p class="text-right">La recherche a produit '.$nb_resultat.' résultat(s).</p>';

        echo '</div>';


    }
}
