<?php


class Difficulte{
    public $difficulte;
    public $niveau;
    
    public static function liste_difficulte($dbh){
        $query = "SELECT * FROM `difficulte`;";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Difficulte');
        $request_succeeded = $sth->execute();
        if ($request_succeeded){
            $li_difficulte = $sth->fetchAll();
            $sth->closeCursor();
            if ($li_difficulte === false){
                return null;
            }
            return $li_difficulte;
        }
        else{
            return null;
        }
    }
    
    public static function id_to_nomDifficulte($dbh,$id_difficulte){
        $query = "SELECT * FROM `difficulte` WHERE `niveau`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_difficulte));
        if ($request_succeeded){
            $nom_difficulte = $sth->fetch();
            $sth->closeCursor();
            if ($nom_difficulte === false){
                return null;
            }
            return $nom_difficulte['difficulte'];
        }
        else{
            return null;
        }
    }
    public static function nomDifficulte_to_id($dbh,$nom_difficulte){
        $query = "SELECT * FROM `difficulte` WHERE `difficulte`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($nom_difficulte));
        if ($request_succeeded){
            $id_difficulte = $sth->fetch();
            $sth->closeCursor();
            if ($id_difficulte === false){
                return null;
            }
            return $id_difficulte['niveau'];
        }
        else{
            return null;
        }
    }
}