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
    $sql="SELECT * FROM vactolib_user";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
function getUserBySessionId($id_session){
    global $pdo;
    $sql = "SELECT * FROM vactolib_user WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id_session,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}

function getUserVaccinsBySessionId($id_session){
    global $pdo;
    $sql = "SELECT * FROM vactolib_user_vaccins WHERE user_id=:id ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id_session,PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
}

function getUserByToken($token){
    global $pdo;
    $sql = "SELECT * FROM vactolib_user WHERE token=:token";
    $query = $pdo->prepare($sql);
    $query->bindValue(':token',$token,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
function getVaccinById($id)
{
    global $pdo;
    $sql = "SELECT * FROM vactolib_vaccins WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

/*PAGINATION*/

/*COMPTER TOUT LES VACCIN AJOUTE*/

function countAllVaccinUser()
{
    global $pdo;
    $sql = "SELECT COUNT(id) FROM vactolib_user_vaccins";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchColumn();
}

/*GETVACCIN POUR PAGINATION CARNET*/

function getVaccins(int $limit = 10, $offset = 0, $id_session)
{
    global $pdo;
    $sqlleft = "SELECT vv.nom_vaccin, vv.laboratoire, vv.id ,vuv.vaccin_date
        FROM vactolib_user_vaccins AS vuv
        LEFT JOIN vactolib_vaccins AS vv
        ON vv.id = vuv.vaccin_id
        WHERE vuv.user_id = :id_session ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sqlleft);
    $query->bindValue(':id_session', $id_session,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();

}