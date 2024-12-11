<?php
require 'db.php'; // Ensure the database connection is required first

// Function to get all movies
function getMovies($pdo) {
    $query = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new movie
function addMovie($pdo, $namn, $typ, $genre) {
    $query = $pdo->prepare("INSERT INTO movies (name, type, genre) VALUES (?, ?, ?)");
    $query->execute([$namn, $typ, $genre]);
}

// Function to update an existing movie
function updateMovie($pdo, $id, $namn, $typ, $genre) {
    $query = $pdo->prepare("UPDATE movies SET name = ?, type = ?, genre = ? WHERE id = ?");
    $query->execute([$namn, $typ, $genre, $id]);
}

// Function to delete a movie
function deleteMovie($pdo, $id) {
    $query = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    $query->execute([$id]);
}

// Function to toggle a movie's seen status
function toggleMovieSeen($pdo, $id) {
    $query = $pdo->prepare("UPDATE movies SET seen = !seen WHERE id = ?");
    $query->execute([$id]);
}
?>
