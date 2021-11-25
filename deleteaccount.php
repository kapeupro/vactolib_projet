<?php
session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();


$id_session=$_SESSION['user']['id'];
$user=getUserBySessionId($id_session);
debug($id_session);
debug($user);

if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $sql ="SELECT * FROM vactolib_user WHERE id= :user_id";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':user_id',$id_session,PDO::PARAM_INT);
    $verifUserExists = $query->execute();
    debug($verifUserExists);

    if (!empty($verifUserExists)){
        $sql ="DELETE FROM vactolib_user WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$id_session,PDO::PARAM_INT);
        $query->execute();
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    } else{
        die('ERREUR 1');
    }
}
else {
//    header("Location: 404.php");
}