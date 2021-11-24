<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
$id_session=$_SESSION['user']['id'];

/*Recupere l'id du vaccin selectionné*/
$vaccin_select = getVaccinById($_GET['id']);
//debug($vaccin_select);

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);


include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">


    <section id="vaccin_detail">
        <div class="wrap">
            <div class="vaccin_info">
                <h2><?php echo $vaccin_select['nom_vaccin']; ?></h2>
                <p>Laboratoire : <?php echo $vaccin_select['laboratoire'] ?></p>
            </div>

            <div class="vaccin_description">
                <p><?php echo $vaccin_select['description'] ?></p>
            </div>
        </div>
    </section>


<?php include('inc/footer.php');