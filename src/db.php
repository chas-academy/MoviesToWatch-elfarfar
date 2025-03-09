<?php

$host = 'dpg-cv6tmmrqf0us73f6d0a0-a';  // Använd din Render MariaDB-tjänst, t.ex. 'mariadb' eller 'mysql' om du använder MySQL
$db = 'todo_list';  // Namnet på din databas
$user = 'root';  // Användarens namn för databasen
$pass = 'mariadb';  // Lösenordet för användaren
$charset = 'utf8mb4';

// Skapa DSN för att ansluta till databasen
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Skapa en ny PDO-instans för anslutning
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully";  // Om anslutningen lyckades
} catch (\PDOException $e) {
    // Fångar eventuella fel vid anslutning
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>
