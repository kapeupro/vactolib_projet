<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

include('inc/header.php'); ?>

    <section>
        <?php if(!empty($_SESSION)){ echo'<link rel="stylesheet" href="asset/css/style_user.css">';} else {echo '<link rel="stylesheet" href="asset/css/style.css">';} ?>
        <div class="wrap">
            <div class="container-mentionslegal">
                <div id="title-h2-mentionslegal">
                    <h2>Mentions légales</h2>
                </div>
                <div class="items-1-mentionslegal">
                    <p>Conformément aux dispositions de l'article 6 III 1° de la loi n°2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, nous vous informons des éléments suivants :</p>
                </div>
                <div class="items-2-mentionslegal">
                    <h3>Editeur</h3>
                    <p>Le site web vactolib.com sous la responsabilité éditoriale de la Direction Générale de la Santé du ministère des solidarités et de la santé, dont le siège est situé 30 avenue Duquesne 76000 Rouen.</p>
                </div>
                <div class="items-3-mentionslegal">
                    <h3>Directeur de publication</h3>
                    <p>Le directeur de la publication du site est Patrick BRASSEUR- chef de la mission communication de la Direction Générale de la Santé - 30 avenue Duquesne 76000 Rouen</p>
                </div>
                <div class="items-4-mentionslegal">
                    <h3>Développement</h3>
                    <p>Le développement du site web est réalisé par la société Need For School équipe Vactolib</p>
                </div>
                <div class="items-5-mentionslegal">
                    <h3>Hébergement</h3>
                    <p>L'hébergement des serveurs est assuré par 3DS Outscale, 1, rue Royale – 319 Bureaux de la Colline 92210 Saint-Cloud.</p>
                </div>
                <div class="items-6-mentionslegal">
                    <h3>Accès au service</h3>
                    <p>Le service est accessible gratuitement, 24h/24, 7 jours sur 7 et sauf cas de force majeure ou maintenance technique depuis tout équipement numérique en capacité d’afficher du contenu web (HTML/CSS/Javascript).</p>
                    <p>Sachez toutefois que la Direction Générale de la Santé a demandé au sous-traitant en charge de développer le service de prendre soin de vérifier que les critères indiqués dans le référentiel général d’amélioration de l’accessibilité (RGAA) soient appliqués le plus tôt possible afin de rendre le site internet accessible au plus grand nombre et plus particulièrement aux personnes ayant un handicap.</p>
                </div>
                <div class="items-7-mentionslegal">
                    <h3>Accessibilité du service</h3>
                    <p>Au moment où nous rédigeons ces mentions légales, le site ne peut être déclaré conforme au RGAA version 4.
                        Sachez toutefois que la Direction Générale de la Santé a demandé au sous-traitant en charge de développer le service de prendre soin de vérifier que les critères indiqués dans le référentiel général d’amélioration de l’accessibilité (RGAA)soient appliqués le plus tôt possible afin de rendre le site internet accessible au plus grand nombre et plus particulièrement aux personnes ayant un handicap.</p>
                </div>
                <div class="items-8-mentionslegal">
                    <h2>Réutilisation des contenus</h2>
                </div>
                <div class="items-9-mentionslegal">
                    <h2>Consignes générales</h2>
                    <p>Sauf mention contraire indiquée dans les partie ci-dessous, tout utilisation de contenu du site web par un utilisateur est autorisé et gratuite dès lors qu’il respecte les conditions suivantes :</p>
                    <ol>
                        <li>Ne pas modifier ou altérer d’aucune sorte le document reproduit ;</li>
                        <li>Mentionner explicitement la source en indiquant « Source : Direction Générale de la Santé – suivi du lien vers le contenu d’origine » ;</li>
                        <li>Indiquer avec précision la date à laquelle le contenu a été extrait au format jj/mm/aaaa hh:mm ;</li>
                        <li>Indiquer la licence sous laquelle le contenu ou la donnée a été mis à disposition sur le site d’origine ;</li>
                        <li>N’utiliser les informations qu’à des fins personnelles, associatives ou professionnelles ; toute utilisation à des fins commerciales ou publicitaires étant exclue.</li>
                    </ol>
                    <p>Si l’utilisateur fait appel à des liens hypertextes pointant sur le contenu de ce site, il devra s’assurer que le lien :</p>
                    <ol>
                        <li>Décrit textuellement (balise alt du lien, par exemple) cette redirection</li>
                        <li>S’affiche dans une nouvelle fenêtre</li>
                    </ol>
                    <p>Toutes les autorisations mentionnées dans la section « Réutilisation des contenus » ne s'appliquent pas aux sites diffusant des contenus à caractère polémique, pornographique et xénophobe.</p>
                </div>
                <div class="items-10-mentionslegal">
                    <h3>Réutilisation des contenus textuels</h3>
                    <p>Respecter les consignes générales</p>
                </div>
                <div class="items-11-mentionslegal">
                    <h3>Réutilisation des images</h3>
                    <p>Respecter les consignes générales</p>
                </div>
                <div class="items-12-mentionslegal">
                    <h3>Réutilisation de l’iconographie</h3>
                    <p>Respecter les consignes générales</p>
                </div>
                <div class="items-13-mentionslegal">
                    <h3>Réutilisation des animations</h3>
                    <p>Respecter les consignes générales</p>
                </div>
                <div class="items-14-mentionslegal">
                    <h3>Réutilisation des vidéos</h3>
                    <p>Respecter les consignes générales</p>
                </div>
                <div class="items-15-mentionslegal">
                    <h3>Droit applicable</h3>
                    <p>Que ce soit le site web ou l’utilisation qui pourrait en être fait, le droit de référence est celui régis par le droit français, quel que soit le lieu de son utilisation.</p>
                </div>
                <div class="items-16-mentionslegal">
                    <h3>Sources de financement</h3>
                    <p>Le portail bonjour.tousanticovid.gouv.fr  est financé intégralement par le ministère des solidarités et de la santé et ne reçoit de ce fait aucun subside privé qui pourrait avoir potentiellement une influence sur son contenu.</p>
                </div>
            </div>
        </div>
    </section>
<?php include('inc/footer.php');
