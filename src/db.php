<?php
$host = 'mariadb';          // Docker-tjänstnamnet för MariaDB
$dbname = 'moviestodo';     // Namnet på din databas
$username = 'mariadb';      // Användarnamn för MariaDB
$password = 'mariadb';      // Lösenord för MariaDB

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Anslutning lyckades!";
} catch (PDOException $e) {
    die("Kunde inte ansluta till databasen: " . $e->getMessage());
}
?>
