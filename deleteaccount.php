<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();

debug($_SESSION);
$id_session=$_SESSION['user']['id'];

$user=getUserBySessionId($id_session);
debug($user);

if(!empty($_GET['id']) && is_numeric($_GET['id'])){

    if (!empty($user)){
        $sql ="DELETE FROM vactolib_user WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$id_session,PDO::PARAM_INT);
        $query->execute();
        header('Location: index.php');
    } else{
        die('ERREUR 1');
    }
}
else {
//    header("Location: 404.php");
}