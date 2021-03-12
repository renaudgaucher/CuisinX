                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php
$page_list = [
    'Accueil' => [
        'name' => 'Accueil',
        'title' => "Cuisin'X"
    ],
    'Error' => [
        'name' => 'Erreur',
        'title' => 'Page Inaccessible'
    ],
    'Register' => [
        'name' => 'Register',
        'title' => "Créer un compte"
    ],
    'ChangePassword' => [
        'name' => 'ChangePassword',
        'title' => "Changer votre mot de passe"
    ],
    'DeleteUser' => [
        'name' => 'DeleteUser',
        'title' => "Supprimer votre compte"
    ],
    'Login' => [
        'name' => 'Login',
        'title' => "Connectez vous"
    ],
    'Categorie' => [
        'name' => 'Categorie',
        'title' => "Categorie"
    ],
    'Recette' => [
        'name' => 'Recette',
        'title' => "Recette"
    ],
    'Mur' => [
        'name' => 'Mur',
        'title' => "Mur"
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
    
    echo <<<CHAINE_DE_FIN

<nav class="navbar navbar-expand-xxl navbar-dark bg-dark">
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="index.php?page=Accueil">Cuisin'X</a>
    
CHAINE_DE_FIN;
    
            if(isset($_SESSION["loggedIn"]) and $_SESSION["loggedIn"]) {
                printLogoutForm($askedPage);
            } else {
                printLoginLink($askedPage);
            }
      
    
echo <<<CHAINE_DE_FIN
            
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?page=Accueil">Accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=info">Information pratique</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="index.php?page=Faq" tabindex="-1" aria-disabled="true">FAQ</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 mr-sm-2" method="GET">
            <input class="form-control" type="search" placeholder="Rechercher vos amis..." aria-label="Search" name="q">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
    </div>

</nav>      
        
CHAINE_DE_FIN;
}


function generateHTMLHeader($title, $link) {
    echo <<<CHAINE_DE_FIN
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
        </head>
        <body>                    
CHAINE_DE_FIN;
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
</body>

    
CHAINE_DE_FIN;
}

?>


