<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];
$errors=[];
debug($_POST);

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
    $vaccin_date = cleanXss('vaccin_date');
    $vaccin_id= $_POST['vaccin'];

    if (empty($_POST['vaccin']) && !empty($_POST['vaccin_date'])){
        $errors['vaccin'] = "* Veuillez séléctionner tout les champs";
    }


    if(count($errors) == 0){
        $sql = "INSERT INTO `vactolib_user_vaccins`(`user_id`, `vaccin_id`, `vaccin_date` ,`created_at` ) 
    VALUES (:user_id,:vaccin_id, :vaccin_date ,NOW() )";
        $query = $pdo->prepare($sql);
        $query->bindValue(':user_id',$id_session,PDO::PARAM_INT);
        $query->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
        $query->bindValue(':vaccin_date',$vaccin_date,PDO::PARAM_INT);
        $query->execute();
        $user_vaccins= $query->fetch();
    }
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

                <label for="date">Date de l'injection :</label>
                <input type="date" name="vaccin_date">
                <span class="error"><?php viewError($errors, 'vaccin_date'); ?></span>

                <div class="error_box">
                    <input class="button_type1" type="submit" name="submitted" id="submitted" value="Ajouter">
                    <span class="error"><?php viewError($errors, 'vaccin'); ?></span>
                </div>
            </form>
            <?php if(!empty($_POST['vaccin']) && !empty($_POST['vaccin_date'])){ ?>
            <div class="success_message" style="text-align:center;color:lightgreen">
                <h2>Votre vaccin à bien été ajouté à votre carnet</h2>
            </div>
           <?php } else{echo $errors['vaccin']="Renseigner les champs"; } ?>
        </div>
    </section>

<?php include('inc/footer.php');
