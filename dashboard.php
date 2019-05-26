<?php
session_start();
require 'inc/login.php';

$pdo = new PDO('mysql:host='.$hn.';charset=utf8;dbname='.$db,$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

if ($_SESSION['statut'] !== "admin") {
    header('Location: connecter.php');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Cooking Back-office">
    <meta name="author" content="Dananjaya Ramanayake">
    <link rel="shortcut icon" href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/apple/198/cooking_1f373.png" type="image/x-icon">

    <title>Dashboard - Cooking</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="dashboard.php">Cooking!</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="deconnecter.php">Se Déconnecter</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#recettes">
                            <span data-feather="file"></span>
                            Recettes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#utilisateurs">
                            <span data-feather="users"></span>
                            Utilisateurs
                        </a>
                    </li>
                </ul>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                <h1 class="h2" id="recettes">Recettes</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th># Recette</th>
                        <th>Titre</th>
                        <th>Chapô</th>
                        <th>Image</th>
                        <th>Préparation</th>
                        <th>Ingrédient</th>
                        <th>Couleur</th>
                        <th>Date Création</th>
                        <th>Catégorie</th>
                        <th>Temps Cuisson</th>
                        <th>Temps Préparation</th>
                        <th>Difficulté</th>
                        <th>Prix</th>
                        <th>Vues</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM recettes";
                        $result = $pdo->query($query);
                        while ($recette = $result->fetch(PDO::FETCH_OBJ)) { ?>
                        <tr>
                            <td><?=$recette->idRecette;?></td>
                            <td><?=$recette->titre;?></td>
                            <td><?=$recette->chapo;?></td>
                            <td><?=$recette->img;?></td>
                            <td><?=strip_tags($recette->preparation);?></td>
                            <td><?=strip_tags($recette->ingredient);?></td>
                            <td><?=$recette->couleur;?></td>
                            <td><?=$recette->dateCrea;?></td>
                            <td><?=$recette->categorie;?></td>
                            <td><?=$recette->tempsCuisson;?></td>
                            <td><?=$recette->tempsPreparation;?></td>
                            <td><?=$recette->difficulte;?></td>
                            <td><?=$recette->prix;?></td>
                            <td>#</td>
                            <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modifyRecipe" href="" onclick="modifierRecette(<?=$recette->idRecette;?>)"><i class="far fa-edit" data-id="<?=$recette->idRecette;?>" id="modify"></button></td>
                            <td><button class="btn btn-danger btn-sm" id="deleteRecipe" data-toggle="modal" data-target="#supprimerRecette" data-id="<?=$recette->idRecette;?>"><i class="far fa-trash-alt"></button></td>

                            <!-- MODAL MODIFIER RECETTE -->
                            <div class="modal fade" id="modifyRecipe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <input id="recette_id" name="rid" type="hidden" value="" />
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
                                            <button type="button" class="btn btn-primary" id="save">Sauvegarder</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL SUPPRIMER RECETTE -->
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

                        <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                <h1 class="h2" id="utilisateurs">Utilisateurs</h1>
            </div>
            <div class="table-responsive pt-3">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th># Membres</th>
                        <th>Gravatar</th>
                        <th>Login</th>
                        <th>Statut</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>Date Création Membre</th>
                        <th>Modifier</th>
                        <th>Bloquer</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM membres";
                    $result = $pdo->query($query);
                    while ($membre = $result->fetch(PDO::FETCH_OBJ)) { ?>
                    <tr>
                        <td><?=$membre->idMembre;?></td>
                        <td><?=$membre->gravatar;?></td>
                        <td><?=$membre->login;?></td>
                        <td><?=$membre->statut;?></td>
                        <td><?=$membre->prenom;?></td>
                        <td><?=$membre->nom;?></td>
                        <td><?=$membre->dateCrea;?></td>
                        <td><button class="btn btn-primary btn-sm"><i class="far fa-edit"></i></button></td>
                        <td><button class="btn btn-warning btn-sm"><i class="fas fa-ban"></i></button></td>
                        <td><button class="btn btn-danger btn-sm" id="supprimerUtilisateur" data-toggle="modal" data-target="#supprimerCompte" data-id="<?=$membre->idMembre;?>"><i class="far fa-trash-alt"></i></button></td>
                    </tr>

                        <!-- MODAL SUPPRIMER COMPTE -->
                        <div class="modal fade" id="supprimerCompte" aria-hidden="true" tabindex="-1" role="dialog">
                            <input id="compte_id" name="cid" type="hidden" value="">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Supprimer Compte Utilisateur</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Attention! Toutes les données utilisateur seront supprimées. Pensez à les télécharger avant la suppression du compte.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-danger" id="deleteCompte">Confirmer</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Custom Scripts -->
<script>
    $(document).ready(function () {
        var s_id = 0;
        var d_id = 0;
        var c_id = 0;

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
        $('body').on('click', '#supprimerUtilisateur',function() {
            document.getElementById("compte_id").value = $(this).attr('data-id');
            //console.log($(this).attr('data-id'));
            c_id = $(this).attr('data-id');
        });

        $('#save').click(() => {
            sauvegarderRecette(s_id);
        });
        $('#delete').click(() => {
            supprimerRecette(d_id);
        });
        $('#deleteCompte').click(() => {
            supprimerCompte(c_id);
        });

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
            'url': 'ajax/sauvegarderRecette.php',
            'type': 'POST',
            'data': {
                'idRecette': idRecette,
                'titreRecette': $('#titreRecette').val(),
                'chapeauRecette': $('#chapeauRecette').val(),
                'ingredientsRecette': $('#ingredientsRecette').val(),
                'prepaRecette': $('#prepaRecette').val(),
                'categorieRecette': $('#categorieRecette').val(),
                'tempsCuissonRecette': $('#recetteTempsCuisson').val(),
                'tempsPrepaRecette': $('#recetteTempsPrepa').val(),
                'difficulteRecette': $('#recetteDifficulte').val(),
                'prixRecette': $('#recettePrix').val(),
                'couleurRecette': $('#couleurRecette').val()
            },
            'success': function () {
                window.location.reload();
            }
        });

        request.done((result) => {
            //$('#alertBoxRecette').html(result);
            console.log(result);
        });

        request.fail((result) => {
            console.log(result)
        });
    }

    function supprimerCompte(idUtilisateur) {
        let request = $.ajax({
            'url' : 'ajax/supprimerUtilisateur.php',
            'type' : 'POST',
            'data' : {
                'idUtilisateur' : idUtilisateur
            },
            'success': function(){
                window.location.reload()
            }
        });

        request.done((result) => {
            console.log(result);
        });

        request.fail((result) => {
            console.log(result);
        });
    }

</script>
<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
</body>
</html>