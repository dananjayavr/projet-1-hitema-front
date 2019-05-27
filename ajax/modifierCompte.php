<?php

require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if(!empty($_POST)) {
    $idUtilisateur = filter_input(INPUT_POST,'idUtilisateur',FILTER_SANITIZE_STRING);
    $result = $pdo->query("SELECT login, prenom, nom, statut FROM membres WHERE idMembre=".$idUtilisateur);

    if($result) {
        while ($membre = $result->fetch(PDO::FETCH_ASSOC)) {
            $userStatus = $membre['statut'];
            if ($userStatus=="membre") {
                $select = "<option value='membre' selected>Membre</option><option value='admin'>Admin</option>";
            } else {
                $select = "<option value='admin' selected>Admin</option><option value='membre'>Membre</option>";
            }
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
                        <select class="custom-select" name="statutMembre" id="statutMembre">
                          {$select}
                        </select>
                    </div>
                </form>
_END;

        }
    } else {
        var_dump($result);
    }
}
