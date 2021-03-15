<?php

function getContent($args) {
    $dbh = $args['dbh'];


    $form_values_valid = false;

    if (isset($_POST["login"]) && $_POST["login"] != "" &&
            isset($_POST["email"]) && $_POST["email"] != "" &&
            isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
            isset($_POST["nom"]) && $_POST["nom"] != "" &&
            isset($_POST["naissance"]) && $_POST["naissance"] != "" &&
            isset($_POST["password1"]) && $_POST["password1"] != "" &&
            isset($_POST["password2"]) && $_POST["password2"] != "") {


        $user = Utilisateur::getUtilisateur($dbh, $_POST["login"]);
        if ($user !== null) {
            echo "login invalide";
        } elseif ($_POST["password2"] !== $_POST["password1"]) {
            echo "mots de passe non identiques";
        } else {
            if (!isset($_POST['promotion'])) {
                $_POST['promotion'] = null;
            }
            $insert = Utilisateur::insererUtilisateur($dbh, $_POST['login'], $_POST['password1'], $_POST['nom'], $_POST['prenom'], $_POST['promotion'], $_POST['naissance'], $_POST['email'], '0');
            $form_values_valid = $insert;
        }
    }

    if (!$form_values_valid) {
        // code du formulaire
        //on teste si les champs étaint définis
        if (isset($_POST["prenom"]))
            $prenom = htmlspecialchars($_POST["prenom"]);
        else
            $prenom = "";
        if (isset($_POST["nom"]))
            $nom = htmlspecialchars($_POST["nom"]);
        else
            $nom = "";
        if (isset($_POST["login"]))
            $login = htmlspecialchars($_POST["login"]);
        else
            $login = "";
        if (isset($_POST["email"]))
            $email = htmlspecialchars($_POST["email"]);
        else
            $email = "";
        if (isset($_POST["naissance"]))
            $naissance = htmlspecialchars($_POST["naissance"]);
        else
            $naissance = "";
        if (isset($_POST["promotion"]))
            $promotion = htmlspecialchars($_POST["promotion"]);
        else
            $promotion = "";
        ?>

        <main>
            <div class="container shadow p-3 mb-5 rounded py-5 bg-light text-center">
                <h3>Vous pourrez bientôt publier une recette !</h3>
                <br>
                <form action="index.php?page=Register&todo=register" method=post
                      oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">


                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Pseudo</span>
                        <input type="text" required name="login" value="<?php echo $login ?>" placeholder="xavierdupont" class="form-control">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">Prénom et Nom</span>
                        <input type="text" required name="prenom" value="<?php echo $prenom ?>" placeholder="Xavier" class="form-control">
                        <input type="text" required name="nom" value="<?php echo $nom ?>" placeholder="Dupont" class="form-control">
                    </div>
                    <br>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">@</span>
                        <input type="email" required name="email" value="<?php echo $email ?>" placeholder="xavierdupont@hotmail.fr" class="form-control">
                    </div>
                    <br>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Date de naissance</span>
                        <input type="date" required name="naissance" value="<?php echo $naissance ?>" class="form-control">
                    </div>
                    <br>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Promotion X</span>
                        <input type="number" name="promotion" value="<?php echo $promotion ?>" placeholder="2019" class="form-control">
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Mot de passe</span>
                            <input type="password" required name="password1" placeholder="1234" class="form-control">
                        <span class="input-group-text">Confirmer le mot de passe</span>
                        <input type="password" name="password2" placeholder="1234" class="form-control">
                    </div>
                    <div class="my-1">
                         <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon03">Créer Compte</button>
                    </div>
                </form>
            </div>
        </main>

        <?php
    } else {
        //Si le formulaire est valide
        ?>
        <main class="container jumbotron shadow p-3 mb-5 rounded py-5 text-center">
            <h2> Compte enregistré ! </h2>
            <a class="btn btn-success" href="http://localhost/CuisinX/index.php?page=Login"> Connexion </a>
        </main>
        <?php
    }
}
