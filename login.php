<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserAlreadyConnected();

$errors = [];
if(!empty($_POST['submitted'])) {
    // Faille xss
    $login   = trim(strip_tags($_POST['login']));
    $password  = trim(strip_tags($_POST['password']));

    $sql = "SELECT * FROM vactolib_user WHERE email = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    $user= $query->fetch();
//    debug($user);
    if(empty($user)) {
        $errors['login'] = 'Email invalide';
    } else {
        if (password_verify($password , $user['password'] )==true){
            $_SESSION['user']=array(
                'id'    =>$user['id'],
                'email' =>$user['email'],
                'status'=>$user['status'],
                'ip'     =>$_SERVER['REMOTE_ADDR'],//::1
            );
        }else {
            $errors['password'] = 'Mot de passe incorrect';
        }
    }
    if(count($errors) == 0) {
        header('Location: index.php');
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
    <title>Connexion</title>

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
        <form action="" method="post" class="wrapform" novalidate>

            <div class="info_box">
                <label for="login"></label>
                <input type="text" placeholder="Mail" id="login" name="login" value="<?= recupInputValue('login'); ?>">
                <span class="error"><?= viewError($errors,'login'); ?></span>
            </div>

            <div class="info_box">
                <label for="password"></label>
                <input type="password" placeholder="Mot de passe" id="password" name="password" value="">
                <span class="error"><?= viewError($errors,'password'); ?></span>
            </div>

            <div class="info_box_button">
                <input type="submit" name="submitted" value="SE CONNECTER">
            </div>
            <div>
                <?php  echo'<a href="mailmissingpassword.php">Mot de passe oublié ?</a>'?>
            </div>

        </form>
    </div>
</section>

</body>
</html>


