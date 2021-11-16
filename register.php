<?php

require('inc/pdo.php');
require('inc/fonction.php');


$errors = [];
if(!empty($_POST['submitted'])) {
    // Faille xss
    $pseudo    = cleanXss('pseudo');
    $email     = cleanXss('email');
    $password  = cleanXss('password');
    $password2 = cleanXss('password2');
    // Validation
    $errors = textValidation($errors,$pseudo,'pseudo',3, 50);

    if(empty($errors['pseudo'])) {
        $sql = "SELECT * FROM vactolib_user WHERE pseudo = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['pseudo'] = 'Pseudo existe dèjà';
        }
    }
    $errors = mailValidation($errors,$email,'email');
    if(empty($errors['email'])) {
        $sql = "SELECT * FROM vactolib_user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifEmail = $query->fetch();
        if(!empty($verifEmail)) {
            $errors['email'] = 'Email existe dèjà';
        }
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
        // generate token
        $token = generateRandomString(100);
        // hashpassword
        $hashpassword = password_hash($password,PASSWORD_DEFAULT);
        // INSERT INTO
        $sql = "INSERT INTO vactolib_user (pseudo,email,password,token,created_at,role)
                VALUES (:pseudo,:email,:password,:token,NOW(),'user')";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo',  $pseudo,      PDO::PARAM_STR);
        $query->bindValue(':email',   $email,       PDO::PARAM_STR);
        $query->bindValue(':password',$hashpassword,PDO::PARAM_STR);
        $query->bindValue(':token',   $token,       PDO::PARAM_STR);
        $query->execute();
        // redirection
        header('Location: index.php');
    }
}
?>
<link rel="stylesheet" href="asset/css/style.css">


    <a href="index.php"><img src="asset/img/logo_vactolib.png" alt="logo vactolib"></a>

<section id="register_form">
    <div class="wrap">
        <form action="" method="post" class="wrapform" novalidate>
            <div class="info_box">
                <label for="pseudo"></label>
                <input type="text" placeholder="Nom" id="pseudo" name="pseudo" value="<?=recupInputValue('pseudo');?>">
                <span class="error"><?= viewError($errors,'pseudo'); ?></span>
            </div>
            <div class="info_box">
                <label for="email"></label>
                <input type="email" placeholder="Email" id="email" name="email" value="<?= recupInputValue('email'); ?>">
                <span class="error"><?= viewError($errors,'email'); ?></span>
            </div>
            <div class="info_box">
                <label for="password"></label>
                <input type="password" placeholder="Mot de passe" id="password" name="password" value="">
                <span class="error"><?= viewError($errors,'password'); ?></span>
            </div>
            <div class="info_box">
                <label for="password2"></label>
                <input type="password" placeholder="Confirmer Mot de passe" id="password2" name="password2" value="">
            </div>

            <div class="info_box_button">
                <input type="submit" name="submitted" value="ENVOYER">
            </div>
        </form>
    </div>
</section>