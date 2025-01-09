<?php
require 'crud-functions.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
$movieToEdit = null;

if ($action && $id) {
    switch ($action) {
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // form submission
                $namn = $_POST['name'] ?? null;
                $typ = $_POST['type'] ?? null;
                $genre = $_POST['genre'] ?? null;

                if ($namn && $typ && $genre) {
                    updateMovie($pdo, $id, $namn, $typ, $genre);
                    header("Location: /index.php");
                    exit;
                } else {
                    die("All fields are required.");
                }
            } else {
                // Fetch movie to edit
                $query = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
                $query->execute([$id]);
                $movieToEdit = $query->fetch(PDO::FETCH_ASSOC);

                if (!$movieToEdit) {
                    die("Movie not found.");
                }
            }
            break;

        default:
            die("Unknown action.");
    }
}
?>
