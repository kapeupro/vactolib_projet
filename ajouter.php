<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');


$id_session=$_SESSION['user']['id'];
$errors=[];

$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_STR);
$query->execute();
$user= $query->fetch();

/*Requete pour aller chercher tout les vaccins*/

$sql = "SELECT * FROM vactolib_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$vaccins= $query->fetchAll();

debug($vaccins);

if(!empty($_POST['submitted'])) {


}
//    // Faille xss
//    $vaccin = cleanXss('option');
//
//    if(!empty($_POST['option']) and $_POST['option']!= Null){
//        debug($vaccin);
//
//        $sql = "INSERT INTO vactolib_user_vaccins (user_id, vaccin_id, created_at)
//            VALUES (:id_user,:id_vaccin,NOW())";
//        $query = $pdo->prepare($sql);
//        $query->bindValue(':id_user',$id_session,PDO::PARAM_INT);
//        $query->bindValue(':id_vaccin',$vaccin['id'],PDO::PARAM_INT);
//        $query->execute();
//
//    }else{
//        $errors['vaccin'] = "Veuillez séléctionner un vaccin";
//    }
//}
////debug($_POST['option']);

include('inc/header.php');
?>
    <link rel="stylesheet" href="asset/css/style_user.css">

<section id="ajout_vaccin">
    <div class="wrap">
        <h1>Ajout d'un vaccin</h1>

        <form action="" method="post">
            <select name="vaccin" id="vaccin">
                <option value="">Selectionner un vaccin</option>
                <?php
                foreach($vaccins as $vaccin){ ?>
                    <option name="option" id="option" value="option"> <?php echo $vaccin['nom_vaccin'] ?></option>
                <?php } ?>
            </select>

            <div class="error_box">
                <input class="button_type1" type="submit" name="submitted" id="submitted" value="Ajouter">
                <span class="error"><?php viewError($errors, 'vaccin'); ?></span>
            </div>
        </form>
    </div>
</section>








<?php include('inc/footer.php');
