<?php 

// $db = new PDO("mysql:host=host.containers.internal;dbname=bit;port=3306;charset=utf8mb4", "root","");

$host = 'host.containers.internal';
$db   = 'bit_master';
$user = 'root';
$pass = 's1q2l3#';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=3306";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$db = null; // init the variable!
try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // throw new \Exception($e->getMessage(), (int)$e->getCode());
    echo $e->getMessage();
}