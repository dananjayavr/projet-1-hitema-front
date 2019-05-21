<?php
require_once 'inc/init.php';
?>

<?php
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
$mp = filter_input(INPUT_POST, 'mp', FILTER_SANITIZE_STRING);

$query = "SELECT * FROM membres WHERE login='$pseudo'";
$result = $pdo->query($query);
$user = $result->fetch(PDO::FETCH_OBJ);

if(!empty($_POST)) {
    if($user && password_verify($mp,$user->password)) {

        $_SESSION['idMembre'] = $user->idMembre;
        $_SESSION['gravatar'] = $user->gravatar;
        $_SESSION['login'] = $user->login;
        $_SESSION['statut'] = $user->statut;
        $_SESSION['prenom'] = $user->prenom;
        $_SESSION['nom'] = $user->nom;

        header('Location: index.php');
    } else { ?>
        <script>
            $(document).ready(() => {
                $('.alertBox').append("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    "  Un erreur a été détécté. Veuillez vérifier votre pseudo et mot de passe.\n" +
                    "</div>");
            });
        </script>
    <?php } ?>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <div class="alertBox"></div>
            <h1 id="titreInscription">Se connecter</h1>
            <hr>
        </div>
        <div class="col"></div>
        <div class="col-xs-12 col-lg-6">
            <form method="POST" action="#" class="mb-5">
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

<?php if(isset($_GET['submitted']) && $_GET['submitted']=="success") { ?>
    <script>
        $('.alertBox').append("<div class=\"alert alert-success\" role=\"alert\">\n" +
            "  Votre profil a été créé. Veuillez vous connecter.\n" +
            "</div>");
        setTimeout(() => {
            $('.alertBox').remove();
        },2000);
    </script>
<?php } ?>