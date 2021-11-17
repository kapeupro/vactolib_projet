<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

include('inc/header.php'); ?>
<link rel="stylesheet" href="asset/css/style_user.css">

<section id="profil_container">
    <div class="wrap">
        <div class="info_profil">
            <div class="icon_profil">
                <img src="asset/img/icon_profil.svg" alt="icone de profil">
                <h2>Nom Prenom</h2>
            </div>

            <div class="box_items">
                <div class="title_item">
                    <h3>Informations :</h3>
                    <a class="button_type2" href="#">edit</a>
                </div>

                <div class="info_list">
                    <ul>
                        <li>Adresse : </li>
                        <li>Code postal : </li>
                        <li>Ville : </li>
                        <li>Date de naissance : </li>
                        <li>Lieu de naissance : </li>
                    </ul>

                    <ul>
                        <li>Mot de passe : </li>
                        <li>Mail : </li>
                        <li>Tél : </li>
                        <li>Nationalité : </li>
                        <li>Sexe : </li>
                    </ul>
                </div>
            </div>

            <div class="box_items">
                <div class="title_item">
                    <h3>Mes rendez-vous :</h3>
                    <a class="button_type2" href="#">edit</a>
                </div>

                <div class="info_rdv">
                    <ul>
                        <li>Prochains rendez-vous : </li>
                        <li>Dernier rendez-vous : </li>
                        <li>Médecin traitant : </li>
                        <li>Rappel : </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="illustration_profil">
            <div class="img_profil">
                <img src="asset/img/illustration_profil.svg" alt="Homme avec un ordinateur dans les mains">
            </div>

            <div class="button_type1">
                <a href="#">Mon carnet</a>
            </div>

        </div>
    </div>
</section>

<?php
include('inc/footer.php'); ?>