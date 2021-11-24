<?php


try {
    $pdo = new PDO('mysql:host=localhost;dbname=vactolib', "root", "", array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

<<<<<<< HEAD




=======
>>>>>>> d3989380a833832ab9e816b7f739a231be24840a
