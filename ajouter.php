<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');


$id_session=$_SESSION['user']['id'];
$vaccin_id=$_POST;
debug($_POST);
debug($vaccin_id);
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

if(!empty($_POST['submitted'])) {
    // Faille xss
    $vaccin = cleanXss('vaccin');
//    $date   = cleanXss('date');
    if (!empty($_POST["vaccin"]) and $_POST["vaccin"]!=''){
        $success=true;
    }else{
        $errors['vaccin'] = "* Veuillez séléctionner un vaccin";
    }

    $sql = "INSERT INTO `vactolib_user_vaccins`(`user_id`, `vaccin_id`, `created_at` ) 
    VALUES (:user_id,:vaccin_id, NOW() )";
    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id',$id_session,PDO::PARAM_STR);
    $query->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
    $query->execute();
    $user_vaccins= $query->fetch();
    debug($user_vaccins);
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
                        <option value="<?php echo $vaccin['id'] ?> "><?php echo $vaccin['nom_vaccin'] ?></option>
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
