<?php

require('inc/fonction.php');
require('inc/request.php');





include('inc/header.php'); ?>
    <section>
        <div class="container_accueil">
            <div class="wrap">
                <div class="items_accueil">
                    <div class="items_accueil_p">
                        <div class="p_items_a">
                            <p>Vactolib est une application <br>
                                pilotée par l'État pour vous retrouver <br> dans vos différents vaccins.</p>
                        </div>
                        <div class="items_a">
                            <a href="#">Inscription</a>
                            <a href="#">Connexion</a>
                        </div>
                    </div>
                    <div class="items_groupe">
                        <img src="asset/img/groupe.png">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stats">
        <div class="wrap">
            <div class="tache"></div>
            <div class="title">
                <h2>Pourquoi prendre Vactolib ?</h2>
            </div>
            <ul class="boxs">
                <li>
                    <div class="img">
                        <img src="asset/img/pq_vactolib1.png" alt="img1">
                    </div>
                    <div class="boxs_text">
                        <p>Recevez des rappels automatiques par SMS ou par email.</p>
                    </div>
                </li>
                <li>
                    <div class="img">
                        <img src="asset/img/pq_vactolib2.png" alt="img2">
                    </div>
                    <div class="boxs_text">
                        <p>Retrouvez votre historique de vacination et vos documents de rappel.</p>
                    </div>
                </li>
                <li>
                    <div class="img">
                        <img src="asset/img/pq_vactolib3.png" alt="img3">
                    </div>
                    <div class="boxs_text">
                        <p>Accédez aux disponibilités de dizaines de milliers de professionnels de santé.</p>
                    </div>
                </li>
                <li>
                    <div class="img">
                        <img src="asset/img/pq_vactolib4.png" alt="img4">
                    </div>
                    <div class="boxs_text">
                        <p>Prenez rendez vous en ligne, 24h/24 et 7j/7, pour une consultation physique ou vidéo.</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="stats_bis">
        <div class="wrap">
            <ul>
                <li>
                    <div class="boxs_text">
                        <p>Vactolib c'est...</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_text">
                        <p>30 millions de patients</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_text">
                        <p>150 00 personnels de santé</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_text">
                        <p>98% d'avis positifs</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="donnes_secure">
        <div class="container">
            <div class="ds_text">
                <h2>Chez Vactolib votre Santé, C’est aussi vos données.</h2>
                <p>La confidentialité de vos informations personnelles est une priorité absolue pour Vactolib et guide notre action au quotidien.</p>
            </div>
        </div>
    </section>

<?php include ('inc/footer.php');
