<?php
session_start();
require '../inc/login.php';

$pdo = new PDO('mysql:host=' . $hn . ';charset=utf8;dbname=' . $db, $un, $pw,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (!empty($_POST)) {
    $idUtilisateur = filter_input(INPUT_POST, 'idUtilisateur', FILTER_SANITIZE_STRING);
    $result = $pdo->query("DELETE FROM membres WHERE idMembre=" . $idUtilisateur);
    if ($result) {
        //echo json_encode($result);
        exit();
    } else {
        var_dump($result);
    }
}
