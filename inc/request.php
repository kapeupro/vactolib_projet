<?php

//Tous les raccourcis pour les requests !

function getUserById($id){
    global $pdo;
    $sql="SELECT * FROM vactolib_user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function getUser(){
    global $pdo;
    $sql="SELECT * FROM vactolib_user ORDER BY rand()";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
