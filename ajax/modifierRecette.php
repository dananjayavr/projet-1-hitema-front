<?php

require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

//echo 'idRecette: ' . $_POST['idRecette'];
if(!empty($_POST)) {
    $idRecette = filter_input(INPUT_POST,'idRecette',FILTER_SANITIZE_STRING);
    $result = $pdo->query("SELECT * FROM recettes WHERE idRecette=".$idRecette);

    if($result) {
        while($recette = $result->fetch(PDO::FETCH_ASSOC)) {
            $ingredientsStripped = strip_tags($recette['ingredient']);
            $prepaStripped = strip_tags($recette['preparation']);
            echo <<<_END
                <form method="post" action="">
                    <div id="alertBoxRecette"></div> 
                    <div class="form-group">
                        <label for="titreRecette">Titre</label>
                        <input type="text" class="form-control" value="{$recette['titre']}" id="titreRecette" name="titreRecette">
                    </div>
                    <div class="form-group">
                        <label for="chapeauRecette">Chapeau</label>
                        <textarea class="form-control" name="chapeauRecette" id="chapeauRecette" rows="2" maxlength="250">{$recette['chapo']}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="ingredientsRecette">Ingrédients (veuillez entrer un ingrédient par ligne)</label>
                        <textarea class="form-control" name="ingredientsRecette" id="ingredientsRecette" rows="4">{$ingredientsStripped}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="prepaRecette">Préparation (veuillez entrer une étape par ligne)</label>
                        <textarea class="form-control" name="prepaRecette" id="prepaRecette" rows="4">{$prepaStripped}</textarea>
                    </div>
                    <label for="couleurRecette">Couleur</label>
                    <div>
                        <select class="custom-select custom-select-md mb-3" id="couleurRecette" name="couleurRecette">
                            <option value="fushia">Fushia</option>
                            <option value="bleuClair">Bleu Clair</option>
                            <option value="vertClair">Vert Clair</option>
                        </select>
                   </div>
                   
                    <label for="categorieRecette">Categorie de Recette</label>
                    <div>
                        <select class="custom-select custom-select-md mb-3" name="categorieRecette" id="categorieRecette">
                            <option value="1">Viande</option>
                            <option value="2">Légume</option>
                            <option value="3">Poisson</option>
                            <option value="4">Fruit</option>
                        </select>
                    </div>
                    
                    <label for="tempsCuisson">Temps du Cuisson</label>
                    <input type="text" name="recetteTempsCuisson" id="recetteTempsCuisson" class="form-control" value="{$recette['tempsCuisson']}">
                    <label for="recetteTempsPrepa">Temps Préparation</label>
                    <input type="text" name="recetteTempsPrepa" id="recetteTempsPrepa" class="form-control" value="{$recette['tempsPreparation']}">
                    
                    <label for="recettedifficulte">Niveau de Difficulté</label>
                    <div>
                        <select class="custom-select custom-select-md mb-3" name="recetteDifficulte" id="recetteDifficulte">
                            <option value="Facile">Facile</option>
                            <option value="Modéré">Modéré</option>
                            <option value="Difficile">Difficile</option>
                        </select>
                    </div>
                    <label for="recettePrix">Prix</label>
                    <div>
                        <select class="custom-select custom-select-md mb-3" id="recettePrix" name="recettePrix">
                            <option value="Pas cher">Pas Cher</option>
                            <option value="Abordable">Abordable</option>
                            <option value="Cher">Cher</option>
                        </select>
                    </div>
                </form>
_END;
        }
    } else {
        var_dump($result);
    }
}
