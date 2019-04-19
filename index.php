<?php
include './inc/header.php';
include './inc/login.php';

$pdo = new PDO('mysql:host=localhost;dbname=cooking',$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

/* Recettes en vedette */
$query = "SELECT r.idRecette, r.titre,r.chapo,r.img, m.idMembre, m.prenom, m.gravatar FROM recettes r, membres m WHERE r.membre=m.idMembre ORDER BY RAND() LIMIT 4;";
$result = $pdo->query($query);
$recettes = $result->fetch(PDO::FETCH_OBJ);

?>

<div class="container">
    <div class="row mx-auto">
        <div class="col-sm-12 text-center p-5">
            <img src="./assets/images/logo-cooking.png" alt="Cooking Logo">
        </div>
    </div>
    <div class="row mx-auto">
        <div class="searchBox">
            <div class="col-sm-12 pb-5">
                <h1>Trouver une recette</h1>
            </div>
            <div class="col-sm-12">
                <form class="form-block" action="resultats.php" method="POST">
                    <div class="md-form mt-0">
                        <input class="form-control form-control-lg form-control-borderless" type="text" placeholder="Trouver votre inspiration" aria-label="Search" name="searchTerm">
                    </div>
                    <br>
                    <button class="btn btn-block" type="submit">Miam!</button>
                </form>
            </div>
            <div class="col-sm-12 pt-5">
                <h1 class="d-none d-sm-block">Miam miam, gloup gloup, laps laps</h1>
            </div>
        </div>
    </div>

    <hr>
    <div class="row mx-auto">
        <div class="col-sm-12 p-5 text-center">
            <h1>Recettes en vedette</h1>
        </div>
        <div class="row mx-auto" id="vedettes">
            <div class="row mx-auto">
                <?php while($recette = $result->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="col-lg-4 col-md-12 mb-3">
                    <div class="card h-100">
                        <img class="card-img-top" src="./assets/photos/recettes/<?php echo $recette->img;?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="recette-detail.php?idr=<?php echo $recette->idRecette;?>"><h5 class="card-title"><?php echo $recette->titre;?></h5></a>
                            <p class="card-text"><?php echo $recette->chapo;?></p>
                            <p>Proposé par <a href="membre-detail.php?idm=<?php echo $recette->idMembre; ?>"><?php echo ucfirst($recette->prenom);?></a></p>
                            <img src="./assets/photos/gravatars/<?php echo $recette->gravatar?>" alt="photo <?php echo $recette->prenom;?>" class="bio">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mx-auto" id="partage">
        <div class="col-sm-12 pb-5">
            <h1>Partager une recette</h1>
        </div>
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary btn-lg btn-block">Allons-y!</button>
        </div>
    </div>
</div>

<?php
include './inc/footer.php';
?>
