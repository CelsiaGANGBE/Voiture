<?php
//Toutes les méthodes et proopriétés nécessaireà la gestion de la table Marque
class Categorie
{
     // propriétes relatives à la classe
     private $table = "categories";
     private $connexion = null;
     //propriétés de l'objet marque 
     public $id;
     public $nom;
       /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db)
    {
        if($this->connexion == null){
            $this->connexion = $db;
        }
        
    }

     public function lire()
    {
        //Ecriture de la requete
        $sql = "SELECT id, nom from $this->table";
        //Preparation de la requete
        $req = $this->connexion->prepare($sql);
        //Execution de la requete
        $req->execute();
        //resultat
        $res = $req->fetchAll();
        return $res;
    }

    public function creer()
    {
        $sql = "INSERT INTO " .$this->table ."(nom) VALUES( :nom)";
        $req = $this->connexion->prepare($sql);
        $req->execute(['nom'=>$this->nom]);
        if($req->execute())
        {
            return true;
        }
        return false;
    }

        /**
     * Mettre à jour un véhicule
     * 
     * @return void
     */
    public function modifier()
    {
        //Ecriture de la requete
        $sql = "UPDATE " .$this->table ." SET nom = :nom  WHERE id = :id";
        //Preparation de la requete
        $query = $this->connexion->prepare($sql);
        //Execution de la requete
        $query->execute([
            'id'=> $this->id,
            'nom'=> $this->nom
        ]);
        if($query->execute())
        {
            return true;
        }
        return false;
    }

     /**
     * Supprimer une voiture
     * 
     * @return void
     */
    public function supprimer()
    {
        //Ecriture de la requete
        $sql = "DELETE FROM " .$this->table. " WHERE id =:id";
        //Preparation de la requete
        $req = $this->connexion->prepare($sql);
        if($req->execute(['id'=>$this->id]))
        {
            return true;
        }
        //Execution de la requete
    }

    

}


?>