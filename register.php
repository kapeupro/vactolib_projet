<?php
session_start();
require('inc/pdo.php');
require('inc/fonction.php');

verifUserAlreadyConnected();
$success=false;
$errors = [];
if(!empty($_POST['submitted'])) {
    // Faille xss
    $prenom    = cleanXss('prenom');
    $nom       = cleanXss('nom');
    $phone     = cleanXss('phone');
    $email     = cleanXss('email');
    $password  = cleanXss('password');
    $password2 = cleanXss('password2');

    // Validation
    $errors = mailValidation($errors,$email,'email');


    if(empty($errors['email'])) {
        $sql = "SELECT * FROM vactolib_user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['email'] = 'Vous avez déjà un compte avec cette adresse mail';
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
        $sql = "INSERT INTO `vactolib_user`(`nom`, `prenom`, `email`, `portable`, `password`, `token`,`status`, `created_at`) 
                VALUES (:nom,:prenom,:email,:phone,:password,:token,'user',NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':nom',        $nom,      PDO::PARAM_STR);
        $query->bindValue(':prenom',     $prenom,      PDO::PARAM_STR);
        $query->bindValue(':email',      $email,       PDO::PARAM_STR);
        $query->bindValue(':phone',      $phone,       PDO::PARAM_INT);
        $query->bindValue(':password',   $hashpassword,PDO::PARAM_STR);
        $query->bindValue(':token',      $token,       PDO::PARAM_STR);
        $query->execute();
        // redirection
        $success=true;
        header('refresh:5;url=index.php');
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/responsive.css">
</head>
<body>

<div class="logo">
    <a href="index.php"><img src="asset/img/logo_vactolib.png" alt="logo vactolib"></a>
</div>
<section id="register_form">
    <div class="img_float1"></div>
    <div class="img_float2"></div>
    <div class="img_float3"></div>
    <div class="wrap2">
        <?php if($success==false){ ?>
        <form action="" method="post" class="wrapform" novalidate>

            <div class="info_box">
                <label for="nom"></label>
                <input type="text" placeholder="Nom" id="nom" name="nom" value="<?=recupInputValue('nom');?>">
                <span class="error"><?= viewError($errors,'nom'); ?></span>
            </div>
            <div class="info_box">
                <label for="prenom"></label>
                <input type="text" placeholder="Prénom" id="prenom" name="prenom" value="<?=recupInputValue('prenom');?>">
                <span class="error"><?= viewError($errors,'prenom'); ?></span>
            </div>
            <div class="info_box">
                <label for="phone"></label>
                <input type="tel" placeholder="Numéro de téléphone" pattern="[0-9]{10}" maxlength="10" id="phone" name="phone" value="<?= recupInputValue('phone'); ?>">
                <span class="error"><?= viewError($errors,'phone'); ?></span>
            </div>

            <div class="info_box">
                <label for="email"></label>
                <input type="email" placeholder="Email*" id="email" name="email" value="<?= recupInputValue('email'); ?>">
                <span class="error"><?= viewError($errors,'email'); ?></span>
            </div>

            <div class="info_box">
                <label for="password"></label>
                <input type="password" placeholder="Mot de passe*" id="password" name="password" value="">
                <span class="error"><?= viewError($errors,'password'); ?></span>
            </div>
            <div class="info_box">
                <label for="password2"></label>
                <input type="password" placeholder="Confirmer Mot de passe*" id="password2" name="password2" value="">
            </div>

            <div class="info_box_button">
                <input type="submit" name="submitted" value="ENVOYER">
            </div>
            <p>Les champs avec * sont requis</p>
        </form>
        <?php } else {echo'<div class="info_box_success"><h2>Bienvenue ! Votre compte a bien été créé !</h2><h4>Redirection dans 5 secondes.</h4></div>';} ?>
    </div>
</section>


</body>
</html>