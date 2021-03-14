<?php
class Utilisateur {
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $promotion;
    public $naissance;
    public $email;
    public $admin;
 
    public function __toString() {
        $naissance = date_create($this->naissance);
        $res = htmlspecialchars($this->login).' '.htmlspecialchars($this->prenom)." <strong>".htmlspecialchars($this->nom)."</strong>, né le ".date_format($naissance,'d/m/Y');
        if($this->promotion != null){
            $res = $res.", X".($this->promotion);
        }
        $res = $res.", <strong>".htmlspecialchars($this->email)."</strong>";
        $res = $res."<br> <a href='index.php?q=". htmlspecialchars($this->login)."'> voir ses amis </a>";
        $res = $res."<br> <a href='index.php?m=".htmlspecialchars($this->login)."'> voir son mur </a>";
        return $res;
    }
    
    public static function getUtilisateur($dbh,$login){
        $query = "SELECT * FROM `utilisateurs` WHERE login = ?;";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $request_succeeded = $sth->execute(array($login));
        if ($request_succeeded){
            $user = $sth->fetch();
            $sth->closeCursor();
            if ($user === false){
                return null;
            }
            return $user;
        }
        else{
            return null;
        }
    }
    public static function insererUtilisateur($dbh, $login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $admin) {
        if (Utilisateur::getUtilisateur($dbh,$login) !== null){
            return false;
        }
        $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `admin`) VALUES(?,SHA1(?),?,?,?,?,?,?)");
        return $sth->execute(array($login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $admin));
        
    }
    
    public static function testerMdp($dbh,$user,$mdp){
        if (($user !== null) AND $user->mdp === sha1($mdp)){
            return true;
        }
        return false;
    }
    
    public static function changerMdp($dbh, $user, $mdp) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `mdp`=? WHERE `login`=?;");
        return $sth->execute(array(sha1($mdp),$user->login));
    }
    public static function supprimerUtilisateur($dbh, $user) {
        $sth = $dbh->prepare("DELETE FROM `utilisateurs` WHERE `login`=?;");
        return $sth->execute(array($user->login));
    }

    public static function getMyRecettes($dbh,$login){
        $query = "SELECT * FROM recettes JOIN utilisateurs ON recettes.createur = utilisateurs.login AND utilisateurs.login = ?";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($login));
        if($request_succeeded){
            $recettes = $sth->fetchAll();
            return $recettes;
        }
    }
}
