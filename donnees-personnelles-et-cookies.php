<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
include('inc/header.php'); ?>

    <section>
        <?php if(!empty($_SESSION)){ echo'<link rel="stylesheet" href="asset/css/style_user.css">';} else {echo '<link rel="stylesheet" href="asset/css/style.css">';} ?>
        <div class="wrap">
            <div class="container-donnees-personnelles-et-cookies">
                <div id="title-h2-donnees-personnelles-et-cookies">
                    <h2>Données personnelles et cookies</h2>
                </div>
                <div class="items-1-donnees-personnelles-et-cookies">
                    <h3>Collecte de données</h3>
                    <p>Le présent site ne collecte pas de données personnelles.</p>
                </div>
                <div class="items-2-donnees-personnelles-et-cookies">
                    <h3>À propos des cookies</h3>
                    <p>Lors de la consultation du site, plusieurs types de cookies sont déposés sur votre ordinateur, votre mobile ou votre tablette. Un "cookie" est une suite d'informations, généralement de petite taille et identifié par un nom, qui peut être transmis à votre navigateur par un site web sur lequel vous vous connectez. Votre navigateur web le conservera pendant une certaine durée, et le renverra au serveur web chaque fois que vous vous y re-connecterez.</p>
                </div>
                <div class="items-3-donnees-personnelles-et-cookies">
                    <h3>Cookies techniques</h3>
                    <p>Nous devons utiliser ces cookies pour pouvoir faire fonctionner certaines pages web. C’est la raison pour laquelle ils ne nécessitent pas votre consentement.</p>
                    <ul>
                        <li>Nom : i18n</li>
                        <li>Services : Gestion du multilingue</li>
                        <li>Objectif : Redirige automatiquement vers la version du site dans la langue du navigateur de l'utilisateur.</li>
                        <li>Type de cookie et durée : cookie interne persistant, 1 an.</li>
                        <li>Objectif : Fournir un chatbot de FAQ pour fournir une aide supplémentaire à l'utilisateur.</li>
                        <li>Type de cookie et durée : cookie interne persistant.</li>
                    </ul>
                </div>
                <div class="items-4-donnees-personnelles-et-cookies">
                    <h3>Cookies de mesure d’audience</h3>
                    <p>Notre site utilise une solution de mesure d'audience qui ne dépose pas de cookies tiers.</p>
                </div>
                <div class="items-5-donnees-personnelles-et-cookies">
                    <h3>Quels sont vos droits sur vos données et comment les exercer ?</h3>
                    <p>Vous disposez des droits suivants en ce qui concerne l’utilisation de vos données personnelles :</p>
                    <ul>
                        <li>obtenir la confirmation que des données vous concernant sont ou ne sont pas traitées et, lorsqu’elles le sont, l’accès à ces données ainsi qu’à des informations sur ces traitements ;</li>
                        <li>obtenir la rectification de données inexactes ;</li>
                        <li>dans certains cas précis, obtenir l’effacement de certaines de vos données ;</li>
                        <li>dans certains cas précis, obtenir la limitation des traitements que nous réalisons ;</li>
                        <li>vous opposer au traitement de vos données, pour des raisons tenant à votre situation particulière, ou, indépendamment de votre situation particulière, à l’utilisation de vos données à des fins de prospection ;</li>
                        <li>retirer pour l’avenir votre consentement à tout moment, s’il servait de base légale au traitement de vos données ;</li>
                        <li>recevoir les données que vous avez fournies et/ou demander de les transmettre à un autre responsable du traitement, si le traitement est fondé sur votre consentement ou sur un contrat et que le traitement est automatisé ;</li>
                        <li>si vous résidez en France, définir le sort de vos données après votre mort.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php include('inc/footer.php');
