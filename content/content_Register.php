<?php
function getContent($args){
    $dbh=$args['dbh'];


$form_values_valid=false;

if(isset($_POST["login"]) && $_POST["login"] != "" &&
        isset($_POST["email"]) && $_POST["email"] != "" &&
        isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
        isset($_POST["nom"]) && $_POST["nom"] != "" &&
        isset($_POST["naissance"]) && $_POST["naissance"] != "" &&
        isset($_POST["password1"]) && $_POST["password1"] != "" &&
        isset($_POST["password2"]) && $_POST["password2"] != ""){
    
    
    $user=Utilisateur::getUtilisateur($dbh, $_POST["login"]);
    if($user!==null){
        echo "login invalide";
    }
    elseif ($_POST["password2"]!==$_POST["password1"]){
            echo "mots de passe non identiques";
    }
    else{
        if(! isset($_POST['promotion'])){
            $_POST['promotion']=null;
        }
        $insert = Utilisateur::insererUtilisateur($dbh, $_POST['login'], $_POST['password1'], $_POST['nom'], $_POST['prenom'], $_POST['promotion'], $_POST['naissance'], $_POST['email'], 'classe.css');
        $form_values_valid = $insert;
    }
}
 
if (!$form_values_valid) {
  // code du formulaire
    //on teste si les champs étaint définis
    if (isset($_POST["prenom"])) $prenom = htmlspecialchars($_POST["prenom"]);
    else $prenom = "";
    if (isset($_POST["nom"])) $nom = htmlspecialchars($_POST["nom"]);
    else $nom = "";
    if (isset($_POST["login"])) $login = htmlspecialchars($_POST["login"]);
    else $login = "";
    if (isset($_POST["email"])) $email = htmlspecialchars($_POST["email"]);
    else $email = "";
    if (isset($_POST["naissance"])) $naissance = htmlspecialchars($_POST["naissance"]);
    else $naissance = "";
    if (isset($_POST["promotion"])) $promotion = htmlspecialchars($_POST["promotion"]);
    else $promotion = "";
    
?>

<main>
    <div class="py-5 text-center container">
        <form action="index.php?page=Register&todo=register" method=post
              oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
            <div class="my-1">
                <input type="text" required name="login" value="<?php echo $login ?>" placeholder="Votre pseudo">
            </div>
            <div class="my-1">
                <input type="text" required name="nom" value="<?php echo $nom ?>" placeholder="Votre nom">
            </div>
            <div class="my-1">
                <input type="text" required name="prenom" value="<?php echo $prenom ?>" placeholder="Votre prenom">
            </div>
            <div class="my-1">
                <input type="email" required name="email" value="<?php echo $email ?>" placeholder="Votre adresse e-mail">
            </div>
            <div class="my-1">
                <input type="date" required name="naissance" value="<?php echo $naissance ?>">
            </div>
            <div class="my-1">
                <input type="number" name="promotion" value="<?php echo $promotion ?>" placeholder="Votre promotion">
            </div>
            <div class="my-1">
                <input type="password" required name="password1" placeholder="Votre mot de passe">
            </div>
            <div class="my-1">
                <input type="password" name="password2" placeholder="Confirmer votre mot de passe">
            </div>
            <div class="my-1">
                <button type = "submit" class = "btn btn-primary">Créer compte</button>
            </div>
        </form>
    </div>
</main>

<?php

}
else{
    //Si le formulaire est valide
    

?>
<main class="container py-5 text-center">
    <h2> compte enregistré ! </h2>
</main>
<?php
}
}
