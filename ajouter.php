<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];

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

debug($vaccins);


include('inc/header.php');
?>
    <link rel="stylesheet" href="asset/css/style_user.css">

<section id="ajout_vaccin">
    <div class="wrap">
        <h1>Ajout d'un vaccin</h1>

        <form action="" method="post">
            <label for="vaccin">Selectionner un vaccin :</label>

            <select name="vaccin" id="vaccin">
                <option value="">Selectionner</option>
                <?php
                foreach($vaccins as $vaccin){ ?>
                    <option value=""><?php echo $vaccin['nom_vaccin'] ?></option>
                <?php } ?>
            </select>

            <input type="submit" name="submitted" id="submitted" value="Ajouter">
        </form>
    </div>
</section>








<?php include('inc/footer.php');
