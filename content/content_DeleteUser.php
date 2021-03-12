


<div class="jumbotron">
    <h1 class="display-4">Se désinscrire</h1>
    <hr class="my-4">


<?php
function getContent($args){
    $dbh=$args['dbh'];


$form_values_valid=false;

// On verifie que l'utilisateur est bien connecté, puis que les mots de passe sont
//acceptables, puis on vérifie que l'utilisateur dans la DB existe, enfin si l'ancien
//mdp correspond on peut le modifier
if(!isset($_SESSION['loggedIn']) or $_SESSION['loggedIn']===false){
    echo "vous devez vous connecter d'abord!";//empêcher l'utilisateur de changer de mdp
}
elseif( isset($_POST["DelLogin"]) && $_POST["DelLogin"] != "" &&
        isset($_POST["DelPassword"]) && $_POST["DelPassword"] != ""){
    
    
        $user = Utilisateur::getUtilisateur($dbh, $_POST["DelLogin"]);
        if (Utilisateur::testerMdp($dbh, $user, $_POST['DelPassword']) and
                        $_POST["DelLogin"]===$_SESSION['login']) {
            $form_values_valid = Utilisateur::supprimerUtilisateur($dbh, $user);
            logOut();
        } 
        else {
            echo "mauvais mot de passe";
        }
    }

echo "</div>";

if (!$form_values_valid) {
    printAccountUnsubscribeForm();    
}
else{
    printAccountUnsubscribeSuccessForm();
}
}
?>
