
<?php


function printLoginLink($askedPage){
    ?>
    <form class="form-inline my-2 my-lg-0" action = "index.php?page=Login" method = "post">
            <div class = "input-group">
                <button type = "submit" class = "btn btn-success">Connexion</button>
            </div>
    </form>
<?php
}


function printLogoutLink($askedPage){
    $page = htmlspecialchars($askedPage);
    echo <<<FIN

        <form class="form-inline my-2 my-lg-0" action = "index.php?todo=logout&page=Accueil" method = "post">
            <div class = "input-group">
                <button type = "submit" class = "btn btn-danger">Déconnexion</button>
            </div>
        </form>
FIN;
}

function printAccountCreationForm(){
    ?>

    <div class="row align-items-center bg-light py-5 shadow p-3 mb-5 rounded text-center">
        <div class="col-md-2">
            <img src="pictures/mdp.jpg" style="width:300px" alt="Cadenas">
        </div>
        <form class="col-md-8" action="index.php?page=ChangePassword" method=post
              oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
            <div>
                <input type="password" required name="password0" placeholder="Ancien mot de passe">
            </div>
            <br>
            <div>
                <input type="password" required name="password1" placeholder="Nouveau mot de passe">
            </div>
            <div class="my-1">
                <input type="password" name="password2" placeholder="Nouveau mot de passe">
            </div>
            <br>
            <div class="my-1">
                <button type = "submit" class = "btn btn-outline-success">Changer mon mot de passe</button>
            </div>
        </form>
    </div>
    
<?php
}

function printAccountCreationSuccessForm(){
    echo <<<FIN
    
    
    <div class="container bg-light py-5 shadow p-3 mb-5 rounded text-center">
        <h2> Vous avez bien changé votre mot de passe <h2>
        <br>
        <a class="btn btn-primary" href="index.php?page=Accueil" role="button">Retour à l'Accueil</a>
    </div>
    
FIN;
}

function printAccountUnsubscribeSuccessForm(){
    echo <<<FIN
    
    
    <div class="container bg-light py-5 shadow p-3 mb-5 rounded text-center">
        <h2> Vous avez bien supprimé votre compte <h2>
        <br>
        <a class="btn btn-primary" href="index.php?page=Accueil" role="button">Retour à l'Accueil</a>
    </div>
    
FIN;
}
function printAccountUnsubscribeForm(){
    echo <<<FIN
    
    
    <div class="container bg-light text-center py-5 shadow p-3 mb-5 rounded">
        <form action="index.php?page=DeleteUser" method=post>
            <div>
                <input type="text" required name="DelLogin" placeholder="login">
            </div>
            <div>
                <input type="password" required name="DelPassword" placeholder="Mot de passe">
            </div>
            <div class="my-1">
                <button type = "submit" class = "btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
    
FIN;
}

?>

