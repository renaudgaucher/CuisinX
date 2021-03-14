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
}