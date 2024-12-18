<?php
require 'db.php';


function getMovies($pdo) {
    $query = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


function addMovie($pdo, $namn, $typ, $genre) {
    $query = $pdo->prepare("INSERT INTO movies (name, type, genre) VALUES (?, ?, ?)");
    $query->execute([$namn, $typ, $genre]);
}


function updateMovie($pdo, $id, $name, $type, $genre) {
    $query = $pdo->prepare("UPDATE movies SET name = ?, type = ?, genre = ? WHERE id = ?");
    return $query->execute([$name, $type, $genre, $id]);
}



function deleteMovie($pdo, $id) {
    $query = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    $query->execute([$id]);
}


function toggleMovieSeen($pdo, $id) {
    $query = $pdo->prepare("UPDATE movies SET seen = !seen WHERE id = ?");
    $query->execute([$id]);
}
?>
