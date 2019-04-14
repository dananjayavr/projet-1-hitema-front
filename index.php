<?php
include './inc/header.php';
?>

<div class="container">
    <div class="row mx-auto">
        <div class="searchBox">
            <div class="col-sm-12 pb-5">
                <h1>Trouver une recette</h1>
            </div>
            <div class="col-sm-12">
                <form class="form-block">
                    <div class="md-form mt-0">
                        <input class="form-control form-control-lg form-control-borderless" type="text" placeholder="Trouver votre inspiration" aria-label="Search">
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
                <div class="col-sm-4 col-xs-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <p>Proposé par Annie</p>
                            <img src="./assets/photos/gravatars/annie.png" alt="" class="bio">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <p>Proposé par Annie</p>
                            <img src="./assets/photos/gravatars/didier.png" alt="" class="bio">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <p>Proposé par Annie</p>
                            <img src="./assets/photos/gravatars/laure.png" alt="" class="bio">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" id="partage">
        <div class="col-sm-12 pb-5">
            <h1>Partager une recette</h1>
        </div>
        <div class="col-sm-12">
            <button type="button" class="btn btn-primary btn-lg btn-block">Allons-y</button>
        </div>
    </div>
</div>


<?php
include './inc/footer.php';
?>
