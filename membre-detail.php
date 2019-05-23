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
                <a href="ajouter.php?idm=<?=$id_utilisateur;?>" class="btn btn-primary btn-lg justify-content-center" role="button">Ajouter une recette</a>
            </div>
        </div>
    <?php } ?>
    <hr>
    <?php
    $query_r = "SELECT idRecette, img, chapo, titre, difficulte, tempsPreparation, prix, couleur FROM recettes WHERE membre='$id_utilisateur';";
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
                                <strong><i class="fas fa-utensils pt-2"></i> <?php echo $recette->difficulte?> | <i class="far fa-clock"></i> <?php echo $recette->tempsPreparation?> | <i class="fas fa-euro-sign"></i> <?php echo $recette->prix?></strong>
                            </p>
                            <a href="recette-detail.php?idr=<?php echo $recette->idRecette;?>" class="btn btn-primary btn-lg mb-2" role="button" style="background: <?php echo $couleurs[$recette->couleur];?>; border-color: white;">Je cuisine!</a>
                            <?php
                            if (isset($_SESSION['login']) and $_SESSION['idMembre'] == $id_utilisateur) { ?>
                                <br>
                                <a class="btn btn-outline-secondary btn-sm" href="" data-toggle="modal" data-target="#modifierRecette" onclick="modifierRecette(<?= $recette->idRecette; ?>)">Modifier</a> <span>|</span> <a class="btn btn-outline-danger btn-sm" href="" value="submit" data-toggle="modal" data-target="#supprimerRecette">Supprimer</a>
                            <?php } ?>
                            <div class="modal fade" id="modifierRecette" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modifier Recette</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="recipeContents"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Sauvegarder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="supprimerRecette" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <button type="button" class="btn btn-danger" id="supprimer" onclick="supprimerRecette(<?= $recette->idRecette; ?>)" data-dismiss="modal">Supprimer</button>
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
</div>


<?php
if ($result->rowCount()==0) { ?>
    <nav class="navbar navbar-light fixed-bottom bg-light" id="footer">
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
    </html>
<?php } else {
    require 'inc/footer.php';
}?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
    function supprimerRecette(idRecette) {
        let request = $.ajax({
            'url' : 'ajax/supprimerRecette.php',
            'type' : 'POST',
            'data': {
                'idRecette':idRecette
            }
        });
        request.done(() => {

        });
        request.fail((result) => {
            console.log(result);
        });

        document.location.reload();
    }

    function modifierRecette(idRecette) {
        let request = $.ajax({
            'url' : 'ajax/modifierRecette.php',
            'type' : 'POST',
            'data' : {
                'idRecette' : idRecette
            }
        });

        request.done((result) => {
            $('#recipeContents').html(result);
        });

        request.fail((result) => {
            console.log(result)
        });
    }
</script>