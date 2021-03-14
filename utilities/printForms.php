
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

function printLoginForm($askedPage){
    $page = htmlspecialchars($askedPage);
    echo<<<FIN
        <div class="row" style="padding-top:10%">
            <div class="col-md-6 shadow p-3 mb-5 rounded offset-md-3" style="background-color: #d9eeda">
                <h2 class="text-center">Connecte-toi !</h2>
                <form class="form-inline" action = "index.php?todo=login&page=$page" method = "post">
                    <div class="input-group">
                    <div class="container-fluid">
                        <div class="row" style="padding:10px">
                            <div class="col-md-5">
                                <input name = "login" type = "text" class = "form-control" placeholder = "login">
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <input name = "password" type = "password" class = "form-control" placeholder="mot de passe">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 offset-md-5" style="padding:5px">
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
            <div class="w-100"></div>
            <div class="col-md-6 shadow p-3 mb-5 rounded offset-md-3 bg-light text-center">
                <a href="http://localhost/CuisinX/index.php?page=Register">Pas encore de compte ?</a>
            </div>         
         </div>        
FIN;
}

function printLogoutForm($askedPage){
    $page = htmlspecialchars($askedPage);
    echo <<<FIN

        <form class="form-inline my-2 my-lg-0" action = "index.php?todo=logout&page=$page" method = "post">
            <div class = "input-group">
                <button type = "submit" class = "btn btn-danger">Déconnexion</button>
            </div>
        </form>
FIN;
}

function printAccountCreationForm(){
    ?>

    <div class="container bg-light py-5 text-center">
        <form action="index.php?page=ChangePassword" method=post
              oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
            <div>
                <input type="password" required name="password0" placeholder="Ancien mot de passe">
            </div>
            <div>
                <input type="password" required name="password1" placeholder="Nouveau mot de passe">
            </div>
            <div class="my-1">
                <input type="password" name="password2" placeholder="Nouveau mot de passe">
            </div>
            <div class="my-1">
                <button type = "submit" class = "btn btn-primary">Changer mon mot de passe</button>
            </div>
        </form>
    </div>
    
<?php
}

function printAccountCreationSuccessForm(){
    echo <<<FIN
    
    
    <div class="container bg-light py-5 text-center">
        <h2> Vous avez bien changé votre mot de passe <h2>
        <br>
        <a class="btn btn-primary" href="index.php?page=Accueil" role="button">Retour à l'Accueil</a>
    </div>
    
FIN;
}

function printAccountUnsubscribeSuccessForm(){
    echo <<<FIN
    
    
    <div class="container bg-light py-5 text-center">
        <h2> Vous avez bien supprimé votre compte <h2>
        <br>
        <a class="btn btn-primary" href="index.php?page=Accueil" role="button">Retour à l'Accueil</a>
    </div>
    
FIN;
}
function printAccountUnsubscribeForm(){
    echo <<<FIN
    
    
    <div class="container bg-light py-5 text-center">
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

