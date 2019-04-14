<?php
include './inc/header.php';
?>

<div class="container">
    <div class="row align-items-center">
        <div class="searchBox">
            <div class="col-sm-12 pb-5">
                <h1>Trouver une recette</h1>
            </div>
            <div class="col-sm-12">
                <form class="form-block">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <br>
                    <button class="btn btn-outline-success btn-block" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="row align-items-center">
        <div class="col-sm-12 pb-5 text-center">
            <h1>Recettes en vedette</h1>
        </div>
        <div class="row align-items-center" id="vedettes">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="https://via.placeholder.com/150x100" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
