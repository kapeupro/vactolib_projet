<?php

session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
$id_session= $_SESSION['user']['id'];


//Recupère l'id singulier du vaccin à supprimer
$vaccin_id=$_GET['id'];
$vaccin_select = getVaccinById($vaccin_id);


//On récupère tous les vaccins de l'utilisateur
$user_vaccins=getUserVaccinsBySessionId($id_session);



if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    //select si la ligne existe
    $sql ="SELECT * FROM vactolib_user_vaccins WHERE vaccin_id= :vaccin_id AND user_id= :user_id";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':vaccin_id',$vaccin_id,PDO::PARAM_INT);
    $query ->bindValue(':user_id',$id_session,PDO::PARAM_INT);
    $verifVaccinExists = $query->execute();
        // si cela existe
            // DELETE table WHERE id = :id
    if (!empty($verifVaccinExists)){
        $sql ="DELETE FROM vactolib_user_vaccins WHERE vaccin_id= :id AND user_id= :user_id ";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$vaccin_id,PDO::PARAM_INT);
        $query ->bindValue(':user_id',$id_session,PDO::PARAM_INT);
        $query->execute();
        header('Location: moncarnet.php?page=1');
    } else{
        header("Location: 403.php");
        die();
    }
}
else {
   header("Location: 403.php");
    die();
}



