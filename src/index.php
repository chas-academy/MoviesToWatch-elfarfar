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

    
}

$movies = getMovies($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style/style.css?v=1.4">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Agdasima:wght@400;700&family=Bruno+Ace+SC&family=DM+Serif+Text:ital@0;1&family=Gowun+Dodum&family=Oswald:wght@200..700&family=Teko:wght@300..700&family=Tinos:ital,wght@0,400;0,700;1,400;1,700&family=Unna:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies To Watch</title>
</head>
<body>
    <div class="main">
        <div class="main__container">
            <div class="main__content">
                <h1>Movies To Watch</h1>
                <div class="main__form">
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
        </div>
        <div class="list">
    <div class="list__container">
        <div class="list__content">
            <h2>List</h2>
            
            <ul>
                <?php foreach ($movies as $item): ?>
                    <li>
                        <div class="item-details">
                            <strong><?= htmlspecialchars($item['name']) ?></strong>
                            <div>(<?= htmlspecialchars($item['type']) ?> - <?= htmlspecialchars($item['genre']) ?>)</div>
                            <div>Status: <?= $item['seen'] ? 'Seen' : 'Not seen' ?></div>
                        </div>
                        <div class="item-actions">
                            <a href="/index.php?action=toggle&id=<?= $item['id'] ?>">Toggle seen</a>
                            <a href="edit.php?action=update&id=<?= $item['id'] ?>">Edit</a>
                            <a href="/index.php?action=delete&id=<?= $item['id'] ?>">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

        </body>
        </html>
