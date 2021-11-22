<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');

$id_session=$_SESSION['user']['id'];

/*Recupere l'id du vaccin selectionné*/
$vaccin_select = getVaccinById($_GET['id']);
debug($vaccin_select);

$user=getUserBySessionId($id_session);
$user_vaccins=getUserVaccinsBySessionId($id_session);

if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $id=$_GET['id'];
    if (!empty($user_vaccins)){
        $sql =""
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