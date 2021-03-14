<?php


class Ingredient{
    public $nom_ingredient;
    public $quantite;
    public $unite;
    
    public static function id_to_nomIngredient($dbh,$id_ingredient){
        $query = "SELECT * FROM `ingredient` WHERE `id`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_ingredient));
        if ($request_succeeded){
            $nom_ingredient = $sth->fetch();
            $sth->closeCursor();
            if ($nom_ingredient === false){
                return null;
            }
            return $nom_ingredient;
        }
        else{
            return null;
        }
    }
    public static function nomIngredient_to_id($dbh,$nom_ingredient){
        $query = "SELECT * FROM `ingredient` WHERE `nom`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($nom_ingredient));
        if ($request_succeeded){
            $id_ingredient = $sth->fetch();
            $sth->closeCursor();
            if ($id_ingredient === false){
                return null;
            }
            return $id_ingredient;
        }
        else{
            return null;
        }
    }
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
            foreach($li_ingredient as $ingredient){
                $ingredient['nom_ingredient'] = Ingredient::id_to_nomIngredient($dbh,$ingredient['id']);
            }
            return $li_ingredient;
        }
        else{
            return null;
        }
    }
    
    public static function getIngredient($dbh,$id){
        $query = "SELECT * FROM `ingredient` WHERE id = ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id));
        if ($request_succeeded){
            $ingredient = $sth->fetch();
            $sth->closeCursor();
            if ($ingredient === false){
                return null;
            }
            $ingredient['nom_ingredient'] = Ingredient::id_to_nomIngredient($dbh,$ingredient['id']);
            return $ingredient;
        }
        else{
            return null;
        }
    }
    
    public static function insererIngredientRecette($dbh,$nom_ingredient,$id_recette,$quantite,$unite) {
        $id_ingredient = Ingredient::nomIngredient_to_id($dbh,$nom_ingredient);
        $sth = $dbh->prepare("INSERT INTO `ingredient_recette` (`id_ingredient`,`id_recette`,`quantite`,`unite`) VALUES(?,?,?,?)");
        return $sth->execute(array($id_ingredient['id'],$id_recette,$quantite,$unite));
    }
    
    public static function nouvelIngredient($dbh, $nom) {
        if (Ingredient::nomIngredient_to_id($dbh,$nom) !== null){
            return false;
        }
        $sth = $dbh->prepare("INSERT INTO `ingredient` (`id`,`nom`) VALUES(null,?)");
        return $sth->execute(array($nom));
    }
}