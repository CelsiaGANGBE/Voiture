<?php
//Toutes les méthodes et proopriétés nécessaireà la gestion de la table Marque
class Modele
{
     // propriétes relatives à la classe
     private $table = "modeles";
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
}


?>