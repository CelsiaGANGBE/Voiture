<?php

function creer_categorie($nom)
{
    try {
        $db = new Database();
        $c = new Categorie($db->getConnection());
        $c->nom = $nom;
        $c->creer();
        http_response_code(201);
        echo json_encode(['message'=>"Categorie ajouté avec succes"]); 
        return true;
    } catch (\Throwable $th) {
        http_response_code(503);
        echo json_encode(['message'=>"Categorie non ajoute"]);
        return false;    
    }
}

function afficher_categorie()
{
    try {
        $db = new Database();
        $c = new Categorie($db->getConnection());  
        $resultat = $c->lire();
        http_response_code(200);
        echo $resultat;   
              return true;
        } catch (\Throwable $th) {
            return false;
    }
}

function retrouver_une_categorie($id)
{
    $db = new Database();
    $con = $db->getConnection();
    $c = new Categorie($con); 
    $sql = "SELECT * FROM categories where id= :id";
    $query = $con->prepare($sql);
    $query->execute([
        'id'=> $id,
    ]);
    $res = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($res);
}

function modifier_categorie($id, $nom)
{
    try {
        $db = new Database();
        $c = new Categorie($db->getConnection());
        $c->id = $id;
        $c->nom = $nom;  
        $c->modifier();
        http_response_code(200);
        echo json_encode(['message'=>"Categorie modifiee"]);
        return true;
        } catch (\Throwable $th) {
            http_response_code(503);
            echo json_encode(['message'=>"Categorie non modifiee"]);
            return false;
    }
}
function supprimer_categorie($id)
{
    try {
        $db = new Database();
        $v = new Categorie($db->getConnection());
        $v->id = $id;  
        $resultat = $v->supprimer();
        if($resultat)
        {
            http_response_code(201);
            echo json_encode(['message'=>"Categorie supprimé avec succès"]);
        }else{
            http_response_code(503);
            echo json_encode(['message'=>"Echec de la suppression"]);
        };
        return true;
        } catch (\Throwable $th) {
            return false;
    }
}
