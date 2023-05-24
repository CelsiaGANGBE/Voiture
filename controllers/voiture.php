<?php

function creer_voiture($nom, $description, $id_categorie, $id_marque, $id_modele)
{
    try {
        $db = new Database();
        $v = new Voiture($db->getConnection());
        $v->nom = $nom;
        $v->description = $description;
        $v->id_categorie = $id_categorie;
        $v->id_marque = $id_marque;
        $v->id_modele = $id_modele;
        $v->creer();
        http_response_code(201);
        echo json_encode(['message'=>"Voiture ajoute avec succes"]); 
        return true;
    } catch (\Throwable $th) {
        http_response_code(503);
        echo json_encode(['message'=>"Voiture non ajoute"]);
        return false;    
    }
}

function afficher_voiture()
{
    try {
        $db = new Database();
        $v = new Voiture($db->getConnection());  
        $resultat = $v->lire();
        http_response_code(200);
        echo $resultat;
        return true;
        } catch (\Throwable $th) {
            return false;
    }
}

function retrouver_une_voiture($id)
{
    $db = new Database();
    $con = $db->getConnection();
    $v = new Voiture($con); 
    $sql = "SELECT * FROM voitures where id= :id";
    $query = $con->prepare($sql);
    $query->execute([
        'id'=> $id,
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    //$v->nom = $res['nom'];
    echo json_encode($res);
}
function modifier_voiture($id, $nom, $description, $id_categorie, $id_marque, $id_modele)
{
    try {
        $db = new Database();
        $v = new Categorie($db->getConnection());
        $v->id = $id;
        $v->nom = $nom;  
        $v->modifier();
        http_response_code(200);
        echo json_encode(['message'=>"Voiture modifiee"]);
        return true;
        } catch (\Throwable $th) {
            http_response_code(503);
            echo json_encode(['message'=>"Voiture non modifiee"]);
            return false;
    }
}
function supprimer_voiture($id)
{
    try {
        $db = new Database();
        $v = new Voiture($db->getConnection());
        $v->id = $id;  
        $resultat = $v->supprimer();
        if($resultat)
        {
            http_response_code(201);
            echo json_encode(['message'=>"Voiture supprime avec succes"]);
        }else{
            http_response_code(503);
            echo json_encode(['message'=>"Echec de la suppression"]);
        };
        return true;
        } catch (\Throwable $th) {
            return false;
    }
}
