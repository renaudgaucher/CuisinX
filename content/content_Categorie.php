<?php

    function getContent($args){
         if (!isset($_GET['cat']) || !ctype_digit($_GET['cat'])){
            return false;
         }

        $id_cat = $_GET['cat'];
        $dbh = $args['dbh'];

        if($id_cat == 1){$bg_color = '#bbfac0';}
        elseif($id_cat == 2){$bg_color = '#faf0bb';}
        else {$bg_color = '#ffb1af';}

        echo "<br><div class='container shadow p-3 mb-5 rounded' style='background-color:$bg_color'>";
        $query = "SELECT * FROM recettes WHERE id_difficulte = $id_cat";
        $sth = $dbh->prepare($query);
        $sth->execute(array($_GET['cat']));
        $nb_resultat = 0;
        while ($element = $sth->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="row shadow p-3 mb-5 bg-light rounded align-items-center" style="margin: 3%">
                <div class="col-4 text-center">
                    <h3 style="font-weight:bold">'.htmlspecialchars($element["nom_plat"]).'</h3>
                    <h4 style="font-style: italic">'.htmlspecialchars(TypePlat::id_to_nomTypePlat($dbh,$element["id_type"])).'</h4>
                    <p> <a class="bolien" href="index.php?page=Recette&recette='.htmlspecialchars($element["id"]).'">Voir plus</a> </p>
                </div>
                <div class="col-4 text-center">
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

        echo '<p class="text-right">Il y a '.$nb_resultat.' recette(s) dans cette catégorie.</p>';

        echo '</div>';
    }