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
    $nouveauMP1 = filter_input(INPUT_POST,'nouveauMP1',FILTER_SANITIZE_STRING);
    $nouveauMP2 = filter_input(INPUT_POST,'nouveauMP2',FILTER_SANITIZE_STRING);

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
    } else if((empty($nouveauMP1) and empty($nouveauMP2)) OR ($nouveauMP1!==$nouveauMP2) OR (strlen($nouveauMP1)<8 and strlen($nouveauMP2)<8)) {
        echo <<<END
        <div class="alert alert-danger text-center" role="alert">
            Un erreur a été detecté. Veuillez vérifier les informations saisies.
        </div>
END;
    } else {
        $nouveauMP = password_hash($nouveauMP1,PASSWORD_BCRYPT);
        $pdo->query("UPDATE membres SET login=\"$nouveauLogin\" WHERE idMembre=$idMembre");
        $pdo->query("UPDATE membres SET nom=\"$nouveauNom\" WHERE idMembre=$idMembre");
        $pdo->query("UPDATE membres SET prenom=\"$nouveauPrenom\" WHERE idMembre=$idMembre");
        $pdo->query("UPDATE membres SET password=\"$nouveauMP\" WHERE idMembre=$idMembre");

        echo <<<END
        <div class="alert alert-success text-center" role="alert">
            Votre profil est mise à jour.
        </div>
END;
    }

}