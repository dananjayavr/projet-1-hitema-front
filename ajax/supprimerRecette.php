<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php
require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if(!empty($_POST)) {
    $result = $pdo->query("DELETE FROM recettes WHERE idRecette=".$_POST['idRecette']);
    if($result) {
        echo json_encode($result);
        header('Location: membre-detail.php?idm='.$_SESSION['idMembre']);
        exit();
    } else {
        var_dump($result);
    }
}
