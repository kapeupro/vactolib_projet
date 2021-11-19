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

$_SESSION['user']=array(
    'id'=>$user['id'],
    'email'=>$user['email'],
    'nom'=>$user['nom'],
    'prenom'=>$user['prenom'],
    'tel'=>$user['portable'],
    'dateNaissance'=>$user['date_de_naissance']
);

/*Requete pour aller chercher tout les vaccins*/

$sql = "SELECT * FROM vactolib_vaccins";
$query = $pdo->prepare($sql);
$query->execute();
$vaccins= $query->fetchAll();

//debug($vaccins);

if(!empty($_POST['submitted'])) {
    // Faille xss
    $vaccin = cleanXss('vaccin');

    if (!empty($_POST["vaccin"]) and $_POST["vaccin"]!=''){


    }else{
        $errors['vaccin'] = "* Veuillez séléctionner un vaccin";
    }
}
debug($errors);

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
                    <option name="option" id="option" value="option"><?php echo $vaccin['nom_vaccin'] ?></option>
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
