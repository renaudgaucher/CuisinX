<?php



        function getContent($args) {
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();


    if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true || !isset($_SESSION["login"])) {
        echo "<h1> Veuillez vous connecter d'abord !</h1>";
        return false;
    }
    ?>
    
    <div class="jumbotron text-center">
         <h1 style="font-size: 60px; color: #244b20;">Mon Profil :</h1>
    
    </div>



<?php
}

