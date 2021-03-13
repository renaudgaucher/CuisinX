<?php


class Difficulte{
    public $difficulte;
    
    public static function liste_difficulte($dbh){
        $query = "SELECT * FROM `difficulte`;";
        $sth = $dbh->prepare($query);
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
}