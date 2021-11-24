<?php

session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $vaccin = getVaccinById($id);

    if (!empty($vaccin)){
        $sql = "DELETE FROM vactolib_vaccins WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query ->execute();
        header('Location: basic-table.php');
    }else{
        header("Location: 404.php");
        die();
    }
}