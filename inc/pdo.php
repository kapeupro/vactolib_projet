<?php

try {
    $pdo = new PDO('mysql:host=109.234.164.141;dbname=wtgm7011_vactolib', "wtgm7011_admin", "Azerty1999", array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ));
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
