<?php

session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

function getUsers(){
    global $pdo;
    $sql="SELECT * FROM vactolib_user ORDER BY id DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

//debug(getUsers());
//debug($_SESSION);
if(!empty($_SESSION)){
    include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
    <section>
        <div class="container_accueil">
            <div class="wrap">
                <div class="items_accueil">
                    <div class="items_accueil_p">
                        <div class="p_items_a">
                            <?php if(!empty($_SESSION['prenom'])){ ?>
                            <p>Vactolib est content de vous revoir <?php echo $_SESSION['prenom']?>. <br>
                                Avec nous, vos donnée sont protegées </p>
                             <?php } else ?>
                            <p>Vactolib est content de vous revoir. <br>
                                Avec nous, vos donnée sont protegées </p>
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
                    <div class="boxs_tache1"></div>
                    <div class="boxs_text">
                        <p>Vactolib c'est...</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache2"></div>
                    <div class="boxs_text">
                        <p><?php count(getUsers()) ?>millions de patients</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache3"></div>
                    <div class="boxs_text">
                        <p>150 00 personnels <br>de santé</br></p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache4"></div>
                    <div class="boxs_text">
                        <p>98% d'avis positifs</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="donnes_secure">
        <div class="wrap">
            <div class="container_secure">
                <div class="ds_text">
                    <div class="items_secure">
                        <h2>Chez Vactolib votre Santé, <br>C’est aussi vos données.</h2>
                        <p>La confidentialité de vos informations personnelles est une priorité absolue pour Vactolib et guide notre action au quotidien.</p>
                    </div>
                    <div class="logo_coffre">
                        <img src="asset/img/coffret%20fort.png" alt="coffre fort">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else {
    include('inc/header.php'); ?>
    <section>
        <div class="container_accueil">
            <div class="wrap">
                <div class="items_accueil">
                    <div class="items_accueil_p">
                        <div class="p_items_a">
                            <p>Vactolib est une application <br>
                                pilotée par l'État pour vous retrouver dans vos différents vaccins.</p>
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
        <div class="separator">
        </div>
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
                    <div class="boxs_tache1"></div>
                    <div class="boxs_text">
                        <p>Vactolib c'est...</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache2"></div>
                    <div class="boxs_text">
                        <p><?php count(getUsers()) ?>millions de patients</p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache3"></div>
                    <div class="boxs_text">
                        <p>150 00 personnels <br>de santé</br></p>
                    </div>
                </li>
                <li>
                    <div class="boxs_tache4"></div>
                    <div class="boxs_text">
                        <p>98% d'avis positifs</p>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="donnes_secure">
        <div class="wrap">
            <div class="container_secure">
                <div class="ds_text">
                    <div class="items_secure">
                        <h2>Chez Vactolib votre Santé, <br>C’est aussi vos données.</h2>
                        <p>La confidentialité de vos informations personnelles est une priorité absolue pour Vactolib et guide notre action au quotidien.</p>
                    </div>
                    <div class="logo_coffre">
                        <img src="asset/img/coffret%20fort.png" alt="coffre fort">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>


<?php include ('inc/footer.php');
