<?php


class Recette{
    public $id;
    public $nom_plat;
    public $createur;
    public $image;
    public $consigne;
    public $difficulte;
    public $temps_cuisson;
    public $temps_preparation;
    public $liste_ingredient;
    
    public function __construct(int $id,string $nom_plat,string $createur,string $image,string $consigne,string $difficulte,int $temps_cuisson, int $temps_preparation){
        $this->id = $id;
        $this->nom_plat = $nom_plat;
        $this->createur = $createur;
        $this->image = $image;
        $this->consigne = $consigne;
        $this->difficulte = $difficulte;
        $this->temps_cuisson = $temps_cuisson;
        $this->temps_preparation = $temps_preparation;
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
            $recette = new Recette($recette_li['id'],$recette_li['nom_plat'],$recette_li['createur'],$recette_li['image'],$recette_li['consigne'],
                                $recette_li['difficulte'],$recette_li['temps_cuisson'],$recette_li['temps_preparation']);
            
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
    
    public static function insererRecette($dbh, $nom_plat, $createur, $image, $consigne, $difficulte, $temps_cuisson, $temps_preparation,$type_plat) {
        if (Recette::getRecette($dbh,$id) !== null){
            return false;
        }
        $sth = $dbh->prepare("INSERT INTO `recettes` (`id`, `nom_plat`, `createur`, `image`, `consigne`, `difficulte`, `temps_cuisson`, `temps_preparation`) VALUES(?,?,?,?,?,?,?,?)");
        return $sth->execute(array(null,$nom_plat, $createur, $image, $consigne, $difficulte, $temps_cuisson, $temps_preparation));
    }
    
    public static function supprimerRecette($dbh, $recette) {
        $sth = $dbh->prepare("DELETE FROM `recettes` WHERE `id`=?;");
        return $sth->execute(array($recette->id));
    }
      
}