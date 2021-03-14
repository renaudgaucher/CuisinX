<?php

    function getContent($args){
    if (isset($_POST["q"])) {
        $dbh = $args['dbh'];

        echo '<br><div class="container jumbotron shadow p-3 mb-5 rounded">';
        $query = "SELECT * FROM recettes WHERE nom_plat LIKE CONCAT('%',?,'%') OR consigne LIKE CONCAT('%',?,'%')OR description LIKE CONCAT('%',?,'%')";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_POST["q"],$_POST["q"],$_POST["q"]));
        $nb_resultat = 0;
        while ($element = $sth->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row shadow p-3 mb-5 bg-white rounded align-items-center" style="margin: 3%">
                <div class="col-4 text-center">
                    <h3>'.htmlspecialchars($element["nom_plat"]).'</h3>
                    <p> <a class="bolien" href="index.php?page=Recette&recette='.htmlspecialchars($element["id"]).'">Voir plus</a> </p>
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
