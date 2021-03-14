<!DOCTYPE html>
<?php 
    session_name("MaSession" );
    session_start();
    if (!isset($_SESSION['initiated'])) {
        session_regenerate_id();
        $_SESSION['initiated'] = true;
    }
    if (!isset($_SESSION['loggedIn'])){
        $_SESSION['loggedIn']=false;
    }
    //var_dump($_SESSION);
    //echo("<br>");
    //var_dump($_POST);

    //require & gestion de la BDD
    require('utilities/utils.php');
    
    require("class/Database.php");
    require("class/Utilisateur.php");
    require("class/Ingredient.php");
    require("class/Difficulte.php");
    require("class/Recette.php");
    require("class/TypePlat.php");
    require("class/Contenu.php");
    $dbh = Database::connect(); 
    require("utilities/logInOut.php");
    require("utilities/printForms.php");
    
    // traitement des contenus de formulaires
    if(isset($_GET["todo"])) {
        if($_GET["todo"] == "login"){
            logIn($dbh);
        }
        else if($_GET["todo"] == "logout"){
            logOut();
        }
    }

    //$_GET
    if(isset($_GET["recherche"])){
        $askedPage="Research";
    }
    elseif(isset($_GET["page"])){
        $askedPage = $_GET['page'];
    }
    else{
        $askedPage = 'Accueil';
    }
    $authorized = checkPage($askedPage);

    if($authorized){
        $pageTitle = getPageTitle($askedPage);
        $pageName = getPageName($askedPage);
        
        $args = ['dbh'=>$dbh];
    }
    else{
        $pageTitle = 'Error';
        $pageName = 'Error';
    }
   
    
    if (! isset($args)){ //$args est le tableau contenant tous les elements necessaires au bon affichage du contenu
        $args = null;
    }
    
    generateHTMLHeader($pageTitle, 'perso.css');
    
?>



<!-- Le menu + affichage formulaire -->

<nav id='menu'>
    <?php
    generateMenu($pageName,$askedPage);
    ?>
</nav>

<br>

<!-- Le corps de la page -->

<main id='content'> 
    <?php require("content/content_$pageName.php");
    $result = getContent($args);
    ?>
</main>


<?php
generateHTMLFooter();

$dbh=null;
?>