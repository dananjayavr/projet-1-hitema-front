<?php

session_start();
require '../inc/login.php';

if(!empty($_POST)) {
    $pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $idMembre = filter_input(INPUT_POST,'idUtilisateur',FILTER_SANITIZE_STRING);
    $nouveauLogin = filter_input(INPUT_POST,'nouveauLogin',FILTER_SANITIZE_STRING);
    $nouveauNom = filter_input(INPUT_POST,'nouveauNom',FILTER_SANITIZE_STRING);
    $nouveauPrenom = filter_input(INPUT_POST,'nouveauPrenom',FILTER_SANITIZE_STRING);
    $statutMembre = filter_input(INPUT_POST,'statutMembre',FILTER_SANITIZE_STRING);

    $statut = $pdo->query("SELECT statut from membres WHERE idMembre=$idMembre")->fetch(PDO::FETCH_ASSOC)['statut'];

    if((empty($nouveauLogin)) and (strlen($nouveauLogin)>6 or strlen($nouveauLogin)<2)) {
        echo <<<END
        <div class="alert alert-danger" role="alert">
            Un erreur a été detecté. Veuillez vérifier les informations saisies.
        </div>
END;
    } else if (empty($nouveauNom)) {
        echo <<<END
        <div class="alert alert-danger" role="alert">
            Un erreur a été detecté. Veuillez vérifier les informations saisies.
        </div>
END;
    } else if (empty($nouveauPrenom)) {
        echo <<<END
        <div class="alert alert-danger" role="alert">
            Un erreur a été detecté. Veuillez vérifier les informations saisies.
        </div>
END;
    } else {
        $pdo->query("UPDATE membres SET login=\"$nouveauLogin\" WHERE idMembre=$idMembre");
        $pdo->query("UPDATE membres SET nom=\"$nouveauNom\" WHERE idMembre=$idMembre");
        $pdo->query("UPDATE membres SET prenom=\"$nouveauPrenom\" WHERE idMembre=$idMembre");
        if ($statutMembre != $statut) {
            $pdo->query("UPDATE membres SET statut=\"$statutMembre\" WHERE idMembre=$idMembre");
        }
        echo <<<END
        <div class="alert alert-success text-center" role="alert">
            Le profil est mise à jour.
        </div>
END;
    }
}