<?php

require '../inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

//echo 'idRecette: ' . $_POST['idRecette'];

if(!empty($_POST)) {
    $result = $pdo->query("SELECT * FROM recettes WHERE idRecette=".$_POST['idRecette']);

    if($result) {
        while($recette = $result->fetch(PDO::FETCH_ASSOC)) {
            echo <<<_END
                
                <form>
                    <div class="form-group">
                        <label for="titreRecette">Titre</label>
                        <input type="text" class="form-control" value="{$recette['titre']}" id="titreRecette" name="titreRecette">
                    </div>
                    <div class="form-group">
                        <label for="chapeauRecette">Chapeau</label>
                        <textarea class="form-control" name="chapeauRecette" id="chapeauRecette" rows="2" maxlength="250">{$recette['chapo']}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="imageRecette">Image</label>
                        <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/png, image/jpeg" cols="2">
                                <label class="custom-file-label" for="image">Chosir une nouvelle image</label>
                                <script>
                                $('#image').on('change',() => {
                                    let fileName = $('#image').val().replace('C:\\fakepath\\', " ");
                                    $('#image').next('.custom-file-label').html(fileName);
                                });
                                </script>
                        </div>
                        <div class="form-group">
                            <label for="ingredientsRecette">Ingrédients (veuillez entrer le texte entre les balises)</label>
                            <textarea class="form-control" name="ingredientsRecette" id="ingredientsRecette" rows="4">{$recette['ingredient']}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="prepaRecette">Préparation (veuillez entrer le texte entre les balises)</label>
                            <textarea class="form-control" name="prepaRecette" id="prepaRecette" rows="4">{$recette['preparation']}</textarea>
                        </div>
                        <label for="couleurRecette">Couleur</label>
                            <div>
                                <select class="custom-select custom-select-md mb-3" id="couleurRecette" name="couleurRecette">
                                    <option value="fushia">Fushia</option>
                                    <option value="bleuClair">Bleu Clair</option>
                                    <option value="vertClair">Vert Clair</option>
                                </select>
                           </div>
                    </div>
                    <label for="categorieRecette">Categorie de Recette</label>
                    <div>
                        <select class="custom-select custom-select-md mb-3" name="categorieRecette" id="categorieRecette">
                            <option value="1">Viande</option>
                            <option value="2">Légume</option>
                            <option value="3">Poisson</option>
                            <option value="3">Fruit</option>
                        </select>
                    </div>
                    
                    <label for="tempsCuisson">Temps du Cuisson</label>
                    <input type="text" name="recetteTempsCuisson" id="recetteTempsCuisson" class="form-control" value="{$recette['tempsCuisson']}">
                    <label for="tempsCuisson">Temps Préparation</label>
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

            /*echo $recette['titre'];
            echo $recette['chapo'];
            echo $recette['img'];
            echo $recette['preparation'];
            echo $recette['ingredient'];*/
        }
    } else {
        var_dump($result);
    }
}