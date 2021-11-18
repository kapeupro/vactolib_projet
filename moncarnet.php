<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];
debug($_SESSION);
$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_STR);
$query->execute();
$user= $query->fetch();
debug($user);

$_SESSION['user']=array(
    'id'=>$user['id'],
    'email'=>$user['email'],
    'nom'=>$user['nom'],
    'prenom'=>$user['prenom'],
    'tel'=>$user['portable'],
    'dateNaissance'=>$user['date_de_naissance']
);
include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">
<section>
    <div class="title-carnet">
        <h2>Mon Carnet</h2>
    </div>
    <div id="carnet">
        <div class="wrap">
            <div id="container-carnet">
                <div class="items-carnet">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet"> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom']  ?></p>
                        <p class="naissance">Né le  <?php echo $_SESSION['user']['dateNaissance']?></p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
                <div class="items-carnet">
                    <div class="items-carnet">
                        <h3>Nom du Certificat</h3>
                        <p class="nom-carnet"> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom'] ?></p>
                        <p class="naissance">Né le  <?php echo $_SESSION['user']['dateNaissance']?></p>
                        <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                    </div>
                </div>
                <div class="items-carnet">
                    <h3>Nom du Certificat</h3>
                    <p class="nom-carnet"> <?php echo $_SESSION['user']['nom'];echo' ';echo $_SESSION['user']['prenom']  ?></p>
                    <p class="naissance">Né le  <?php echo $_SESSION['user']['dateNaissance']?></p>
                    <p class="date-vaccin"> Vaccin, le xx/xx/xx</p>
                </div>
            </div>
        </div>
    </div>
    <div class="ajout-vaccin">
            <a href=""><img src="asset/img/cta-ajout.svg">Ajouter un vaccin</a>
    </div>
</section>

<?php include('inc/footer.php');
