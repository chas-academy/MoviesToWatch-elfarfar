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
        addMovie($pdo, $namn, $typ, $genre);
        header("Location: /index.php");
        exit;
    }
}

// Handle actions for delete and toggle
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? null;

    if ($id && is_numeric($id)) {
        if ($action === 'delete') {
            deleteMovie($pdo, $id);
            header("Location: /index.php");
            exit;
        }

        if ($action === 'toggle') {
            toggleMovieSeen($pdo, $id);
            header("Location: /index.php");
            exit;
        }
    }
}

if ($action === 'update' && $id) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission
        $namn = $_POST['name'] ?? null;
        $typ = $_POST['type'] ?? null;
        $genre = $_POST['genre'] ?? null;

        if ($namn && $typ && $genre) {
            updateMovie($pdo, $id, $namn, $typ, $genre);
            header("Location: /index.php");
            exit;
        } else {
            die("Please fill in all fields.");
        }
    } else {
        // Fetch the movie to edit
        $query = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
        $query->execute([$id]);
        $movieToEdit = $query->fetch(PDO::FETCH_ASSOC);

        if (!$movieToEdit) {
            die("Movie not found.");
        }
    }
}
// Fetch to display
$movies = getMovies($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style/style.css?v=1.6">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
<!--Start form options-->
                <h1>Movies To Watch</h1>
                <div class="main__form">
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
            </div>
        </div>
        <div class="list">
    <div class="list__container">
        <div class="list__content">
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
                <!-- Toggle Seen Status -->
                <form action="/index.php" method="GET">
                    <label class="switch">
                        <input type="checkbox" name="seen" onchange="this.form.submit()" <?= $item['seen'] ? 'checked' : '' ?>>
                        <span class="slider"></span>
                    </label>
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="action" value="toggle">
                </form>

                <!-- Edit Button -->
                <a href="/index.php?action=update&id=<?= $item['id'] ?>">
                    <button type="submit" class="edit-btn">Edit</button>
                </a>

                <!-- Delete Button -->
                <form action="/index.php" method="GET">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        </li>
    <?php endforeach; ?>

</ul>
<!-- Edit Movie Form - Show When $movieToEdit is Available -->
<?php if ($movieToEdit) : ?>
        <div class="main__form">
            <h2>Edit: <?= htmlspecialchars($movieToEdit['name']) ?></h2>
            <form action="/index.php?action=update&id=<?= $movieToEdit['id'] ?>" method="POST">
                <input type="text" id="name" name="name" placeholder="Name" value="<?= htmlspecialchars($movieToEdit['name']) ?>" required>
                <label for="type"></label>
                <select name="type" required> 
                    <option value="Movie" <?= $movieToEdit['type'] === 'Movie' ? 'selected' : '' ?>>Movie</option>
                    <option value="Series" <?= $movieToEdit['type'] === 'Series' ? 'selected' : '' ?>>Series</option>
                </select>
                
                <label for="genre"></label>
                <select name="genre" required>
                    <option value="Action" <?= $movieToEdit['genre'] === 'Action' ? 'selected' : '' ?>>Action</option>
                    <option value="Comedy" <?= $movieToEdit['genre'] === 'Comedy' ? 'selected' : '' ?>>Comedy</option>
            <option value="Adventure" <?= $movieToEdit['genre'] === 'Adventure' ? 'selected' : '' ?>>Adventure</option>
            <option value="Horror" <?= $movieToEdit['genre'] === 'Horror' ? 'selected' : '' ?>>Horror</option>
            <option value="Documentary" <?= $movieToEdit['genre'] === 'Documentary' ? 'selected' : '' ?>>Documentary</option>
            <option value="War" <?= $movieToEdit['genre'] === 'War' ? 'selected' : '' ?>>War</option>
        </select>
        
        <button type="submit" class="edit-btn">Save</button>
    </form>
   </div>
 

<?php endif; ?>
        </div>
    </div>
</div>
        </body>
        </html>
