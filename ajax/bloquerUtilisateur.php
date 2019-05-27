<?php
require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if(!empty($_POST)) {
    $idUtilisateur = filter_input(INPUT_POST,'idUtilisateur',FILTER_SANITIZE_STRING);
    $result = $pdo->query("UPDATE membres SET isBlocked=\"true\" WHERE idMembre=".$idUtilisateur);
    if($result) {
        //echo json_encode($result);
        echo "Query OK";
    } else {
        var_dump($result);
    }
}
