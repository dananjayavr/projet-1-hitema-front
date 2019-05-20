<?php
require_once 'inc/init.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 id="titreInscription">Créer un compte</h1>
            <hr>
        </div>
        <div class="col"></div>
        <div class="col-xs-12 col-lg-6">
            <form method="POST" action="insert.php">
                <div class="form-group">
                    <label for="prenom" class="font-weight-bold">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom">
                </div>
                <div class="form-group">
                    <label for="prenom" class="font-weight-bold">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom">
                </div>
                <div class="form-group">
                    <label for="pseudo" class="font-weight-bold">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entre 2 à 6 caractères" minlength="2" maxlength="6">
                </div>
                <div class="form-group">
                    <label for="mp" class="font-weight-bold">Mot de Passe (8 caractères minimum)</label>
                    <input type="password" class="form-control" id="mp" name="mp" placeholder="mot de passe" minlength="8">
                </div>
                <br>
                <div class="alertArea"></div>
                <button type="submit" class="btn btn-primary btn-block btn-sm" id="inscrire">S'inscrire</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php
require 'inc/footer.php';
?>
