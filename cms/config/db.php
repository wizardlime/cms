<?php


  if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/../');
    }

    if (!defined('BASE_URL')) {
    define('BASE_URL', '/cms/');
    }

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
