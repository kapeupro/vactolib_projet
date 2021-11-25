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
function getUserResetPassword($email,$token){
    global $pdo;
    $sql="SELECT * FROM vactolib_user WHERE email = :email AND token= :token";
    $query = $pdo->prepare($sql);
    $query ->bindValue(':email',$email,PDO::PARAM_INT);
    $query ->bindValue(':token',$token,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function getUserBySessionId($id_session){
    global $pdo;
    $sql = "SELECT * FROM vactolib_user WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id_session,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
function verifUserByEmail($email){
    global $pdo;
    $sql = "SELECT * FROM vactolib_user WHERE email=:email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email',$email,PDO::PARAM_STR);
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

function getVaccinBySearch($search)
{
    global $pdo;
    $sql = "SELECT * FROM vactolib_vaccins WHERE nom_vaccin LIKE :search OR laboratoire LIKE :search";
    $query = $pdo->prepare($sql);
    $query->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
}

function getUserBySearch($search)
{
    global $pdo;
    $sql = "SELECT * FROM vactolib_user WHERE nom LIKE :search OR prenom LIKE :search";
    $query = $pdo->prepare($sql);
    $query->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);
    $query->execute();
    return $query->fetchAll();
}


// Recup tout les vaccins pour affichage stats
function recupUserStats(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS resultUsers FROM vactolib_user ";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

// Recup tout les ajouts dans carnet pour affichage stats
function recupVaccinsStats(){
    global $pdo;
    $sql = "SELECT COUNT(*) AS resultAjout FROM vactolib_vaccins ";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}
function recupVaccins(){
    global $pdo;
    $sql = "SELECT * FROM vactolib_vaccins";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}