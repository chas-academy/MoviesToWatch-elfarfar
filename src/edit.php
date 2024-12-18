<?php
require 'crud-functions.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($action && $id) {
    switch ($action) {
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $namn = $_POST['name'];
                $typ = $_POST['type'];
                $genre = $_POST['genre'];

                updateMovie($pdo, $id, $namn, $typ, $genre);
                header("Location: /index.php");
                exit;
            } else {
                $query = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
                $query->execute([$id]);
                $movie = $query->fetch(PDO::FETCH_ASSOC);

                if (!$movie) {
                    die("Movie not found");
                }
            }
            break;

        default:
            die("Unknown action.");
    }
}
?>
