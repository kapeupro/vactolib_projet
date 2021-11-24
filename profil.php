<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
    debug($_SESSION);
$id_session=$_SESSION['user']['id'];

$user= getUserBySessionId($id_session);

$sqlleft = "SELECT vv.nom_vaccin, vv.laboratoire, vv.id ,vuv.created_at
        FROM vactolib_user_vaccins AS vuv
        LEFT JOIN vactolib_vaccins AS vv
        ON vv.id = vuv.vaccin_id
        WHERE vuv.user_id = :id_session ORDER BY created_at DESC";
$query = $pdo->prepare($sqlleft);
$query->bindValue(':id_session',$id_session,PDO::PARAM_INT);
$query->execute();
$userVaccin = $query->fetch();


include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">

    <section id="profil_container">
        <div class="wrap">
            <div class="info_profil">
                <div class="icon_profil">
                    <img src="asset/img/user_icon.svg" alt="icone de profil">
                    <h2><?php echo $user['nom'] .' '. $user['prenom'] ?></h2>
                </div>

                <div class="box_items">
                    <div class="title_item">
                        <h3>Informations :</h3>
                        <a class="button_type2" href="edit_info_profil.php">edit</a>
                    </div>

                    <div class="info_list">
                        <ul>
                            <li>Mail : <?php echo $user['email'] ?></li>
                            <li>Mot de passe : ******</li>
                            <li>Date de naissance : <?php if(empty($user['date_de_naissance'])){echo "Non renseigné";}else{echo $user['date_de_naissance'];} ?></li>
                            <li>Tél : +33 <?php if(empty($user['portable'])){echo "Non renseigné";}else{echo $user['portable'];} ?></li>
                        </ul>
                    </div>
                </div>

                <div class="box_items">
                    <div class="title_item">
                        <h3>Mes rendez-vous :</h3>
                    </div>

                    <div class="info_rdv">
                        <ul>
                            <li>Dernier vaccin : <?php if(!empty($userVaccin)) {echo $userVaccin['nom_vaccin'];} else{ echo'Aucun vaccin n\'a été enregistré'; } ?></li>
                            <?php if (!empty($userVaccin)){ ?>
                            <li>Ajouté le : <?php if(!empty($userVaccin)) { echo dateFormatWithoutHour($userVaccin['created_at']); } ?> </li>
                            <li>Rappel le : </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="illustration_profil">
                <div class="img_profil">
                    <img src="asset/img/illustration_profil.svg" alt="Homme avec un ordinateur dans les mains">
                </div>

                <div class="button_type1">
                    <a href="moncarnet.php?page=1">Mon carnet</a>
                </div>
            </div>
        </div>
    </section>

<?php
include('inc/footer.php');