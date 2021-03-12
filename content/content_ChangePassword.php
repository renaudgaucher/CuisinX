


<div class="jumbotron">
    <h1 class="display-4">Changer de mot de passe</h1>
</div>

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
elseif( isset($_POST["password0"]) && $_POST["password0"] != "" &&
        isset($_POST["password1"]) && $_POST["password1"] != "" &&
        isset($_POST["password2"]) && $_POST["password2"] != ""){
    
    if ($_POST["password2"]!==$_POST["password1"]){
            echo "mots de passe non identiques";
    }
    else{
        $user = Utilisateur::getUtilisateur($dbh, $_SESSION["login"]);
        if(Utilisateur::testerMdp($dbh, $user, $_POST['password0'])){
            $form_values_valid=Utilisateur::changerMdp($dbh, $user, $_POST['password1']);
        }
        else{
            echo "mauvais mot de passe";
        }
    }
}


if (!$form_values_valid) {
    printAccountCreationForm();    
}
else{
    printAccountCreationSuccessForm();
}
}
?>
