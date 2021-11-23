<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
require('vendor/autoload.php');

use JasonGrimes\Paginator;

$totalItems = 1000;
$itemsPerPage =2;
$currentPage = 1;
$urlPattern = 'Vactolib/moncarnet.php/page/(:num)';

$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

$id_session=$_SESSION['user']['id'];
$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);





$sqlleft = "SELECT vv.nom_vaccin, vv.laboratoire, vv.id ,vuv.vaccin_date
        FROM vactolib_user_vaccins AS vuv
        LEFT JOIN vactolib_vaccins AS vv
        ON vv.id = vuv.vaccin_id
        WHERE vuv.user_id = :id_session ORDER BY created_at DESC";
$query = $pdo->prepare($sqlleft);
$query->bindValue(':id_session',$id_session,PDO::PARAM_INT);
$query->execute();
$userVaccin = $query->fetchAll();
//debug($userVaccin);
//initialisation d'un compteur pour la boucle foreach
$i = 0;

include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <section>
        <div class="title-carnet">
            <h2>Mon Carnet</h2>
        </div>

        <?php if(empty($userVaccin)) { ?>
            <div class="carnet_vide">
                <p>Nous n'avons aucun vaccin à afficher ...</p>
                <a class="button_type2" href="ajouter.php">Ajouter un vaccin ?</a>
            </div>
        <?php } else { ?>

            <div id="carnet">
                <div class="wrap">
                    <div id="container-carnet">
                        <?php foreach ($user_vaccins as $user_vaccin){ ?>
                            <div class="items-carnet">
                                <h3>Vaccination <?php echo $userVaccin[$i]['nom_vaccin']; ?></h3>
                                <p> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom'] ?></p>
                                <p><?php echo $userVaccin[$i]['laboratoire'] ?> fait le <?php echo dateFormatWithoutHour($userVaccin[$i]['vaccin_date'], 'd/m/Y') ?></p>
                                <a class="button_type2" href="detail.php?id=<?php echo $userVaccin[$i]['id']; ?> "> En savoir plus </a>
                                <a class="button_type2" href="delete.php?id=<?php echo $userVaccin[$i]['id'] ?>"> Supprimer</a>
                            </div>
                            <?php $i++; } ?>
                    </div>
                </div>
            </div>

            <div class="ajout-vaccin">
                <a href="ajouter.php"><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
            </div>
            <?php echo $paginator ?>
        <?php } ?>


    </section>

<?php include('inc/footer.php');
