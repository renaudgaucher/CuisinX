<?php

function getContent($args){
    //require("utilities/SQLHandler.php");
    $user = $args['utilisateur'];
    $dbh = $args['dbh'];
    $amis = Utilisateur::getAmis($dbh,$user->login);
    echo <<<CHAINE_DE_FIN
    <div class="container">
        <h1 class="display-4">Amis de $user->prenom $user->nom</h1>        
            <ul class="list-group">
CHAINE_DE_FIN;
    
    foreach($amis as $value){
        echo "<li class='list-group-item'>";
        echo $value;
        echo "</li>";
    }
     
    
    
    echo "</ul>
        
   </div>";
}
