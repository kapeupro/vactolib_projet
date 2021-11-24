<?php

require('inc/pdo.php');
require('inc/fonction.php');
$success=false;
$token=urldecode($_GET['token']);
//debug($token);
//
//debug(($_GET));
$errors = [];
if(!empty($_POST['submitted'])) {
    // Faille xss
    $password  = cleanXss('password');
    $password2 = cleanXss('password2');

    // Validation

    if(empty($errors['email'])) {
        $sql = "SELECT * FROM vactolib_user WHERE token=:token ";
        $query = $pdo->prepare($sql);
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();
    }
    // password
    if(!empty($password) || !empty($password2)) {
        if($password != $password2) {
            $errors['password'] = 'Veuillez renseigner des mot de passe identiques';
        } elseif (mb_strlen($password2) < 6) {
            $errors['password'] = 'Min 6 caractères pour votre mot de passe';
        }
    } else {
        $errors['password'] = 'Veuillez renseigner un mot de passe';
    }
    if(count($errors) == 0) {
        // hashpassword
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);
        // INSERT INTO
        $sql = "UPDATE `vactolib_user` SET `password`=:password WHERE token=:token";
        $query = $pdo->prepare($sql);
        $query->bindValue(':password',$hashpassword,PDO::PARAM_STR);
        $query->bindValue(':token',$token,PDO::PARAM_STR);
        $query->execute();
        // redirection
        $success=true;
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
        <?php if($success==true) { ?>
            <div class="info_box">
                <h2>Mot de passe mis à jour avec succès</h2>
                <a href="index.php">Retour à l'acceuil</a>
            </div>
        <?php  } else { ?>
            <form action="" method="post" class="wrapform" novalidate>

                <div class="info_box">
                    <label for="password"></label>
                    <input type="password" placeholder="Nouveau mot de passe" id="password" name="password" value="">
                    <span class="error"><?= viewError($errors,'password'); ?></span>
                </div>
                <div class="info_box">
                    <label for="password2"></label>
                    <input type="password" placeholder="Confirmer Mot de passe" id="password2" name="password2" value="">
                </div>

                <div class="info_box_button">
                    <input type="submit" name="submitted" value="ENVOYER">
                </div>
                <p>Les champs avec * sont requis</p>
            </form>
        <?php  }?>
    </div>
</section>