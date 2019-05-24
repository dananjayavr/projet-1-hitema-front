<?php
session_start();
require '../inc/login.php';

if(!empty($_POST)) {
    $pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $idRecette = filter_input(INPUT_POST,'idRecette',FILTER_SANITIZE_STRING);
    $titreModifie = filter_input(INPUT_POST, 'titreRecette', FILTER_SANITIZE_STRING);
    $chapoModifie = filter_input(INPUT_POST, 'chapeauRecette', FILTER_SANITIZE_STRING);
    $ingredientsModifie = filter_input(INPUT_POST, 'ingredientsRecette', FILTER_SANITIZE_STRING);
    $prepaModifie = filter_input(INPUT_POST, 'prepaRecette', FILTER_SANITIZE_STRING);
    $categorieModifie = filter_input(INPUT_POST, 'categorieRecette', FILTER_SANITIZE_STRING);
    $tempsCuissonModifie = filter_input(INPUT_POST, 'tempsCuissonRecette', FILTER_SANITIZE_STRING);
    $tempsPrepaModifie = filter_input(INPUT_POST, 'tempsPrepaRecette', FILTER_SANITIZE_STRING);
    $difficulteModifie = filter_input(INPUT_POST, 'difficulteRecette', FILTER_SANITIZE_STRING);
    $prixModifie = filter_input(INPUT_POST, 'prixRecette', FILTER_SANITIZE_STRING);
    $couleurModifie = filter_input(INPUT_POST, 'couleurRecette', FILTER_SANITIZE_STRING);
    $membre = $_SESSION['idMembre'];

    $query = "SELECT * FROM recettes WHERE idRecette=".$idRecette;
    $result = $pdo->query($query);
    $recette = $result->fetch(PDO::FETCH_OBJ);

    if($titreModifie!==$recette->titre) {
        echo $titreModifie . " will be commited to the DB.";
        $query = "UPDATE recettes SET titre=\"$titreModifie\" WHERE idRecette=$idRecette";
        $result = $pdo->query($query);
        if($result) {
            echo "Update OK.";
        } else {
            echo "Update failed.";
        }
    } else {
        echo "No change detected.";
    }
}


