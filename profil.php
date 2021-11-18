<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];

$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_STR);
$query->execute();
$user= $query->fetch();

//debug($user);

$_SESSION['user']=array(
    'id'=>$user['id'],
    'email'=>$user['email'],
    'nom'=>$user['nom'],
    'prenom'=>$user['prenom'],
    'tel'=>$user['portable'],
    'dateNaissance'=>$user['date_de_naissance']
);

//debug($_SESSION);
include('inc/header.php'); ?>
<link rel="stylesheet" href="asset/css/style_user.css">

<section id="profil_container">
    <div class="wrap">
        <div class="info_profil">
            <div class="icon_profil">
                <img src="asset/img/icon_profil.svg" alt="icone de profil">
                <h2><?php echo $_SESSION['user']['nom'] .' '. $_SESSION['user']['prenom'] ?></h2>
            </div>

            <div class="box_items">
                <div class="title_item">
                    <h3>Informations :</h3>
                    <a class="button_type2" href="edit_info_profil.php">edit</a>
                </div>

                <div class="info_list">
                    <ul>
                        <li>Mail : <?php echo $_SESSION['user']['email'] ?></li>
                        <li>Mot de passe : ******</li>
                        <li>Date de naissance : <?php if(empty($_SESSION['user']['dateNaissance'])){echo "Non renseigné";}else{echo $_SESSION['user']['dateNaissance'];} ?></li>
                        <li>Tél : <?php if(empty($_SESSION['user']['tel'])){echo "Non renseigné";}else{echo $_SESSION['user']['tel'];} ?></li>
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
                <a href="moncarnet.php">Mon carnet</a>
            </div>

        </div>
    </div>
</section>

<?php
include('inc/footer.php'); ?>