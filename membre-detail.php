<?php
include "./inc/header.php";
include "./inc/login.php";

$pdo = new PDO('mysql:host=localhost;dbname=cooking',$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$id_utilisateur = $_GET['idm'];

/* Détails membres */
$query_m = "SELECT gravatar, prenom, nom, dateCrea FROM membres WHERE idMembre='$id_utilisateur';";
$result_m = $pdo->query($query_m);
$membre = $result_m->fetch(PDO::FETCH_OBJ);

/*$membre = $result->fetch(PDO::FETCH_OBJ);*/

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <img src="./assets/photos/textures/bg-texture-membre.jpg" class="img-fluid" alt="Responsive image" id="bg-texture">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-4">
            <img src="./assets/photos/gravatars/<?php echo $membre->gravatar; ?>" alt="photo<?php echo $membre->prenom?>" id="bio-pic">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-4">
            <h4 class="p-5"><?php echo ucfirst($membre->prenom) . " " . $membre->nom; ?></h4>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-4">
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
            <div class="col-sm-4 col-xs-4 mb-5">
                <div class="card">
                    <img class="card-img-top" src="./assets/photos/recettes/<?php echo $recette->img;?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $recette->titre; ?></h5>
                        <p class="card-text">
                            <?php echo $recette->chapo; ?>
                            <br>
                            <strong><i class="fas fa-utensils"></i> <?php echo $recette->difficulte?> | <i class="far fa-clock"></i> <?php echo $recette->tempsPreparation?> | <i class="fas fa-euro-sign"></i> <?php echo $recette->prix?></strong>
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
