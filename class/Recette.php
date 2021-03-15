<?php


class Recette{
    public $id;
    public $nom_plat;
    public $createur;
    public $id_difficulte;
    public $id_contenu;
    public $id_type;
    public $image;
    public $consigne;
    public $temps_cuisson;
    public $temps_preparation;
    public $description;
    public $nb_personne;
    public $liste_ingredient;
    
    public function __construct(int $id,string $nom_plat,string $createur,int $id_contenu,int $id_type,string $image,string $consigne,int $id_difficulte,int $temps_cuisson, int $temps_preparation,string $description, int $nb_personne){
        $this->id = $id;
        $this->nom_plat = $nom_plat;
        $this->createur = $createur;
        $this->id_difficulte = $id_difficulte;
        $this->id_contenu = $id_contenu;
        $this->id_type=$id_type;
        $this->image = $image;
        $this->consigne = $consigne;
        $this->temps_cuisson = $temps_cuisson;
        $this->temps_preparation = $temps_preparation;
        $this->description = $description;
        $this->nb_personne=$nb_personne;
        $this->liste_ingredient =[];
    }
    
    public static function getRecette($dbh,$id){
        $query = "SELECT * FROM recettes WHERE id=?";
        $sth = $dbh->prepare($query);
        //$sth->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $request_succeeded = $sth->execute(array($id));
        if($request_succeeded){
            $recette_li = $sth->fetch(PDO::FETCH_ASSOC);
            $sth->closeCursor();
            if ($recette_li===false){
                return null;
            }
            
            if ($recette_li['createur']===Null){ $recette_li['createur'] ="";}
            if ($recette_li['image']===Null){ $recette_li['image'] ="pictures/photo2.jpg";}
            if ($recette_li['temps_cuisson']===Null){ $recette_li['temps_cuisson'] =0;}
            $recette = new Recette($recette_li['id'],$recette_li['nom_plat'],$recette_li['createur'],$recette_li['id_contenu'],$recette_li['id_type'],$recette_li['image'],$recette_li['consigne'],
                                $recette_li['id_difficulte'],$recette_li['temps_cuisson'],$recette_li['temps_preparation'],$recette_li['description'],$recette_li['nb_personne']);
            
            $query = "SELECT * FROM ingredient_recette WHERE id_recette=$recette->id";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
            $request_succeeded = $sth->execute();
            if ($request_succeeded){
                $liste_ingredient = $sth->fetchAll();
                $sth->closeCursor();
                if ($liste_ingredient === false){
                    return null;
                }
                $recette->liste_ingredient = $liste_ingredient;
                return $recette;
            }
            return null;
        }
        else{
            return null;
        }
    }
    
    public static function getRecetteByName($dbh,$nom_plat){
        $query = "SELECT * FROM recettes WHERE nom_plat=?";
        $sth = $dbh->prepare($query);
        //$sth->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $request_succeeded = $sth->execute(array($nom_plat));
        if($request_succeeded){
            $recette_li = $sth->fetch(PDO::FETCH_ASSOC);
            $sth->closeCursor();
            if ($recette_li===false){
                return null;
            }
            
            if ($recette_li['createur']===Null){ $recette_li['createur'] ="";}
            if ($recette_li['image']===Null){ $recette_li['image'] ="pictures/photo2.jpg";}
            if ($recette_li['temps_cuisson']===Null){ $recette_li['temps_cuisson'] =0;}
            $recette = new Recette($recette_li['id'],$recette_li['nom_plat'],$recette_li['createur'],$recette_li['id_contenu'],$recette_li['id_type'],$recette_li['image'],$recette_li['consigne'],
                                $recette_li['id_difficulte'],$recette_li['temps_cuisson'],$recette_li['temps_preparation'],$recette_li['description'],$recette_li['nb_personne']);
            
            $query = "SELECT * FROM ingredient_recette WHERE id_recette=$recette->id";
            $sth = $dbh->prepare($query);
            $sth->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
            $request_succeeded = $sth->execute();
            if ($request_succeeded){
                $liste_ingredient = $sth->fetchAll();
                $sth->closeCursor();
                if ($liste_ingredient === false){
                    return null;
                }
                $recette->liste_ingredient = $liste_ingredient;
                return $recette;
            }
            return null;
        }
        else{
            return null;
        }
    }
    
    public static function getRecetteAleatoire($dbh,$nb_recettes){ //Choisi aleatoirerement $nb_recette et les propose
        $query = "SELECT * FROM recettes";
        $sth = $dbh->prepare($query);
        //$sth->setFetchMode(PDO::FETCH_CLASS, 'Recette');
        $request_succeeded = $sth->execute(array());
        if($request_succeeded){
            $recette_li = $sth->fetchAll(PDO::FETCH_ASSOC);
            $sth->closeCursor();
            if ($recette_li===false){
                return null;
            }
        }
        else{
            return null;
        }
        $li_alea_recette_temp = array_rand($recette_li,$nb_recettes);
        
        $li_alea_recette=[];
        foreach($li_alea_recette_temp as $i_recette_temp){
            $recette=Recette::getRecette($dbh,$recette_li[$i_recette_temp]['id']);
            if($recette==null){
                return null;
            }
            else{
                array_push($li_alea_recette,$recette);
            }
        }
        return $li_alea_recette;
    }
    
    public static function insererRecette($dbh, $nom_plat, $createur,$id_difficulte,$id_contenu,$id_type, $image, $consigne, $temps_cuisson, $temps_preparation,$description,$nombre_personne) {
        $sth = $dbh->prepare("INSERT INTO `recettes` (`id`, `nom_plat`, `createur`, `id_difficulte`,`id_contenu`, `id_type`, `image`, `consigne`, `temps_cuisson`, `temps_preparation`,`description`,`nb_personne`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        return $sth->execute(array(null,$nom_plat, $createur,$id_difficulte,$id_contenu,$id_type, $image, $consigne, $temps_cuisson, $temps_preparation,$description,$nombre_personne));
    }
    
    public static function supprimerRecette($dbh, $recette) {
        $sth = $dbh->prepare("DELETE FROM `recettes` WHERE `id`=?;");
        return $sth->execute(array($recette->id));
    }
    
    public static function changerImage($dbh, $id, $path) {
        $sth = $dbh->prepare("UPDATE `recettes` SET `image`=? WHERE `id`=?;");
        return $sth->execute(array($path,$id));
    }
    
    public static function autoHtmlspecialchars(Recette $recette){
        $recette->nom_plat = htmlspecialchars($recette->nom_plat);
        $recette->createur = htmlspecialchars($recette->createur);
        $recette->consigne = htmlspecialchars($recette->consigne);
        $recette->consigne=str_replace(array("\r\n","\n"),'<br />',$recette->consigne);
        $recette->description=str_replace(array("\r\n","\n"),'<br />',$recette->description);
        foreach($recette->liste_ingredient as $ingredient){
            $ingredient->nom_ingredient=htmlspecialchars($ingredient->nom_ingredient);
            $ingredient->unite=htmlspecialchars($ingredient->unite);
        }
        return $recette;
    }
      
}