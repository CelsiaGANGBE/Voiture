<?php

class Voiture{
    // Connexion
    private $connexion;
    private $table = "voitures"; // Table dans la base de données

    // Propriétés
    public $id;
    public $nom;
    public $description;
    public $id_categorie;
    public $id_modele;
    public $id_marque;
    public $date;

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


    /**
     * Créer une voiture 
     * 
     * @return void
     */
    public function creer()
    {
        //Ecriture de la requete sql
        $sql = "INSERT INTO " .$this->table ."(nom, description, id_categorie, id_modele, id_marque) VALUES( :nom, :description, :id_categorie, :id_modele, :id_marque)";
        //preparation de la requete
        $query = $this->connexion->prepare($sql);
        //Exécution de la requete
        $query->execute([
            ':nom'=> $this->nom,
            ':description'=> $this->description,
            ':id_categorie'=> $this->id_categorie,
            ':id_modele'=> $this->id_modele,
            ':id_marque'=> $this->id_marque,
        ]);
        if($query->execute())
        {
            return true;
        }
        return false;
    }

    /**
     * Lecture des voitures
     * 
     * @return void
     */
    public function lire()
    {
        //Ecriture de la requete
        $sql = "SELECT v.id, v.nom, v.description, id_categorie, id_modele, id_marque, c.nom from $this->table v LEFT JOIN categories c ON id_categorie = c.id ";
        //Preparation de la requete
        $req = $this->connexion->prepare($sql);
        //Execution de la requete
        $req->execute();
        //resultat
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res);
    }


    /**
     * Mettre à jour un véhicule
     * 
     * @return void
     */
    public function modifier()
    {
        //Ecriture de la requete
        $sql = "UPDATE " .$this->table ." SET nom = :nom, description = :description, id_categorie = :id_categorie, id_modele = :id_modele, id_marque = :id_marque  WHERE id = :id";
        //Preparation de la requete
        $query = $this->connexion->prepare($sql);
        //Execution de la requete
        $query->execute([
            'id'=> $this->id,
            'nom'=> $this->nom,
            'description'=> $this->description,
            'id_categorie'=> $this->id_categorie,
            'id_modele'=> $this->id_modele,
            'id_marque'=> $this->id_marque,
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
// $db = new Database();
// $v = new Voiture($db->getConnection());
// $v->id = 4;
// $v->nom = "ggg";
// $v->description = "cydfjjhguv";
// $v->id_categorie = 1;
// $v->id_modele = 1;
// $v->id_marque = 1;
// $v->modifier();

?>
