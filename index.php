<?php
    require ('./config/Database.php');
    require('./models/categorie.php');
    require('./models/voiture.php');
    require ('./controllers/voiture.php');
    require ('./controllers/categorie.php');


    $data = new Database();
    $con = $data->getConnection();
    $voiture = new Voiture($con);


    require_once('./models/voiture.php');

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        if(isset($_GET['voitures'])){
            afficher_voiture();
        }else if(isset($_GET['une_voiture']) && isset($_GET['id'])){
            retrouver_une_voiture($_GET['id']);
        }
        else if(isset($_GET['supprimer_voiture']) && isset($_GET['id'])){
            supprimer_voiture($_GET['id']);
        }
        else if(isset($_GET['categories'])){
            afficher_categorie();
        }else if(isset($_GET['une_voiture']) && isset($_GET['id'])){
            retrouver_une_categorie($_GET['id']);
        }else if(isset($_GET['supprimer_categorie']) && isset($_GET['id'])){
            supprimer_categorie($_GET['id']);
        }else{
            echo "Bienvenu";
        }
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_GET['creer_voiture'])){
            if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['id_categorie']) && isset($_POST['id_modele'])  && isset($_POST['id_marque']) ){
                creer_voiture($_POST['nom'], $_POST['description'], $_POST['id_categorie'], $_POST['id_modele'], $_POST['id_marque']);
            }
        }
        else if(isset($_GET['modifier_categorie']) && isset($_GET['id'])){
            if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['id_categorie']) && isset($_POST['id_modele'])  && isset($_POST['id_marque']) ){
                modifier_categorie($_GET['id'], $_POST['nom'], $_POST['description'], $_POST['id_categorie'], $_POST['id_modele'], $_POST['id_marque']);
            }
        }else if(isset($_GET['creer_categorie'])){
            if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['id_categorie']) && isset($_POST['id_modele'])  && isset($_POST['id_marque']) ){
                creer_categorie($_GET['id'], $_POST['nom'], $_POST['description'], $_POST['id_categorie'], $_POST['id_modele'], $_POST['id_marque']);
            }
        }else if(isset($_GET['modifier_voiture']) && isset($_GET['id'])){
            if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['id_categorie']) && isset($_POST['id_modele'])  && isset($_POST['id_marque']) ){
                modifier_voiture($_GET['id'], $_POST['nom'], $_POST['description'], $_POST['id_categorie'], $_POST['id_modele'], $_POST['id_marque']);
            }
        }
}
