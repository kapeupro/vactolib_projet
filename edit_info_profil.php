<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
$id_session=$_SESSION['user']['id'];
$errors = [];

$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_STR);
$query->execute();
$user= $query->fetch();
debug($user);

if(!empty($_POST['submitted'])) {
    // Faille xss
    $email = cleanXss ('email');
    $password = cleanXss ('password');
    $password2 = cleanXss ('password2');
    $date_de_naissance = cleanXss ('date_de_naissance');
    $portable = cleanXss ('portable');

    $errors = mailValidation($errors, $email,'email');
    $errors = phoneNumberValidation($errors, $portable, 'portable');

    if(!empty($_POST['password2'])){
        if(empty($_POST['password'])){
            $errors['password'] = "Vous devez entrer votre ancien mot de passe";
        }
        if(!empty($_POST['password'])){
            if(!password_verify($password, $user['password'])){
                $errors['password'] = "Mot de passe incorrect";
            }
        }
        if(mb_strlen($password2) < 6){
            $errors['password2'] = 'Min 6 caractères pour votre mot de passe';
        }
    }

    if(empty($errors['email'])) {
        $sql = "SELECT * FROM vactolib_user WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            if ($verifPseudo['email']!==$user['email'])
            $errors['email'] = 'Un compte existe déjà sur cette adresse email';
        }
    }
debug($verifPseudo);
    if(count($errors) == 0){
        $hashpassword = password_hash($password2,PASSWORD_DEFAULT);

        $sql = "UPDATE vactolib_user
                SET email = :email, password = :password, date_de_naissance = :date_de_naissance, portable = :portable
                WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email,PDO::PARAM_STR);
        $query->bindValue(':date_de_naissance',$date_de_naissance,PDO::PARAM_INT);
        $query->bindValue(':portable',$portable,PDO::PARAM_INT);
        $query->bindValue(':password',$hashpassword,PDO::PARAM_STR);
        $query->bindValue(':id', $user['id'], PDO::PARAM_INT);
        $query->execute();
        header('Location: profil.php');
    }
}

include('inc/header.php'); ?>
    <link rel="stylesheet" href="asset/css/style_user.css">

    <section id="profil_container">
        <div class="wrap">
            <div class="info_profil">
                <div class="icon_profil">
                    <img src="asset/img/user_icon.svg" alt="icone de profil">
                    <h2><?php echo $user['nom'] .' '. $user['prenom'] ?></h2>
                </div>

                <div class="box_items">
                    <div class="title_item">
                        <h3>Informations :</h3>
                    </div>

                    <div class="info_list">
                        <form action="" method="post">
                            <div class="form_box_modif">
                                <div class="form_box_input">
                                    <label for="email">Mail :</label>
                                    <input type="text" name="email" id="email" value="<?=$user['email']; ?>">
                                </div>

                                <div class="error_box">
                                    <span class="error"><?= viewError($errors,'email'); ?></span>
                                </div>
                            </div>

                            <div class="form_box_modif">
                                <div class="form_box_input">
                                    <label for="password">Ancien mot de passe :</label>
                                    <input type="password" name="password" id="password" value="">
                                </div>
                                <div class="error_box">
                                    <span class="error"><?= viewError($errors,'password'); ?></span>
                                </div>
                            </div>

                            <div class="form_box_modif">
                                <div class="form_box_input">
                                    <label for="password">Nouveau mot de passe :</label>
                                    <input type="password" name="password2" id="password2">
                                </div>
                                <div class="error_box">
                                    <span class="error"><?= viewError($errors,'password2'); ?></span>
                                </div>
                            </div>

                            <div class="form_box_modif">
                                <div class="form_box_input">
                                    <label for="date_de_naissance">Date de naissance</label>
                                    <input type="date" name="date_de_naissance" id="date_de_naissance" value="<?= $user['date_de_naissance'] ;?>">
                                </div>
                                <div class="error_box">
                                    <span class="error"><?= viewError($errors,'date_de_naissance'); ?></span>
                                </div>
                            </div>

                            <div class="form_box_modif">
                                <div class="form_box_input">
                                    <label for="portable">Téléphone :</label>
                                    <input type="number" name="portable" id="portable" value="<?= $user['portable'] ;?>">
                                </div>
                                <div class="error_box">
                                    <span class="error"><?= viewError($errors,'portable'); ?></span>
                                </div>
                            </div>

                            <div class="form_box_modif">
                                <input type="submit" name="submitted" id="submitted" value="Modifier">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="illustration_profil">
                <div class="img_profil">
                    <img src="asset/img/illustration_profil.svg" alt="Homme avec un ordinateur dans les mains">
                </div>

                <div class="button_type1">
                    <a href="moncarnet.php?page=1">Mon carnet</a>
                </div>

            </div>
        </div>
    </section>

<?php
include('inc/footer.php'); ?>