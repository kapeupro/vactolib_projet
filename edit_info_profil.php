<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$sql = "SELECT * FROM vactolib_user";
$query = $pdo->prepare($sql);
$query->execute();
$user= $query->fetch();

$_SESSION['user']=array(
    'email'=>$user['email'],
    'nom'=>$user['nom'],
    'prenom'=>$user['prenom'],
    'tel'=>$user['portable'],
    'dateNaissance'=>$user['date_de_naissance']
);
//debug($_SESSION['user']);

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
                    </div>

                    <div class="info_list">
                        <form action="" method="post">
                            <div class="form_box_modif">
                                <label for="email">Mail :</label>
                                <input type="text" name="email" id="email" value="<?= recupInputValue('email');?>" >
                            </div>

                            <div class="form_box_modif">
                                <label for="password">Ancien mot de passe :</label>
                                <input type="password" name="password" id="password" value="">
                            </div>

                            <div class="form_box_modif">
                                <label for="password">Nouveau mot de passe :</label>
                                <input type="password" name="password" id="password">
                            </div>

                            <div class="form_box_modif">
                                <label for="dateNaissance">Date de naissance</label>
                                <input type="date" name="dateNaissance" id="dateNaissance" value="<?= recupInputValue('dateNaissance');?>">
                            </div>

                            <div class="form_box_modif">
                                <label for="tel">Téléphone :</label>
                                <input type="number" name="tel" id="tel" value="<?= recupInputValue('tel');?>">
                            </div>
                        </form>
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