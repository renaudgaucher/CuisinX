<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Type
 *
 * @author Renaud Gaucher
 */
class TypePlat {
    public $id_type;
    public $nom;
    
    public static function convert_id_to_nomTypePlat($dbh,$id_type){
        $query = "SELECT * FROM `type_plat` WHERE `id`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($id_type));
        if ($request_succeeded){
            $nom_type = $sth->fetch();
            $sth->closeCursor();
            if ($nom_type === false){
                return null;
            }
            return $nom_type;
        }
        else{
            return null;
        }
    }
    public static function convert_nomTypePlat_to_id($dbh,$nom_type){
        $query = "SELECT * FROM `type_plat` WHERE `nom`= ?;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute(array($nom_type));
        if ($request_succeeded){
            $id_type = $sth->fetch();
            $sth->closeCursor();
            if ($id_type === false){
                return null;
            }
            return $id_type;
        }
        else{
            return null;
        }
    }
    public static function liste_typePlat($dbh){
        $query = "SELECT * FROM `type_plat`;";
        $sth = $dbh->prepare($query);
        $request_succeeded = $sth->execute();
        if ($request_succeeded){
            $li_type = $sth->fetchAll();
            $sth->closeCursor();
            if ($li_type === false){
                return null;
            }
            return $li_type;
        }
        else{
            return null;
        }
    }
    
}