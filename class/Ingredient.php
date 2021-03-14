<?php


class Ingredient{
    public $nom_ingredient;
    public $quantite;
    public $unite;
    
    public static function liste_ingredients($dbh){
        $query = "SELECT * FROM `ingredient`;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        if ($request_succeeded){
            $li_ingredient = $sth->fetchAll();
            $sth->closeCursor();
            if ($li_ingredient === false){
                return null;
            }
            return $li_ingredient;
        }
        else{
            return null;
        }
    }
    
    public static function getIngredient($dbh,$nom){
        $query = "SELECT * FROM `ingredient` WHERE nom = ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($nom));
        if ($request_succeeded){
            $ingredient = $sth->fetch();
            $sth->closeCursor();
            if ($ingredient === false){
                return null;
            }
            return $ingredient;
        }
        else{
            return null;
        }
    }
    
    public static function insererIngredientRecette($dbh,$nom_ingredient,$id_recette,$quantite,$unite) {
        $sth = $dbh->prepare("INSERT INTO `ingredient_recette` (`nom_ingredient`,`id_recette`,`quantite`,`unite`) VALUES(?,?,?,?)");
        return $sth->execute(array($nom_ingredient,$id_recette,$quantite,$unite));
    }
    
    public static function insererIngredient($dbh, $nom) {
        if (Ingredient::getIngredient($dbh,$nom) !== null){
            return false;
        }
        $sth = $dbh->prepare("INSERT INTO `ingredient` (`nom`) VALUES(?)");
        return $sth->execute(array($nom));
    }
}