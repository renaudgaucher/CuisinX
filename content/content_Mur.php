

<?php

function getContent($args){
    //require("utilities/SQLHandler.php");
    $user = $args['utilisateur'];
    $dbh = $args['dbh'];
    $recettes = Utilisateur::getMyRecettes($dbh,$user->login);
    echo <<<CHAINE_DE_FIN
    <div class="jumbotron">
        <h1 class="display-4">Bienvenue sur sur la page de $user->prenom $user->nom</h1>
        <p class="lead">En panne d'inspi pour le diner de ce soir ? C'est dimanche et le magnan est fermé ? Je suis là pour te sauver !</p>
    </div>
            
    <div class="container">
        <h1 class="display-4">Recettes de $user->prenom $user->nom</h1>        
            <ul class="list-group">
CHAINE_DE_FIN;
    
    foreach($recettes as $recette){
        echo "<li class='list-group-item'>";
        echo $recette['plat'];
        echo "<hr class='my-4'>";
        echo $recette['consigne'];
        echo "</li>";
    }
    if (empty($recettes)){
        echo "pas de recette :(";
    }
     
    
    
    echo <<<FIN
        </ul>
        
   </div>
    
    <br> <br>
    
    <div class="col-md-5 offset-md-1">
        <blockquote class = "blockquote citation">
            <p class = "temoignage">
            <a href='index.php?q=$user->login'> mes amis </a>"
            </p>
        </blockquote>
    </div>
FIN;
}
