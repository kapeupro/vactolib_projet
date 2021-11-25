<?php


require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

include('inc/header.php'); ?>
<?php if(!empty($_SESSION)){ echo'<link rel="stylesheet" href="asset/css/style_user.css">';} else {echo '<link rel="stylesheet" href="asset/css/style.css">';} ?>
    <section>
        <div class="title_vieprivee">
            <h2>Avec Vactolib, vous êtes les chefs de vos données !</h2>
        </div>

        <div class="wrap">
            <div class="container_vieprivee_1">
                <div class="items_vie_1">
                    <h3>Les crypto-identifiants échangés sont anonymes et sécurisés</h3>
                    <p>Les données de TousAntiCovid sont stockées localement sur votre téléphone et peuvent être supprimées à tout moment.
                        Son fonctionnement rend impossible, et pour quiconque, la possiblité de reconstituer la liste des personnes ayant
                        déclaré être contaminées. Il s'agit du principe au cœur de l’application, de telle manière que personne ne puisse ni
                        retracer la liste des personnes testées positives ni, le cas échéant, reconstituer la chaîne de transmission.</p>
                </div>
                <div class="image_vieprivee_2">
                    <img src="asset/img/b184432d-4965-4a9c-aacb-272c0d9147b0_anonimity.png" alt="">
                </div>
            </div>

            <div class="container_vieprivee_2">
                <div class="items_vie_2">
                    <h3>Un stockage exclusivement local de vos documents</h3>
                    <p>Tant que vous ne vous vous déclarez pas comme positif à la Covid-19, c'est l'application qui vérifie auprès du serveur si ses propres crypto-identifiants se trouvent parmi ceux disponibles
                        sur le serveur et non l'inverse. Par ailleurs, lors du contrôle d'un pass sanitaire sur le territoire national ou lors de vos voyages, les autorités compétentes (personnel habilité, police)
                        peuvent accéder à vos certificats avec l’application TAC Verif. Seule l'authenticité de signature du certificat est alors vérifiée par un serveur dédié d'IN Groupe (Imprimerie Nationale).</p>
                </div>
                <div class="image_vieprivee_1">
                    <a href="https://www.o2switch.fr/">
                        <img src="asset/img/bacllogo.png" alt="o2switch">
                    </a>
                </div>
            </div>

            <div class="container_vieprivee_1">
                <div class="items_vie_1">
                    <h3>Un code Open Source et auditable par tous</h3>
                    <p>Les protocoles de l'application, développés avec les équipes d'Inria, sont publics. Ils permettent de comprendre comment l'application fonctionne,
                        quelles sont les données échangées et de les confronter à la communauté scientifique pour identifier les éventuelles failles.
                        Vous pouvez ainsi vérifier que les engagements pris sur la protection des données personnelles sont respectés.</p>
                </div>
                <div class="image_vieprivee_2">
                    <a href="https://bitbucket.org/">
                        <img src="asset/img/Bitbucket_Logo_350x140.png" alt="Bitbucket">
                    </a>
                </div>
            </div>

            <div class="container_vieprivee_2">
                <div class="items_vie_2">
                    <h3>Sécurité des données personnelles</h3>
                    <p>L’Agence nationale de la sécurité des systèmes d’information (ANSSI) est associée au développement de l'application, afin de contrôler la robustesse du système.
                        Les principaux choix techniques, opérationnels et son architecture centralisée la protègent ainsi d’un risque de cyber-attaque. Il s'agit du meilleur
                        compromis entre les exigences de sécurité et de respect des libertés individuelles.</p>
                </div>
                <div class="image_vieprivee_1">
                    <a href="https://www.ssi.gouv.fr/">
                        <img src="asset/img/Anssi.png" alt="logo Anssi">
                    </a>
                </div>
            </div>

            <div class="container_vieprivee_1">
                <div class="items_vie_1">
                    <h3>Cadre juridique</h3>
                    <p>Le Gouvernement a toujours posé l’exigence de la conformité de l’application au cadre réglementaire français et européen, hors état d’urgence sanitaire.
                        Son développement s’est par ailleurs accompagné d’un dialogue très étroit avec l’ensemble des parties prenantes, au premier rang desquelles le Parlement
                        et la Commission Nationale Informatique et Libertés (CNIL).</p>
                </div>
                <div class="image_vieprivee_2">
                    <a href="https://www.cnil.fr/fr">
                        <img src="asset/img/2560px-Commission_nationale_de_l27informatique_et_des_libertC3A9s_28logo29.png" alt="CNIL">
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php include('inc/footer.php');