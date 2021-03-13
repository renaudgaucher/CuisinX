<?php

function logIn($dbh){
    if (isset($_POST['login']) AND isset($_POST['password'])){
        $user = Utilisateur::getUtilisateur($dbh, $_POST['login']);
        
        if (Utilisateur::testerMdp($dbh, $user, $_POST['password'])){
            $_SESSION['loggedIn']=true;
            $_SESSION['login']=$_POST['login'];
            $_SESSION['prenom']=$user->prenom;
            return true;
        }
        else{
            $_SESSION['loggedIn']=false;
            return false;
        }
    }
    
    
}

function logOut(){
    unset($_SESSION['loggedIn']);
    unset($_SESSION['login']);
    session_unset();
    session_destroy();
}