<?php

session_start();

require('inc/pdo.php');
require('inc/fonction.php');
require('inc/request.php');
verifUserConnected();
$id_session= $_SESSION['user']['id'];
//debug($id_session);

//Recupère l'id singulier du vaccin à supprimer
$vaccin_id=$_GET['id'];
$vaccin_select = getVaccinById($vaccin_id);
//debug($vaccin_select);

//On récupère tous les vaccins de l'utilisateur
$user_vaccins=getUserVaccinsBySessionId($id_session);
//debug($user_vaccins);


if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    //select si la ligne existe
    $sql ="SELECT * FROM vactolib_user_vaccins WHERE vaccin_id= :id";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':id',$vaccin_id,PDO::PARAM_INT);
    $verifVaccinExists = $query->execute();
        // si cela existe
            // DELETE table WHERE id = :id
    if (!empty($verifVaccinExists)){
        $sql ="DELETE FROM vactolib_user_vaccins WHERE vaccin_id= :id";
        $query = $pdo->prepare($sql);
        $query ->bindValue(':id',$vaccin_id,PDO::PARAM_INT);
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



