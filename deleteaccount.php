<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
debug($_SESSION);
$id_session=$_SESSION['user']['id'];
debug($id_session);
$user=getUserBySessionId($id_session);
debug($user);


if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $id=$_GET['id'];
    debug($id);
    if (!empty($user_vaccins)){
        $sql ="DELETE FROM vactolib_user WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$id,PDO::PARAM_INT);
        $query->execute();
//        header('Location: moncarnet.php');
    } else{
        die('ERREUR 1');
    }
}
else {
    die('404');
}