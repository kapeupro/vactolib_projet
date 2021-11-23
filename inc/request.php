git <?php

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
