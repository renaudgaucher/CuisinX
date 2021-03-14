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
}
