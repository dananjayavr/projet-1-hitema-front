<?php
include "./inc/header.php";
include './inc/login.php';
$pdo = new PDO('mysql:host=localhost;dbname=cooking',$un,$pw,
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$id_recette = $_GET['idr'];

/* Détails recette */
$query = "SELECT r.idRecette, r.img, r.chapo, r.titre, r.difficulte, r.preparation,r.tempsPreparation, r.tempsCuisson, r.ingredient, r.tempsPreparation, r.prix, r.dateCrea,m.nom,m.prenom,c.nom FROM recettes r, membres m, categories c WHERE r.idRecette='$id_recette' AND m.idMembre=r.membre AND r.categorie=c.idCategorie;";
$result = $pdo->query($query);
$recette = $result->fetch(PDO::FETCH_OBJ);
?>
<div class="container">
    <div class="row mx-auto pt-5">
        <div class="col-sm-6 titre-recette p-5">
            <h1><?php echo $recette->titre;?></h1>
            <h6>Par <?php echo ucfirst($recette->prenom); ?> | <i class="fas fa-utensils"></i> <?php echo $recette->difficulte; ?> | <i class="fas fa-euro-sign"></i> <?php echo $recette->prix ?> | <?php echo substr($recette->dateCrea,0,10);?></h6>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <img src="./assets/photos/recettes/<?php echo $recette->img;?>" class="rounded img-fluid" alt="...">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12 p-5">
            <p id="description">
                <?php echo $recette->chapo; ?>
            </p>
            <h6 id="recette-meta">Cuisson: <?php echo $recette->tempsCuisson;?> | Préparation: <?php echo $recette->tempsPreparation; ?> | Catégorie: <?php echo $recette->nom?></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 p-5" id="ingredients">
            <h6>Ingrédients</h6>
            <ul>
                <?php echo $recette->ingredient;?>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-12 p-5">
            <h6>Préparation</h6>
            <div id="preparation">
                <?php echo $recette->preparation; ?>
            </div>
        </div>
    </div>
    <p>
        <a href="./index.php">Retour</a>
    </p>
</div>
<?php include "./inc/footer.php";?>
