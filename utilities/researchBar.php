<?php

    session_name("test");
    session_start();

    require('utilities/utils.php');

    $dbh=Database::connect();

    generateHTMLHeader('Recherche', 'css/perso.css');

    generateMenu($dbh);

    if (isset($_GET["q"])) {

        echo '<br><div class="container jumbotron shadow p-3 mb-5 rounded">';
        // on regarde si le terme en entrée est présent dans le nom,la description ou les étapes dans la recette.
        $query = "SELECT * FROM recipes WHERE name LIKE CONCAT('%',?,'%') OR description LIKE CONCAT('%',?,'%') OR steps LIKE CONCAT('%',?,'%')";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_GET["q"],$_GET["q"],$_GET["q"]));
        $compteur = 0;
        while ($element = $sth->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row shadow p-3 mb-5 bg-white rounded"><div class="col-4"><h3>'.htmlspecialchars($element["name"]).'</h3><p><a href="recipe.php?id='.htmlspecialchars($element["id"]).'">Voir plus</a></p></div><div class="col-4"><p>'.htmlspecialchars($element["description"]).'</p></div><div class="col-4"><a href="recipe.php?id='.$element["id"].'"><img src="img/img-'.$element["id"].'.jpg" alt="Image" width="100%"></a></div></div>';
            $compteur++;
        }

        echo '<p class="text-right">La recherche a produit '.$compteur.' résultat(s).</p>';

        echo '</div>';


    }

    else {
        header('Location: index.php');
    }

    generateHTMLFooter();

    $dbh=null;

?>