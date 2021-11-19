<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');


$id_vaccin = $_POST;
$id_session=$_SESSION['user']['id'];
$errors=[];

$sql = "SELECT * FROM vactolib_user WHERE id=:id ";
$query = $pdo->prepare($sql);
$query->bindValue(':id',$id_session,PDO::PARAM_INT);
$query->execute();
$user= $query->fetch();

/*Requete pour aller chercher tout les vaccins*/

$sql = "SELECT * FROM vactolib_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$vaccins= $query->fetchAll();

debug($vaccins);

if(!empty($_POST['submitted'])) {

    $sql = "INSERT INTO vactolib_user_vaccins (user_id, vaccin_id) 
            VALUES (:user_id,:vaccin_id)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id',$id_session,PDO::PARAM_INT);
    $query->bindValue(':vaccin_id', $id_vaccin,PDO::PARAM_INT);
    $query->execute();
    debug($_POST);
}

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
                    <option value="<?php echo $vaccin['id'] ?>"><?php echo $vaccin['nom_vaccin'] ?></option>
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
