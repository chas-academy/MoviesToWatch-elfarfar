<?php
require 'crud-functions.php';

// Handle actions: add, delete, toggle, etc.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'add') {
    $namn = $_POST['namn'];
    $typ = $_POST['typ'];
    $genre = $_POST['genre'];

    addMovie($pdo, $namn, $typ, $genre);

   
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? null;

    if ($action === 'delete' && $id) {
        deleteMovie($pdo, $id);
    }

    if ($action === 'toggle' && $id) {
        toggleMovieSeen($pdo, $id);
    }

    // Redirect back to index.php after action
    
}

$movies = getMovies($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies To Watch</title>
</head>
<body>
    <div class="main">
        <div class="main__container">
            <div class="main__content">
                <h1>Movies To Watch</h1>
                
                <form action="/index.php?action=add" method="post">
                    <input type="text" name="namn" placeholder="Name" required>
                    <select name="typ" required>
                        <option value="Movie">Movie</option>
                        <option value="Series">Series</option>
                    </select>
                    <select name="genre" required>
                        <option value="Action">Action</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Adventure">Adventure</option>
                        <option value="Horror">Horror</option>
                        <option value="Documentary">Documentary</option>
                        <option value="War">War</option>
                    </select>
                    <button type="submit">Add Movie</button>
                </form>
            </div>
        </div>
        <div class="list">
            <div class="list__container">
                <div class="list__content">
                    <h2>List</h2>
                    <ul>
                        <?php foreach ($movies as $item): ?>
                            <li>
                                <strong><?= htmlspecialchars($item['name']) ?></strong>
                                (<?= htmlspecialchars($item['type']) ?> - <?= htmlspecialchars($item['genre']) ?>)
                                <span>Status: <?= $item['seen'] ? 'Seen' : 'Not seen' ?></span>
                                <a href="/index.php?action=toggle&id=<?= $item['id'] ?>">Toggle seen</a>
                                <a href="edit.php?action=update&id=<?= $item['id'] ?>">Edit</a>
                                <a href="/index.php?action=delete&id=<?= $item['id'] ?>">Delete</a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
                <?php endforeach; ?>
            </ul>
        </body>
        </html>
