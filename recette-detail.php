<?php
require_once 'inc/init.php';

$id_recette = filter_input(INPUT_GET,'idr',FILTER_SANITIZE_ENCODED);

/* Détails recette */
$query = "SELECT r.idRecette, r.img, r.chapo, r.titre, r.difficulte, r.preparation,r.tempsPreparation, r.tempsCuisson, r.ingredient, r.tempsPreparation, r.prix, r.dateCrea, r.couleur, m.prenom,m.idMembre,c.nom FROM recettes r, membres m, categories c WHERE r.idRecette='$id_recette' AND m.idMembre=r.membre AND r.categorie=c.idCategorie;";
$result = $pdo->query($query);
$recette = $result->fetch(PDO::FETCH_OBJ);
if (!$recette) {
    header("HTTP/1.1 301 Moved Permanently");
    header( 'Location: 404.php' ) ;
    exit;
}
//$pdo->query("UPDATE recettes SET vues = vues+1 WHERE idRecette=$id_recette");
?>
<div class="container">
    <div class="row mx-auto pt-5">
        <div class="col-sm-12 titre-recette p-5 text-center" style="color: <?php echo $couleurs[$recette->couleur];?>">
            <h1><?php echo $recette->titre;?></h1>
            <h6>Par <a href="membre-detail.php?idm=<?php echo $recette->idMembre; ?>"><?php echo ucfirst($recette->prenom); ?></a> | <i class="fas fa-utensils"></i> <?php echo $recette->difficulte; ?> | <i class="fas fa-euro-sign"></i> <?php echo $recette->prix ?> | <?php echo substr($recette->dateCrea,0,10);?></h6>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center mx-auto">
        <div class="col-sm-6 pb-5">
            <img src="./assets/photos/recettes/<?php echo $recette->img;?>" class="rounded img-fluid" alt="<?php echo substr($recette->img,0, strpos($recette->img,'.'));?>" id="imageRecette">
        </div>
        <?php if (isset($_SESSION['login']) and $_SESSION['idMembre'] == $recette->idMembre) { ?>
            <br>
            <div id="alertBox"></div>
            <br>
            <form action="recette-detail.php?idr=<?=$id_recette;?>" method="post" enctype="multipart/form-data">
                <div class="custom-file row mx-auto">
                    <div class="col-xs-12 col-lg-6">
                        <small class="custom-file-label for="image">Changer Image</small>
                        <input type="file" class="custom-file-input form-control input-sm" id="image" name="image" accept="image/png, image/jpeg" onchange="this.form.submit()">
                    </div>
                </div>
            </form>
            <script>
                $('#image').on('change',() => {
                    let fileName = $('#image').val().replace('C:\\fakepath\\', " ");
                    $('#image').next('.custom-file-label').html(fileName);
                });
            </script>
        <?php }?>
        <?php
        if(!empty($_FILES['image'])) {
            $image = $_FILES['image']['name'];
            $imageName = md5(uniqid($image)).".".pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
            $path = "assets/photos/recettes/";
            //$path = $path . basename($_FILES['image']['name']);
            $path = $path.$imageName;
            if ($_FILES['image']['size'] > 200000) { ?>
                <script>
                    $(document).ready(() => {
                        $('#alertBox').append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                            "  Votre image est trop grand. Veuillez choisir une autre image.\n" +
                            "</div>");
                    });
                </script>
            <?php } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                    //crop_image($_FILES['image']['tmp_name'],pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
                    $uploadOK = true;
                    $query_p = "UPDATE recettes SET img=\"$imageName\" WHERE idRecette=$id_recette";
                    $pdo->query($query_p);
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
        } ?>
    </div>
    <div class="row mx-auto">
        <div class="col-sm-6 col-md-12 p-2">
            <p id="description">
                <?php echo $recette->chapo; ?>
            </p>
            <h6 id="recette-meta">Cuisson: <?php echo $recette->tempsCuisson;?> | Préparation: <?php echo $recette->tempsPreparation; ?> | Catégorie: <?php echo $recette->nom?></h6>
        </div>
    </div>
    <div class="row mx-auto">
        <div class="col-sm-6 p-2" id="ingredients">
            <h5>Ingrédients</h5>
            <ul>
                <?php echo $recette->ingredient;?>
            </ul>
        </div>
    </div>
    <div class="row mx-auto">
        <div class="col-sm-6 col-md-12 p-2">
            <h5>Préparation</h5>
            <div id="preparation">
                <?php echo $recette->preparation; ?>
            </div>
        </div>
    </div>
    <p>
        <a href="membre-detail.php?idm=<?=$recette->idMembre;?>">Retour</a>
    </p>
</div>
<?php include "./inc/footer.php";?>
