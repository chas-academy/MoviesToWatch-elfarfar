<?php 
require'db.php';

$query = $pdo->query("SELECT * FROM media ORDER BY skapad DESC");
$media = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/src/style/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film - och serie lista</title>

</head>
<body>
    <h1>Movies To Watch</h1>
    <form action="add.php" method="post">
        <input type="text" name="namn" placeholder="Namn" required>
        <select name="typ" required>
            <option value="Movie">Movie</option>
            <option value="Serie">Serie</option>
    </select>
    <select name="genre" required>
        <option value="Action">Action</option>
        <option value="Comedy">Comedy</option>
        <option value="Adventure">Adventure</option>
        <option value="Horror">Horror</option>
        <option value="Documentery">Documentery</option>
        <option value="War">War</option>
    </select>
        <button type="submit">Lägg till</button>
</form>

<h2>Lista</h2>
    <ul> 
        <?php foreach ($media as $item): ?>
            <li>
                <strong><?= htmlspecialchars($item['namn']) ?></strong>
                (<?= htmlspecialchars($item['typ']) ?> - <?=htmlspecialchars($item ['genre']) ?>)
                <span>Status: <?= $item['sett'] ? 'Seen' : 'Not seen' ?></span>
                <a href="toggle.php?id=<?= $item['id'] ?>">Toggle seen</a> 
                <a href="update.php?id=<?= $item['id'] ?>">Change</a> 
                <a href="delete.php?id=<?= $item['id'] ?>">Delete</a> 
            </li>
            <?php endforeach; ?>
    </ul>        
    
</body>
</html>