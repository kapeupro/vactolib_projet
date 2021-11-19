<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');


$errors = [];
if(!empty($_POST['submitted'])) {
    // Faille xss
    $email   = trim(strip_tags($_POST['email']));


    if(empty($errors['email'])) {
        $sql = "SELECT * FROM vactolib_user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(empty($verifPseudo)) {
            $errors['email'] = 'Aucune compte avec cet email ';
        }
    }
    if(count($errors) == 0) {
//        mail($_POST['email'], 'Reinitialisation de votre mot de passe', 'Si vous n\'êtes pas à l\'origine de cette demande, vous pouvez l\'ignorer. Veuillez cliquez sur ce lien pour choisir un nouveau mot de passe : lien/resetpassword?state=confirmed&token= ', 'From: vactolibsupport@gmail.com ');
        echo'Reception du lien qui emmène sur : <a href="missingpassword.php?token='.urldecode($verifPseudo['token']).'&mail='.urldecode($verifPseudo['email']).'">Cette page</a>';
    }
}
?>
    <link rel="stylesheet" href="asset/css/style.css">
    <div class="logo">
        <a href="index.php"><img src="asset/img/logo_vactolib.png" alt="logo vactolib"></a>
    </div>
    <section id="register_form">
        <div class="img_float1"></div>
        <div class="img_float2"></div>
        <div class="img_float3"></div>
        <div class="wrap2">
            <form action="" method="post" class="wrapform" novalidate>

                <div class="info_box">
                    <label for="email">Veuillez renseignez une adresse mail</label>
                    <input type="text" placeholder="Mail" id="email" name="email" value="<?= recupInputValue('email'); ?>">
                    <span class="error"><?= viewError($errors,'email'); ?></span>
                </div>

                <div class="info_box_button">
                    <input type="submit" name="submitted" value="ENVOYER">
                </div>

            </form>
        </div>
    </section>


<?php
