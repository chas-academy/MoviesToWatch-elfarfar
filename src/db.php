<?php
$host = 'mariadb'; // Matcha med tjänstenamn i docker-compose.yml
$db = 'moviestodo'; // Databasnamn
$user = 'mariadb'; // Användarnamn i docker-compose.yml
$pass = 'mariadb'; // Lösenord i docker-compose.yml
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Anslutning lyckades!";
} catch (\PDOException $e) {
    die("Kunde inte ansluta till databasen: " . $e->getMessage());
}
?>
