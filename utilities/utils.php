<?php
$page_list = [
    'Accueil' => [
        'name' => 'Accueil',
        'title' => "Cuisin'X",
    ],
    'Profil' => [
        'name' => 'Profil',
        'title' => "Mon profil",
    ],
    'Error' => [
        'name' => 'Error',
        'title' => 'Erreur',
    ],
    'Research' => [
        'name' => 'Research',
        'title' => 'Recherche',
    ],
    'Register' => [
        'name' => 'Register',
        'title' => "Créer un compte",
    ],
    'ChangePassword' => [
        'name' => 'ChangePassword',
        'title' => "Changer votre mot de passe",
    ],
    'DeleteUser' => [
        'name' => 'DeleteUser',
        'title' => "Supprimer votre compte",
    ],
    'Login' => [
        'name' => 'Login',
        'title' => "Connectez vous",
    ],
    'Categorie' => [
        'name' => 'Categorie',
        'title' => "Categorie",
    ],
    'Recette' => [
        'name' => 'Recette',
        'title' => "Recette",
    ],
    'AddRecipe' => [
        'name' => 'AddRecipe',
        'title' => "Nouvelle recette",
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

function generateMenu($pageName,$askedPage) {
    ?>

    <nav class="navbar navbar-expand-xxl navbar-light bg-light">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand bo" href="index.php?page=Accueil">
        <img src="pictures/toque.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
        Cuisin'X
    </a>

    <form class="form-inline my-2 my-lg-0" action="index.php" method=get>
      <input class="form-control mr-sm-3" type="text" placeholder="Recherche une recette" name="recherche" required>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Miam</button>
    </form>

    <div class="col-md-3">
        <?php 
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]){
        ?>
            <a class="nav-link bo" href="index.php?page=Register">Créer un compte</a>
        <?php
        }
        else{
        ?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" style="color:black; font-family:Optima" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION['login']);?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?page=ChangePassword">Changer mon mot de passe</a>
                    <a class="dropdown-item" href="index.php?page=DeleteUser">Supprimer mon compte</a>
                    <a class="dropdown-item" href="index.php?page=Profil">Mon Profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=AddRecipe">Ajouter une recette</a>
                </div>
            </div>
        <?php
        }
?>
    </div>
    
<?php
    
            if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"]) {
                printLogoutLink($askedPage);
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
                            <a class="nav-link" style="font-weight:bold" href="index.php?page=Accueil">Catégories<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Entrée">Entrée</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Plat">Plat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Dessert">Dessert</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Cocktail">Cocktail</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-0">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Végétarien">Végétarien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Vegan">Vegan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Meat-eater">Meat eater</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?recherche=Sans-porc">Sans porc</a>
                        </li>
                    </ul>
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
            <script src="js/code.js"></script>
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


