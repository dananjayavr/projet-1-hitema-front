<?php

require_once 'inc/init.php';

$sterm = filter_input(INPUT_POST,'searchTerm',FILTER_SANITIZE_STRING);
$sterm1 = trim($sterm," ");

/* Détails recette */
$query = "SELECT r.idRecette, r.titre, r.chapo, r.img, r.membre, r.couleur, m.prenom,m.gravatar FROM recettes r, membres m WHERE titre LIKE '%$sterm1%' AND r.membre=m.idMembre";
$query_row = "SELECT COUNT(*) FROM recettes WHERE titre LIKE '%$sterm1%'";

$row_count = $pdo->query($query_row)->fetchColumn();
$result = $pdo->query($query);
//$recettes = $result->fetch(PDO::FETCH_OBJ);
$class="";
if ($row_count==1) {
    $class="col-md-6";
} else {
    $class="col-sm-4 col-md-6";
}
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="p-5"><?php echo $row_count;?> résultat(s) contenant le terme '<?php echo $sterm1;?>'</h4>
            <hr>
        </div>
        <div class="row mx-auto" id="resultats">
            <div class="row mx-auto">
                <?php while ($recettes = $result->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="<?php echo $class;?>">
                    <div class="card">
                        <img class="card-img-top" src="./assets/photos/recettes/<?php echo $recettes->img;?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="recette-detail.php?idr=<?php echo $recettes->idRecette;?>"><h5 class="card-title" style="border-bottom: 5px solid <?php echo $couleurs[$recettes->couleur];?>"><?php echo $recettes->titre;?></h5></a>
                            <p class="card-text"><?php echo $recettes->chapo;?></p>
                            <p>Proposé par <a href="membre-detail.php?idm=<?php echo $recettes->membre; ?>"><?php echo $recettes->prenom;?></a></p>
                            <img src="./assets/photos/gravatars/<?php echo $recettes->gravatar; ?>" alt="" class="bio">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <p class="p-2">
        <a href="./index.php">Retour</a>
    </p>
</div>
<?php include "./inc/footer.php";?>
