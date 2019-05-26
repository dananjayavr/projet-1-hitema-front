<?php
session_start();
require '../inc/login.php';

if(!empty($_POST)) {
    $pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

    $idRecette = filter_input(INPUT_POST,'idRecette',FILTER_SANITIZE_STRING);
    $titreModifie = filter_input(INPUT_POST, 'titreRecette', FILTER_SANITIZE_STRING);
    $chapoModifie = filter_input(INPUT_POST, 'chapeauRecette', FILTER_SANITIZE_STRING);
    $ingredientsModifie = filter_input(INPUT_POST, 'ingredientsRecette', FILTER_SANITIZE_STRING);
    $prepaModifie = filter_input(INPUT_POST, 'prepaRecette', FILTER_SANITIZE_STRING);
    $categorieModifie = filter_input(INPUT_POST, 'categorieRecette', FILTER_SANITIZE_STRING);
    $tempsCuissonModifie = filter_input(INPUT_POST, 'tempsCuissonRecette', FILTER_SANITIZE_STRING);
    $difficulteModifie = filter_input(INPUT_POST, 'difficulteRecette', FILTER_SANITIZE_STRING);
    $prixModifie = filter_input(INPUT_POST, 'prixRecette', FILTER_SANITIZE_STRING);
    $couleurModifie = filter_input(INPUT_POST, 'couleurRecette', FILTER_SANITIZE_STRING);
    $membre = $_SESSION['idMembre'];

    $query = "SELECT * FROM recettes WHERE idRecette=".$idRecette;
    $result = $pdo->query($query);
    $recette = $result->fetch(PDO::FETCH_OBJ);

    $x = filter_input(INPUT_POST,'tempsPrepaRecette',FILTER_SANITIZE_STRING);
    //echo $x;

    $ingredientsSplit = preg_split('/\r\n|[\r\n]/', $ingredientsModifie);
    $finalStringIngredients = "<ul>";
    for ($i = 0; $i<count($ingredientsSplit);$i++) {
        $finalStringIngredients .= '<li>'.$ingredientsSplit[$i].'</li>';
    }
    $finalStringIngredients .= '</ul>';

    $prepaSplit = preg_split('/\r\n|[\r\n]/', $prepaModifie);
    $finalStringPrepa = "<ol>";
    for ($i = 0; $i<count($prepaSplit);$i++) {
        $finalStringPrepa .= '<li>'.$prepaSplit[$i].'</li>';
    }
    $finalStringPrepa .= '</ol>';

    if($titreModifie!==$recette->titre and !empty($titreModifie)) {
        $pdo->query("UPDATE recettes SET titre=\"$titreModifie\" WHERE idRecette=$idRecette");
    } else if($chapoModifie!==$recette->chapo and !empty($chapoModifie)) {
        $pdo->query("UPDATE recettes SET chapo=\"$chapoModifie\" WHERE idRecette=$idRecette");
    } else if($finalStringIngredients!==$recette->ingredient and $finalStringIngredients!=="<ul></ul>") {
        $pdo->query("UPDATE recettes SET ingredient=\"$finalStringIngredients\" WHERE idRecette=$idRecette");
    } else if($difficulteModifie!==$recette->difficulte) {
        $pdo->query("UPDATE recettes SET difficulte=\"$difficulteModifie\" WHERE idRecette=$idRecette");
    } else if($tempsCuissonModifie!==$recette->tempsCuisson and !empty($tempsCuissonModifie)) {
        $pdo->query("UPDATE recettes SET tempsCuisson=\"$tempsCuissonModifie\" WHERE idRecette=$idRecette");
    } else if($prixModifie!==$recette->prix) {
        $pdo->query("UPDATE recettes SET prix=\"$prixModifie\" WHERE idRecette=$idRecette");
    } else if($couleurModifie!==$recette->couleur) {
        $pdo->query("UPDATE recettes SET couleur=\"$couleurModifie\" WHERE idRecette=$idRecette");
    } else if($recette->tempsPreparation!==$x and !empty($x)) {
        $pdo->query("UPDATE recettes SET tempsPreparation=\"$x\" WHERE idRecette=$idRecette");
    } else if($categorieModifie!==$recette->categorie) {
        $pdo->query("UPDATE recettes SET categorie=\"$categorieModifie\" WHERE idRecette=$idRecette");
    } else if($finalStringPrepa!==$recette->preparation and $finalStringPrepa!=="<ol></ol>") {
        $pdo->query("UPDATE recettes SET preparation=\"$finalStringPrepa\" WHERE idRecette=$idRecette");
    } else {
        echo <<<END
        <div class="alert alert-danger" role="alert">
            Un erreur a été detecté. Veuillez vérifier les informations saisies.
        </div>
END;
    }

    echo <<<END
    <div class="alert alert-success" role="alert">
            La recette a été mise à jour.
    </div>
END;

}


