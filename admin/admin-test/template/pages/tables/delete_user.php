<?php
session_start();
require('../../../../../inc/pdo.php');
require('../../../../../inc/fonction.php');
require('../../../../../inc/request.php');

if(!empty($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    $user = getUserById($id);

    if (!empty($user)){
        $sql = "DELETE FROM vactolib_user WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query ->execute();
        header('Location: basic-table.php');
    }else{
        die('404');
    }
}