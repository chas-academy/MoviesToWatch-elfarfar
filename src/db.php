<?php

// Inaktivera databasanslutning om du kör Render Free-tier
/*
$host = 'dpg-cv6tmmrqf0us73f6d0a0-a';  
$db = 'todo_list';  
$user = 'root';  
$pass = 'mariadb';  
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
*/

// Använd JSON-fil istället
define('MOVIE_FILE', 'movies.json');

?>
