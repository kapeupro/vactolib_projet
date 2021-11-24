<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
$id_session=$_SESSION['user']['id'];

/*Recupere l'id du vaccin selectionné*/
$vaccin_select = getVaccinById($_GET['id']);
debug($vaccin_select);

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);
debug($user_vaccins);
if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $id=$_GET['id'];
    debug($id);

    // request pour verifier que cela existe dans la table
    //select si la ligne existe
    $sql ="SELECT * FROM vactolib_user_vaccins WHERE id= :id";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':id',$id,PDO::PARAM_INT);
    $verifVaccinExists = $query->execute();
        // si cela existe

            // DELETE tbale WHERE id = :id
    if (!empty($verifVaccinExists)){
        $sql ="DELETE FROM vactolib_user_vaccins WHERE id= :id";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
//        header('Location: moncarnet.php');
        echo'<a href="moncarnet.php"> OUI LE LIEN </a>';
    } else{
        die('ERREUR 1');
    }
}
else {
    die('404');
}