<?php

    define('BASE_PATH', __DIR__ . '/');

    $host = 'localhost';
    $db_name = "cms";
    $user = "root";
    $password = "";

    $dsn = "mysql:host=$host;dbname=$db_name;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    } 
