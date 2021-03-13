<?php
$page_list = [
    'Accueil' => [
        'name' => 'Accueil',
        'title' => "Cuisin'X",
        'allowResearch'=>true
    ],
    'Error' => [
        'name' => 'Error',
        'title' => 'Erreur',
        'allowResearch'=>false
    ],
    'Register' => [
        'name' => 'Register',
        'title' => "Créer un compte",
        'allowResearch'=>false
    ],
    'ChangePassword' => [
        'name' => 'ChangePassword',
        'title' => "Changer votre mot de passe",
        'allowResearch'=>false
    ],
    'DeleteUser' => [
        'name' => 'DeleteUser',
        'title' => "Supprimer votre compte",
        'allowResearch'=>false
    ],
    'Login' => [
        'name' => 'Login',
        'title' => "Connectez vous",
        'allowResearch'=>false
    ],
    'Categorie' => [
        'name' => 'Categorie',
        'title' => "Categorie",
        'allowResearch'=>true
    ],
    'Recette' => [
        'name' => 'Recette',
        'title' => "Recette",
        'allowResearch'=>true
    ],
    'AddRecipe' => [
        'name' => 'AddRecipe',
        'title' => "Nouvelle recette",
        'allowResearch'=>false
    ],
    'Mur' => [
        'name' => 'Mur',
        'title' => "Mur",
        'allowResearch'=>true
    ]
];

function checkPage($askedPage) {
    global $page_list;
    if (array_key_exists($askedPage, $page_list)) {
        return true;
    } else {
        return false;
    }
}

function getPageTitle($page) {
    global $page_list;
    return $page_list[$page]['title'];
}

function getPageName($page) {
    global $page_list;
    return $page_list[$page]['name'];
}

function getAllowResearchBar($page){
    global $page_list;
    return $page_list[$page]['allowResearch'];
}
function generateMenu($pageName,$askedPage) {
    
    ?>

<nav class="navbar navbar-expand-xxl navbar-light bg-light">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="index.php?page=Accueil">Cuisin'X</a>
    
<?php
    
            if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"]) {
                printLogoutForm($askedPage);
            } else {
                printLoginLink($askedPage);
            }
      
    
?>
            
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="navbar-nav mr-auto">
            <div class="row">
                <div class="col-md-4">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?page=Accueil">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?page=Categorie">Categorie <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=Accueil">Vegétarien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=Accueil">Noel</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
<?php 
if (!$_SESSION['loggedIn']){
?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=Register">Créer un compte</a>
                    </li>
<?php
}
else{

?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=Profil"><?php echo htmlspecialchars($_SESSION['prenom']);?></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=ChangePassword">Changer mon mot de passe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=DeleteUser">Supprimer mon compte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=AddRecipe">Ajouter une recette</a>
                    </li>
<?php
}
?>
                </div>
            </div>
        </div>
    </div>

</nav>      
        
<?php
}




function generateHTMLHeader($title, $link) {
    echo<<<FIN
        <head>       
            <title>$title</title>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <!-- Bootstrap CSS -->
            <link href='css/bootstrap.min.css' rel='stylesheet'>
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src='js/jquery.min.js'></script>
            <script src='js/popper.min.js'></script>
            <script src='js/bootstrap.min.js'></script>
            <!-- Mon CSS Perso -->
            <link href='css/$link' rel='stylesheet'>
            <link rel="icon" type="image/jpg" href="pictures/toque.jpg">
        </head>
        <body>                    
FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
</body>

    
CHAINE_DE_FIN;
}



function generateResearchBar(){
    echo <<<FIN
        <div class="container">
            <form action="index.php?page=content_Research" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Je recherche..." required>
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
        
FIN;
}
?>


