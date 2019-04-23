<?php

include './inc/header.php';
include './inc/login.php';

$pdo = new PDO('mysql:host=localhost;dbname=cooking',$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

// Colour chart
$couleurs = array(
    "fushia" => "#ca2c92",
    "bleuClair" => "#30bdf0",
    "vertClair" => "#8bc13f",
);
