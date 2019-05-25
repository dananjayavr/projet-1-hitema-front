<?php
require_once 'inc/init.php';

$id_utilisateur = filter_input(INPUT_GET,'idm',FILTER_SANITIZE_ENCODED);
/* Détails membres */
$query_m = "SELECT gravatar, prenom, nom, dateCrea FROM membres WHERE idMembre='$id_utilisateur';";
$result_m = $pdo->query($query_m);
$membre = $result_m->fetch(PDO::FETCH_OBJ);
if(!$membre) {
    header("HTTP/1.1 404 Not Found");
    header( 'Location: 404.php' ) ;
    exit;
}
/*$membre = $result->fetch(PDO::FETCH_OBJ);*/
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
    <!--<div class="row">
        <div class="col-sm-12" id="banner">
        </div>
    </div>-->
    <div class="row mx-auto bio-bg mt-5">
        <div class="col-xs-4 p-5">
            <img src="./assets/photos/gravatars/<?php echo $membre->gravatar; ?>" alt="photo<?php echo $membre->prenom?>" id="bio-pic">
            <?php if (isset($_SESSION['login']) and $_SESSION['idMembre'] == $id_utilisateur) { ?>
                <br>
                <div id="alertBox"></div>
                <br>
                <form action="membre-detail.php?idm=<?=$id_utilisateur?>" method="post" enctype="multipart/form-data">
                    <div class="custom-file row">
                        <div class="col-xs-12 col-lg-6">
                            <small class="custom-file-label for="image">Changer Avatar</small>
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
                $path = "assets/photos/gravatars/";
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
                        $query_p = "UPDATE membres SET gravatar=\"$imageName\" WHERE idMembre=$id_utilisateur";
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
    </div>
    <!--<div class="row justify-content-center">
        <div class="col-xs-4">
            <h4 class="p-5"><?php echo ucfirst($membre->prenom) . " " . $membre->nom; ?></h4>
        </div>
    </div>-->
    <div class="row justify-content-center">
        <div class="col-xs-4 pt-2 bio-summary">
            <h4 class="text-center"><?php echo ucfirst($membre->prenom) . " " . $membre->nom; ?></h4>
            <h5>Membre depuis: <?php echo substr($membre->dateCrea,0,10); ?></h5>
        </div>
    </div>
    <?php
    if(isset($_SESSION['login']) and $_SESSION['idMembre'] == $id_utilisateur) { ?>
        <div class="row justify-content-center">
            <div class="col-xs-4">
                <a href="ajouter.php?idm=<?=$id_utilisateur;?>" class="btn btn-primary btn-lg justify-content-center addRecipe" role="button">Ajouter une recette</a>
            </div>
        </div>
    <?php } ?>
    <hr>
    <?php
    $query_r = "SELECT idRecette, img, chapo, titre, difficulte, tempsPreparation, tempsCuisson, prix, couleur FROM recettes WHERE membre='$id_utilisateur';";
    $result = $pdo->query($query_r);
    //$recettes = $result->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="row mx-auto" id="vedettes">
        <div class="row mx-auto">
            <?php while ($recette = $result->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="col-sm-4 col-xs-4 col-md-6 mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="./assets/photos/recettes/<?php echo $recette->img;?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $recette->titre; ?></h5>
                            <p class="card-text">
                                <?php echo $recette->chapo; ?>
                                <br>
                                <strong><i class="fas fa-utensils pt-2"></i> <?php echo $recette->difficulte?> | <i class="far fa-clock"></i> <?php echo $recette->tempsCuisson?> | <i class="fas fa-euro-sign"></i> <?php echo $recette->prix?></strong>
                            </p>
                            <a href="recette-detail.php?idr=<?php echo $recette->idRecette;?>" class="btn btn-primary btn-lg mb-2" role="button" style="background: <?php echo $couleurs[$recette->couleur];?>; border-color: white;">Je cuisine!</a>
                            <?php
                            if (isset($_SESSION['login']) and $_SESSION['idMembre'] == $id_utilisateur) { ?>
                            <br>
                            <a class="btn btn-outline-secondary btn-sm" href="" id="modify" data-toggle="modal" data-target="#modifierRecette" data-id="<?=$recette->idRecette;?>" onclick="modifierRecette(<?= $recette->idRecette; ?>)">Modifier</a> <span>|</span> <a class="btn btn-outline-danger btn-sm" href="" value="submit" id="deleteRecipe" data-toggle="modal" data-target="#supprimerRecette" data-id="<?=$recette->idRecette;?>">Supprimer</a>
                            <?php } ?>
                            <!-- MODAL MODIFIER RECETTE -->
                            <div class="modal fade" id="modifierRecette" tabindex="-1" role="dialog" aria-hidden="true">
                                <input id="recette_id" name="rid" type="hidden" value="" />
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifier Recette</h5>
                                            <div id="alertBox"></div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="recipeContents"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-primary addRecipe" data-dismiss="modal" id="save">Sauvegarder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL SUPPRIMER CONFIRMATION -->
                            <div class="modal fade" id="supprimerRecette" aria-hidden="true" tabindex="-1" role="dialog">
                                <input id="recette_id" name="rid" type="hidden" value="" />
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Supprimer Recette</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Vous êtes sûr de vouloir supprimer cette recette?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-danger" id="delete">Supprimer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (isset($_SESSION['login']) and $_SESSION['idMembre'] == $id_utilisateur) { ?>
        <hr>
        <div class="pb-2 text-center">
            <small>
                <a href="#" id="supprimerUtilisateur" data-toggle="modal" data-target="#supprimerCompte">Supprimer Mon Compte</a> | <a href="#" id="telechargerDonnees" data-toggle="modal" data-target="#telechargementDonnees" onclick="telechargerDonnees(<?=$_SESSION['idMembre'];?>)">Télécharger Mes Données</a>
            </small>
        </div>
        <!-- MODAL SUPPRIMER COMPTE -->
        <div class="modal fade" id="supprimerCompte" aria-hidden="true" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Supprimer Compte Utilisateur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Attention! Toutes vos données seront supprimées. Pensez à télécharger vos donneés avant la suppression du compte.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-danger" id="delete" onclick="supprimerCompte(<?=$_SESSION['idMembre'];?>)">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="telechargementDonnees" aria-hidden="true" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Télécharger vos données</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Vous pouvez désormais télécharger toutes les traces vous concernant stockées sur notre site.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary addRecipe" href="" id="telecharger" download="">Télécharger</button>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
</div>


<?php
if ($result->rowCount()==0) { ?>
    <!--<nav class="navbar navbar-light fixed-bottom bg-light" id="footer">
    <span class="navbar-text mx-auto">
        <a href="#">Recettes</a> | <a href="#">Menus</a> | <a href="#">Desserts</a> | <a href="#">Minceur</a> | <a
                href="#">Atelier</a> | <a href="#">Contact</a>
        <br>
        <div class="socialFooter text-center">
            <i class="fab fa-facebook-f p-2"></i>
            <i class="fab fa-twitter p-2"></i>
            <i class="fab fa-google-plus-g p-2"></i>
            <i class="fab fa-youtube p-2"></i>
        </div>
    </span>
    </nav>
    </body>
    </html>-->
<?php } else {
    require 'inc/footer.php';
}?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        var s_id = 0;
        var d_id = 0;

        $('body').on('click', '#modify',function() {
            document.getElementById("recette_id").value = $(this).attr('data-id');
            //console.log($(this).attr('data-id'));
            s_id = $(this).attr('data-id');
        });

        $('body').on('click', '#deleteRecipe',function() {
            document.getElementById("recette_id").value = $(this).attr('data-id');
            //console.log($(this).attr('data-id'));
            d_id = $(this).attr('data-id');
        });

        $('#save').click(() => {
            sauvegarderRecette(s_id);
        });
        $('#delete').click(() => {
            supprimerRecette(d_id);
        })
    });


    function supprimerRecette(idRecette) {
        let request = $.ajax({
            'url' : 'ajax/supprimerRecette.php',
            'type' : 'POST',
            'data': {
                'idRecette':idRecette
            }
        });
        request.done((result) => {
            console.log(result);
        });
        request.fail((result) => {
            console.log(result);
        });

        document.location.reload();
    }

    function modifierRecette(idRecette) {
        let request = $.ajax({
            'url': 'ajax/modifierRecette.php',
            'type': 'POST',
            'data': {
                'idRecette': idRecette
            }
        });

        request.done((result) => {
            $('#recipeContents').html(result);
        });

        request.fail((result) => {
            console.log(result)
        });
    }

    function sauvegarderRecette(idRecette) {
        let request = $.ajax({
            'url' : 'ajax/sauvegarderRecette.php',
            'type' : 'POST',
            'data' : {
                'idRecette' : idRecette,
                'titreRecette' : $('#titreRecette').val(),
                'chapeauRecette' : $('#chapeauRecette').val(),
                'ingredientsRecette' : $('#ingredientsRecette').val(),
                'prepaRecette' : $('#prepaRecette').val(),
                'categorieRecette' : $('#categorieRecette').val(),
                'tempsCuissonRecette' : $('#recetteTempsCuisson').val(),
                'tempsPrepaRecette' : $('#recetteTempsPrepa').val(),
                'difficulteRecette' : $('#recetteDifficulte').val(),
                'prixRecette' : $('#recettePrix').val(),
                'couleurRecette' : $('#couleurRecette').val()
            },
            success: function(){
                window.location.reload();
            }
        });

        request.done((result) => {
            console.log(result)
        });

        request.fail((result) => {
            console.log(result)
        });
    }

    function supprimerCompte(idUtilisateur) {
        let request = $.ajax({
            'url' : 'ajax/supprimerCompte.php',
            'type' : 'POST',
            'data' : {
                'idUtilisateur' : idUtilisateur
            },
            success: function(){
                window.location.replace('index.php');
            }
        });

        request.done((result) => {
            console.log(result);
        });

        request.fail((result) => {
            console.log(result);
        });
    }

    function telechargerDonnees(idUtilisateur) {
        let request = $.ajax({
            'url' : 'ajax/telechargerDonnees.php',
            'type' : 'POST',
            'data' : {
                'idUtilisateur' : idUtilisateur
            }
        });

        request.done((result) => {
            console.log(result);
            //$('#telecharger').attr("href",result);
            $('#telecharger').click(() => {
                window.location = result;
            })
        });

        request.fail((result) => {
            console.log(result);
        });
    }
</script>