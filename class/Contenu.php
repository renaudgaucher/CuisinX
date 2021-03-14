<?php


class Contenu {
    public $id;
    public $contenu;
    
    public static function id_to_contenu($dbh,$id){
        $query = "SELECT * FROM `contenu` WHERE `id`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id));
        if ($request_succeeded){
            $contenu = $sth->fetch();
            $sth->closeCursor();
            if ($contenu === false){
                return null;
            }
            return $contenu['contenu'];
        }
        else{
            return null;
        }
    }
    public static function contenu_to_id($dbh,$contenu){
        $query = "SELECT * FROM `contenu` WHERE `contenu`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($contenu));
        if ($request_succeeded){
            $id_contenu = $sth->fetch();
            $sth->closeCursor();
            if ($id_contenu === false){
                return null;
            }
            return $id_contenu['id'];
        }
        else{
            return null;
        }
    }
    public static function liste_contenu($dbh){
        $query = "SELECT * FROM `contenu`;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        if ($request_succeeded){
            $li_contenu = $sth->fetchAll();
            $sth->closeCursor();
            if ($li_contenu === false){
                return null;
            }
            return $li_contenu;
        }
        else{
            return null;
        }
    }
    
}

