<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);

$sqlleft = "SELECT vv.nom_vaccin, vuv.id
        FROM vactolib_user_vaccins AS vuv
        LEFT JOIN vactolib_vaccins AS vv
        ON vv.id = vuv.vaccin_id
        WHERE vuv.user_id = :id_session";
$query = $pdo->prepare($sqlleft);
$query->bindValue(':id_session',$id_session,PDO::PARAM_INT);
$query->execute();
$userVaccin = $query->fetchAll();

$i = 0;
debug($userVaccin);

include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
<section>
    <div class="title-carnet">
        <h2>Mon Carnet</h2>
    </div>
    <div id="carnet">
        <div class="wrap">
            <div id="container-carnet">
                <?php foreach ($user_vaccins as $user_vaccin){ ?>
                <div class="items-carnet">
                        <h3>Vaccination <?php echo $userVaccin[$i]['nom_vaccin']; ?></h3>
                        <p class="nom-carnet"> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom'] ?></p>
                        <p class="naissance">Né le  <?php echo $_SESSION['user']['dateNaissance']?></p>
                        <p class="date-vaccin"> <?php echo $userVaccin[$i]['nom_vaccin']; ?>, le xx/xx/xx</p>
                </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>
    <div class="ajout-vaccin">
            <a href="ajouter.php"><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
    </div>
</section>

<?php include('inc/footer.php');
