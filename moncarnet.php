<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];
debug($_SESSION);

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);
debug($user);
debug($user_vaccins);

$_SESSION['user']=array(
    'id'=>$user['id'],
    'email'=>$user['email'],
    'nom'=>$user['nom'],
    'prenom'=>$user['prenom'],
    'tel'=>$user['portable'],
    'dateNaissance'=>$user['date_de_naissance']
)



;
include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
<section>
    <div class="title-carnet">
        <h2>Mon Carnet</h2>
    </div>
    <div id="carnet">
        <div class="wrap">
            <div id="container-carnet">
                <?php foreach ($user_vaccins as $user_vaccin) { ?>
                <div class="items-carnet">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet"> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom']  ?></p>
                        <p class="naissance">Né le  <?php echo $_SESSION['user']['dateNaissance']?></p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="ajout-vaccin">
            <a href="ajouter.php"><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
    </div>
</section>

<?php include('inc/footer.php');
