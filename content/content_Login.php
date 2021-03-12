<?php
function getContent($args){
    // Affichage des formulaires
    echo <<<FIN


    
FIN;
    if (isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"]) {
        printLogoutForm("Accueil");
    } else {
        printLoginForm("Accueil");
    }
}
