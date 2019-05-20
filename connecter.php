<?php
require_once 'inc/init.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <div class="alertBox"></div>
            <h1 id="titreInscription">Se connecter</h1>
            <hr>
        </div>
        <div class="col"></div>
        <div class="col-xs-12 col-lg-6">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="prenom" class="font-weight-bold">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>
                </div>
                <div class="form-group">
                    <label for="mp" class="font-weight-bold">Mot de Passe</label>
                    <input type="password" class="form-control" id="mp" name="mp" placeholder="mot de passe" minlength="8" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary btn-block btn-sm" id="inscrire">Se Connecter</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php
require 'inc/footer.php';
?>
<?php if(isset($_GET['submitted']) && $_GET['submitted']=="success") { ?>
    <script>
        $('.alertBox').append("<div class=\"alert alert-success\" role=\"alert\">\n" +
            "  Votre profil a été créé. Veuillez se connecter.\n" +
            "</div>");
    </script>
<?php } ?>
