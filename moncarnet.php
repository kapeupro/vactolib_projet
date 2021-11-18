<?php

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

include('inc/header.php'); ?>

<section>
    <div class="title-carnet">
        <h2>Mon Carnet</h2>
    </div>
    <div id="carnet">
        <div class="wrap">
            <div id="container-carnet">
                <div class="items-carnet-1">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet">Pascal Benoit</p>
                        <p class="naissance">Né le</p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
                <div class="items-carnet-2">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet">Pascal Benoit</p>
                        <p class="naissance">Né le</p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
                <div class="items-carnet-3">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet">Pascal Benoit</p>
                        <p class="naissance">Né le</p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
            </div>
        </div>
    </div>
</section>








<?php include('inc/footer.php');
