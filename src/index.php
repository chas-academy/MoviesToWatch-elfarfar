<?php
require 'crud-functions.php';

$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;
$movieToEdit = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'add') {
    $namn = $_POST['namn'] ?? null;
    $typ = $_POST['typ'] ?? null;
    $genre = $_POST['genre'] ?? null;

    if ($namn && $typ && $genre) {
        addMovie($namn, $typ, $genre);
        header("Location: /index.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($id && is_numeric($id)) {
        if ($action === 'delete') {
            deleteMovie($id);
            header("Location: /index.php");
            exit;
        }
        if ($action === 'toggle') {
            toggleMovieSeen($id);
            header("Location: /index.php");
            exit;
        }
    }
}

if ($action === 'update' && $id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $namn = $_POST['name'] ?? null;
        $typ = $_POST['type'] ?? null;
        $genre = $_POST['genre'] ?? null;

        if ($namn && $typ && $genre) {
            updateMovie($id, $namn, $typ, $genre);
            header("Location: /index.php");
            exit;
        }
    } else {
        $movieToEdit = getMovieById($id);
    }
}

$movies = getMovies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../public/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies To Watch</title>
</head>
<body>
    <div class="main">
        <div class="main__container">
            <h1>Movies To Watch</h1>
            <form action="/index.php?action=add" method="post">
                <input type="text" name="namn" placeholder="Movie/series title" required>
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
        
        <div class="list">
            <h2>List</h2>
            <ul>
                <?php foreach ($movies as $item) : ?>
                    <li>
                        <div class="item-details">
                            <strong><?= htmlspecialchars($item['name']) ?></strong>
                            <div>(<?= htmlspecialchars($item['type']) ?> - <?= htmlspecialchars($item['genre']) ?>)</div>
                            <div>Status: <?= $item['seen'] ? 'Seen' : 'Not seen' ?></div>
                        </div>
                        <div class="item-actions">
                            <form action="/index.php" method="GET">
                                <label class="switch">
                                    <input type="checkbox" name="seen" onchange="this.form.submit()" <?= $item['seen'] ? 'checked' : '' ?>>
                                    <span class="slider"></span>
                                </label>
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="action" value="toggle">
                            </form>
                            <a href="/index.php?action=update&id=<?= $item['id'] ?>">
                                <button type="submit">Edit</button>
                            </a>
                            <form action="/index.php" method="GET">
                                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>
</html>
