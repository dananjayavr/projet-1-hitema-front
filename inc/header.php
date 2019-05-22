<!doctype html>
<html lang="fr">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" href="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/apple/198/cooking_1f373.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo:700" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link rel="stylesheet" href="./css/main.css">
    <title>Cooking!</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">
        <img src="./assets/images/home-icon.png" alt="Cooking Logo" height="100" width="100">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
            if (isset($_SESSION['login'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="deconnecter.php">Se déconnecter<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="membre-detail.php?idm=<?=$_SESSION['idMembre']?>">Mes Recettes<span class="sr-only">(Current)</span></a>
                </li>
            <?php } else { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="connecter.php">Se connecter<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="inscrire.php">Créer un compte</a>
                </li>
            <?php }
            ?>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Plus
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                    if (isset($_SESSION['login'])) { ?>
                        <a class="dropdown-item" href="#">Menus</a>
                        <a class="dropdown-item" href="#">Minceur</a>
                        <a class="dropdown-item" href="#">Atelier</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    <?php } else { ?>
                        <a class="dropdown-item" href="#">Recettes</a>
                        <a class="dropdown-item" href="#">Menus</a>
                        <a class="dropdown-item" href="#">Minceur</a>
                        <a class="dropdown-item" href="#">Atelier</a>
                        <a class="dropdown-item" href="#">Contact</a>
                    <?php } ?>
                </div>
            </li>
        </ul>
        <?php
        if (isset($_SESSION['login'])) { ?>
        <?php } ?>
        <span class="navbar-text">
            <i class="fab fa-facebook-f p-2"></i>
            <i class="fab fa-twitter p-2"></i>
            <i class="fab fa-google-plus-g p-2"></i>
            <i class="fab fa-youtube p-2"></i>
        </span>
    </div>
</nav>
<!-- Content Below -->