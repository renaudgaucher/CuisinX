<?php

function getContent($args) {
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();


    if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true || !isset($_SESSION["login"])) {
        echo "<h1> Veuillez vous connecter d'abord !</h1>";
        return false;
    }
    $login = $_SESSION["login"];
    $dbh = $args['dbh'];
    $utilisateurs = Utilisateur::getUtilisateur($dbh, $login);
    
    $liste_recettes = Utilisateur::getMyRecettes($dbh, $login);
    ?>

    <div class="jumbotron text-center">
        <h1 style="font-size: 60px; color: #244b20;"><?php echo "$utilisateurs->prenom" ?> <?php echo "$utilisateurs->nom" ?></h1>
        <hr class="my-4">
        <span>Pseudo : <?php echo "$utilisateurs->login" ?></span>
        <br>
        <span><?php echo "$utilisateurs->email" ?></span>
        <br>
        <span>Promotion X<?php echo "$utilisateurs->promotion" ?></span>
        <br>
        <span>Date de naissance : <?php echo "$utilisateurs->naissance" ?></span>
        <br>
        <span>Compte <?php if($utilisateurs->admin == 1){echo 'Admin';}
                           else {echo 'Utilisateur';} ?></span>

        

    </div>
    <?php
    foreach($liste_recettes as $recette){
        echo '<div class="row shadow p-3 mb-5 bg-white rounded align-items-center" style="margin: 3%">
                <div class="col-4 text-center">
                    <h3>'.htmlspecialchars($recette["nom_plat"]).'</h3>
                    <p> <a class="bolien" href="index.php?page=Recette&recette='.htmlspecialchars($recette["id"]).'">Voir plus</a> </p>
                </div>
                <div class="col-4">
                    <p>'.htmlspecialchars($recette["description"]).'</p>
                </div>
                <div class="col-4">
                    <a href="index.php?page=Recette&recette='.$recette["id"].'">
                    <img src='.$recette["image"].' alt="Image" width="100%">
                    </a>
                </div>
            </div>';
    }
    
    ?>
   



    <?php
}
