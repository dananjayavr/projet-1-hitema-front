<?php
include "./inc/header.php";
include "./inc/login.php";

$pdo = new PDO('mysql:host=localhost;dbname=cooking',$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$id_utilisateur = filter_input(INPUT_GET,'idm',FILTER_SANITIZE_ENCODED);

/* Détails membres */
$query_m = "SELECT gravatar, prenom, nom, dateCrea FROM membres WHERE idMembre='$id_utilisateur';";
$result_m = $pdo->query($query_m);
$membre = $result_m->fetch(PDO::FETCH_OBJ);

/*$membre = $result->fetch(PDO::FETCH_OBJ);*/

?>
<div class="container">
    <!--<div class="row">
        <div class="col-sm-12" id="banner">
        </div>
    </div>-->
    <div class="row mx-auto bio-bg">
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
    <hr>
    <?php
    $query_r = "SELECT idRecette, img, chapo, titre, difficulte, tempsPreparation, prix FROM recettes WHERE membre='$id_utilisateur';";
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
                        <a href="recette-detail.php?idr=<?php echo $recette->idRecette;?>" class="btn btn-primary btn-lg" role="button">Je cuisine!</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "./inc/footer.php"; ?>
