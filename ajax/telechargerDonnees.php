<?php
session_start();
require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if(!empty($_POST)) {
    $idDuMembreQuiVeutCesDonnes = filter_input(INPUT_POST,'idUtilisateur',FILTER_SANITIZE_STRING);
    $query = "SELECT m.gravatar,m.login,m.statut,m.prenom,m.nom,m.dateCrea AS date_creation_profil,r.titre,r.chapo,r.img,r.preparation,r.ingredient,r.couleur,r.dateCrea AS date_creation_recette,r.categorie,r.tempsPreparation,r.difficulte,r.prix FROM membres AS m, recettes AS r WHERE m.idMembre=r.membre AND m.idMembre=$idDuMembreQuiVeutCesDonnes;";

    $result = $pdo->query($query);
    $membre = $result->fetchAll(PDO::FETCH_OBJ);

    $list = array(array('gravatar', 'login', 'statut', 'prenom', 'nom', 'dateCreaProfile', 'dateCrea','titreRecette','ChapôRecette','imgRecette','preparation','ingredient','couleur','dateCreaRecette','categorie','tempsPreparation','difficulte','prix'));

    foreach ($membre as $donnee) {
        array_push($list,array($donnee->gravatar, $donnee->login, $donnee->statut, $donnee->prenom, $donnee->nom, $donnee->date_creation_profil, $donnee->date_creation_profil,$donnee->titre,$donnee->chapo,$donnee->img,$donnee->preparation,$donnee->ingredient,$donnee->couleur,$donnee->date_creation_recette,$donnee->categorie,$donnee->tempsPreparation,$donnee->difficulte,$donnee->prix));
    }

    $f = fopen("donnees_".$_SESSION['nom'].".csv","w");
    foreach ($list as $fields) {
        fputcsv($f, $fields, ";");
    }
    $f = fclose($f);

    /*foreach ($list as $line) {
        var_dump($line);
    }*/

    echo ("ajax/donnees_".$_SESSION['nom'].".csv");
    //print_r($list);
}
