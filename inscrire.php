<?php
require_once 'inc/init.php';

if (!isset($_SESSION['login'])) {
    header('Location: index.php');
    exit();
}

$prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
$nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mp = password_hash(filter_input(INPUT_POST, 'mp', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT);
//$dateCreation = date("Y-m-d g:i:s");
$gravatar = 'default.png';
$statut = 'membre';

if(!empty($_POST)) {
    $query = "INSERT INTO membres (gravatar, login, password, statut, prenom, nom) VALUES ('$gravatar','$pseudo','$mp','$statut','$prenom','$nom')";
    $result = $pdo->query($query);
}

if(!empty($_POST)) {
    if ($result) { ?>
        <script>
            $(document).ready(() => {
                $('.alertBox').append("<div class=\"alert alert-success\" role=\"alert\">\n" +
                    "  Votre profil a été créé. Vous serez redirigié automatiquement vers la page de connexion\n" +
                    "</div>");
            });
        </script>
        <?php
        header('Refresh:2; url=connecter.php',true,303);
        ?>
    <?php } else { ?>
        <script>
            $(document).ready(() => {
                $('.alertBox').append("<div class=\"alert alert-warning\" role=\"alert\">\n" +
                    "  Un erreur d'enregistrement a été détecté. Veuillez réessayer ultérieurement.\n" +
                    "</div>");
            });
        </script>
    <?php }
}
?>
<style>
    @media only screen and (max-width: 600px) {
        #footer {
            display: none;
        }
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <div class="alertBox"></div>
            <h1 id="titreInscription">Créer un compte</h1>
            <hr>
        </div>
        <div class="col"></div>
        <div class="col-xs-12 col-lg-6">
            <form method="POST" action="inscrire.php">
                <div class="form-group">
                    <label for="prenom" class="font-weight-bold">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prenom" required>
                </div>
                <div class="form-group">
                    <label for="prenom" class="font-weight-bold">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-group">
                    <label for="pseudo" class="font-weight-bold">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entre 2 à 6 caractères" minlength="2" maxlength="6" required>
                </div>
                <div class="form-group">
                    <label for="mp" class="font-weight-bold">Mot de Passe (8 caractères minimum)</label>
                    <input type="password" class="form-control" id="mp" name="mp" placeholder="mot de passe" minlength="8" required>
                </div>
                <br>
                <div class="alertArea"></div>
                <button type="submit" class="btn btn-primary btn-block btn-sm mb-5" id="inscrire">S'inscrire</button>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>