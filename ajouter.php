<?php
require 'inc/init.php';
//require 'inc/helpers.php';
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

if (isset($_SESSION['login']) and isset($_GET['idm'])) {
    $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
    $chapo = filter_input(INPUT_POST, 'chapeau', FILTER_SANITIZE_STRING);
    $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_STRING);
    $prepa = filter_input(INPUT_POST, 'prepa', FILTER_SANITIZE_STRING);
    $categorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_STRING);
    $tempsCuisson = filter_input(INPUT_POST, 'tempsCuisson', FILTER_SANITIZE_STRING);
    $tempsPrepa = filter_input(INPUT_POST, 'tempsPrepa', FILTER_SANITIZE_STRING);
    $difficulte = filter_input(INPUT_POST, 'difficulte', FILTER_SANITIZE_STRING);
    $prix = filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_STRING);
    $couleur = filter_input(INPUT_POST, 'couleur', FILTER_SANITIZE_STRING);
    $membre = $_SESSION['idMembre'];
    $imageName = "";

    $uploadOK = false;

    if(!empty($_FILES['image']))
    {
        $path = "assets/photos/recettes/";
        $image = $_FILES['image']['name'];
        //$path = $path . basename( $_FILES['image']['name']);

        $imageName = md5(uniqid($image)).".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
        //$path = $path . basename($_FILES['image']['name']);
        $path = $path.$imageName;


        if ($_FILES['image']['size'] > 500000) { ?>
            <script>
                $(document).ready(() => {
                    $('#alertBox').append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                        "  Votre image est trop grand. Veuillez choisir une autre image.\n" +
                        "</div>");
                });
            </script>
        <?php } else {
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                //crop_image($_FILES['image']['tmp_name'],pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
                $uploadOK = true;
            } else {
                echo <<< _END
                
                <script>
                $(document).ready(() => {
                    $('#alertBox').append("<div class='alert alert-danger' role='alert'>Un erreur a été détécté. Veuillez vérifier votre image.</div>");
                });
                </script>
_END;
            }
        }
    }
}
$prepaSplit = preg_split('/\r\n|[\r\n]/', $prepa);
$finalStringPrepa = "<ol>";
for ($i = 0; $i<count($prepaSplit);$i++) {
    $finalStringPrepa .= '<li>'.$prepaSplit[$i].'</li>';
}
$finalStringPrepa .= '</ol>';

$ingredientsSplit = preg_split('/\r\n|[\r\n]/', $ingredients);
$finalStringIngredients = "<ul>";
for ($i = 0; $i<count($ingredientsSplit);$i++) {
    $finalStringIngredients .= '<li>'.$ingredientsSplit[$i].'</li>';
}
$finalStringIngredients .= '</ul>';


$query = "INSERT INTO recettes (titre,chapo,img,preparation,ingredient,membre,couleur,categorie,tempsCuisson,tempsPreparation,difficulte,prix) VALUES (\"$titre\",\"$chapo\",\"$imageName\",\"$finalStringPrepa\",\"$finalStringIngredients\",$membre,\"$couleur\",$categorie,\"$tempsCuisson\",\"$tempsPrepa\",\"$difficulte\",\"$prix\")";

if ($uploadOK) {
    $result = $pdo->query($query);
    if($result) {
        echo <<<_END
        <script>
                $(document).ready(() => {
                    $('#alertBox').append("<div class='alert alert-success' role='alert'>Votre recette a bien été enregistrée.</div>");
                });
         </script>
_END;

    } else {
        echo <<<_END
        <script>
                $(document).ready(() => {
                    $('#alertBox').append("<div class='alert alert-warning' role='alert'>Un erreur a été détécté lors de l'enregistrement. Veuillez réessayer plus tard.</div>");
                });
        </script>
_END;

    }
}
?>


<?php
if (isset($_SESSION['login']) and isset($_GET['idm'])) { ?>
    <div class="container">
        <div class="col-12 text-center pt-5">
            <div id="alertBox"></div>
            <h1 id="titreInscription">Ajouter Une Recette</h1>
            <hr>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="ajouter.php?idm=<?= $_GET['idm']?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-lg-6 col-xs-12">
                            <label for="titre">Titre de Recette</label>
                            <input type="text" class="form-control" placeholder="titre de votre recette" id="titre" name="titre" required>
                            <label for="chapeau">Chapeau</label>
                            <textarea class="form-control" placeholder="Un texte bref pour introduire votre recette" id="chapeau" name="chapeau" maxlength="250"></textarea>
                            <label for="ingredients">Ingrédients</label>
                            <textarea class="form-control" placeholder="la liste des ingrédients" id="ingredients" name="ingredients" rows="6"></textarea>
                            <label for="prepa">Préparation</label>
                            <textarea class="form-control" placeholder="les étapes de préparation" id="prepa" name="prepa" rows="6"></textarea>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-lg-4 col-xs-12">
                            <label for="image">Image de votre recette</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" accept="image/png, image/jpeg">
                                <label class="custom-file-label" for="image">Chosir une image</label>
                            </div>
                            <script>
                                $('#image').on('change',() => {
                                    let fileName = $('#image').val().replace('C:\\fakepath\\', " ");
                                    $('#image').next('.custom-file-label').html(fileName);
                                });
                            </script>
                            <label for="categorie">Categorie de Recette</label>
                            <div>
                                <select class="custom-select custom-select-md mb-3" name="categorie" id="categorie">
                                    <option value="1">Viande</option>
                                    <option value="2">Légume</option>
                                    <option value="3">Poisson</option>
                                    <option value="3">Fruit</option>
                                </select>
                            </div>

                            <label for="tempsCuisson">Temps du Cuisson</label>
                            <input type="text" name="tempsCuisson" id="tempsCuisson" class="form-control" placeholder="Ex. 1h 30 min">
                            <label for="tempsCuisson">Temps Préparation</label>
                            <input type="text" name="tempsPrepa" id="tempsPrepa" class="form-control" placeholder="Ex. 15 min">

                            <label for="difficulte">Niveau de Difficulté</label>
                            <div>
                                <select class="custom-select custom-select-md mb-3" name="difficulte" id="difficulte">
                                    <option value="Facile">Facile</option>
                                    <option value="Modéré">Modéré</option>
                                    <option value="Difficile">Difficile</option>
                                </select>
                            </div>
                            <label for="prix">Prix</label>
                            <div>
                                <select class="custom-select custom-select-md mb-3" id="prix" name="prix">
                                    <option value="Pas cher">Pas Cher</option>
                                    <option value="Abordable">Abordable</option>
                                    <option value="Cher">Cher</option>
                                </select>
                            </div>
                            <label for="couleur">Couleur</label>
                            <div>
                                <select class="custom-select custom-select-md mb-3" id="couleur" name="couleur">
                                    <option value="fushia">Fushia</option>
                                    <option value="bleuClair">Bleu Clair</option>
                                    <option value="vertClair">Vert Clair</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto">
                        <div class="col-12 text-center">
                            <br>
                            <input type="submit" value="Sousmettre" class="form-control btn btn-primary btn-lg w-75 addRecipe">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
