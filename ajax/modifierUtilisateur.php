<?php

require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if(!empty($_POST)) {
    $idUtilisateur = filter_input(INPUT_POST,'idUtilisateur',FILTER_SANITIZE_STRING);
    $result = $pdo->query("SELECT login, prenom, nom FROM membres WHERE idMembre=".$idUtilisateur);

    if($result) {
        while ($membre = $result->fetch(PDO::FETCH_ASSOC)) {
            echo <<<_END
                <form action="" method="POST">
                    <div class="form-group">
                        <div id="alertZone"></div>
                        <label for="login">Login</label>
                        <input type="text" class="form-control" value="{$membre['login']}" id="login" name="login" required="required">
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" value="{$membre['prenom']}" id="prenom" name="prenom" required="required">
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" value="{$membre['nom']}" id="nom" name="nom" required="required">
                    </div>
                    <div class="form-group">
                        <label for="mp1">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="mp1" name="mp1" placeholder="8 caracètres minimum" required="required" minlength="8">
                        <br>
                        <label for="mp2">Confirmer le nouveau mot de Passe</label>
                        <input type="password" class="form-control" id="mp2" name="mp2" placeholder="8 caractères minimum" required="required" minlength="8">
                    </div>
                </form>
_END;

        }
    } else {
        var_dump($result);
    }
}
