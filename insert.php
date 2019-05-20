<?php
require_once 'inc/init.php';

$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mp = password_hash(filter_input(INPUT_POST, 'mp', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);
//$dateCreation = date("Y-m-d g:i:s");
$gravatar = 'default.png';
$statut = 'membre';

$query = "INSERT INTO membres (gravatar, login, password, statut, prenom, nom) VALUES ('$gravatar','$pseudo','$mp','$statut','$prenom','$nom')";
$result = $pdo->query($query);

if ($result) {
    header('Location: connecter.php?submitted=success');
    exit();
} else {
    var_dump($result);
}
