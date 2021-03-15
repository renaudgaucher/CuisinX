<?php
function getContent($args){
    // Affichage des formulaires
    echo <<<FIN


    
FIN;
    if (isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"]) {
        
        ?>
<div class="row" style="padding-top:10%">
    <div class="col-md-6 shadow p-3 mb-5 rounded offset-md-3" style="background-color: #d9eeda">
        <h2 class="text-center">Bonjour <?php echo $_SESSION['prenom']?> </h2>
        <br>
        <form class="form-inline" action = "index.php?page=Accueil" method = "post">
            <div class="input-group" style="margin:auto;">
            <div class="container-fluid">
                <br>
                <button type="submit" class="btn btn-outline-success">Retour à l'Accueil</button>
                <br>
                <br>
                <br>
            </div>
            </div>
        </form>
    </div>
    <div class="w-100"></div>       
 </div>
       
<?php
    } else {
        $page = htmlspecialchars('Accueil');
?>

<div class="row" style="padding-top:10%">
    <div class="col-md-6 shadow p-3 mb-5 rounded offset-md-3" style="background-color: #d9eeda">
        <h2 class="text-center">Connecte-toi !</h2>
        <br>
        <form class="form-inline" action = "index.php?todo=login&page=Login" method = "post">
            <div class="input-group" style="margin:auto;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <input name = "login" type = "text" class = "form-control" placeholder = "login">
                    </div>
                    <div class="col-md-5 offset-md-1 ">
                        <input name = "password" type = "password" class = "form-control" placeholder="mot de passe">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3 offset-md-5" >
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
<?php
    }
}
?>