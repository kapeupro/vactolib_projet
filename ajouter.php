<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();

$success=false;
$id_session=$_SESSION['user']['id'];
$errors=[];

$user= getUserById($id_session);

/*Requete pour aller chercher tout les vaccins*/
$vaccins=recupVaccins();


if(!empty($_POST['submitted'])) {
    // Faille xss
    $vaccin = cleanXss('vaccin');
    $vaccin_id= cleanXss('vaccin');
    $vaccin_date= cleanXss('vaccin_date');



    if(!empty($_POST['vaccin'])){
    }else{
        $errors['vaccin'] = "* Veuillez séléctionner un vaccin";
    }
    if(!empty($_POST['vaccin_date'])){
    }else{
        $errors['vaccin_date'] = "* Veuillez renseigner une date";
    }


    if(empty($errors['vaccin'])) {
        $sql = "SELECT * FROM vactolib_user_vaccins WHERE vaccin_id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id',$vaccin_id,PDO::PARAM_STR);
        $query->execute();
        $verifPseudo = $query->fetch();
        if(!empty($verifPseudo)) {
            $errors['vaccin'] = 'Vous avez déjà ajouté ce vaccin à votre carnet';
        }
    }

    if(count($errors) == 0){
        $vaccin_rappel=getRappelDuree($vaccin_id)['rappel'];
        $sql = "INSERT INTO `vactolib_user_vaccins`(`user_id`, `vaccin_id`, `vaccin_date`,`vaccin_rappel` ,`created_at` ) 
    VALUES (:user_id,:vaccin_id, :vaccin_date,:vaccin_rappel ,NOW() )";
        $query = $pdo->prepare($sql);
        $query->bindValue(':user_id',$id_session,PDO::PARAM_INT);
        $query->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
        $query->bindValue(':vaccin_date',$vaccin_date,PDO::PARAM_STR);
        $query->bindValue(':vaccin_rappel',$vaccin_rappel,PDO::PARAM_INT);

        $query->execute();
        $user_vaccins= $query->fetch();
        $success=true;
    }
}

include('inc/header.php');
?>
    <link rel="stylesheet" href="asset/css/style_user.css">

    <section id="ajout_vaccin">
        <div class="wrap">
            <?php if($success==true){ ?>
                <div class="success_message" style="text-align:center;color:lightgreen;padding-bottom:2rem;">
                    <h2>Votre vaccin à bien été ajouté à votre carnet</h2>
                </div>
            <?php } else{} ?>

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
                    <span class="error"><?php viewError($errors, 'vaccin'); ?></span>
                </div>

                <label for="vaccin_date">Date de l'injection :</label>
                <input type="date" name="vaccin_date">

                <div class="error_box">
                    <span class="error"><?php viewError($errors, 'vaccin_date'); ?></span>
                </div>

                <input class="button_type1" type="submit" name="submitted" id="submitted" value="Ajouter">
            </form>
        </div>
    </section>

<?php include('inc/footer.php');