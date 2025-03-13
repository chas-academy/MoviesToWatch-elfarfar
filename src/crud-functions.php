<?php

define('DB_FILE', __DIR__ . '/movies.sqlite');

function connectDB() {
    try {
        $pdo = new PDO("sqlite:" . DB_FILE);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

// Ensure the movies table exists
function initializeDB() {
    $db = connectDB();
    $db->exec("CREATE TABLE IF NOT EXISTS movies (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        type TEXT NOT NULL,
        genre TEXT NOT NULL,
        seen INTEGER DEFAULT 0
    )");
}

// Fetch all movies
function getMovies() {
    $db = connectDB();
    $stmt = $db->query("SELECT * FROM movies");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add a new movie
function addMovie($name, $type, $genre) {
    $db = connectDB();
    $stmt = $db->prepare("INSERT INTO movies (name, type, genre, seen) VALUES (?, ?, ?, 0)");
    $stmt->execute([$name, $type, $genre]);
}

// Get a movie by ID
function getMovieById($id) {
    $db = connectDB();
    $stmt = $db->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update a movie
function updateMovie($id, $name, $type, $genre) {
    $db = connectDB();
    $stmt = $db->prepare("UPDATE movies SET name = ?, type = ?, genre = ? WHERE id = ?");
    return $stmt->execute([$name, $type, $genre, $id]);
}

// Delete a movie
function deleteMovie($id) {
    $db = connectDB();
    $stmt = $db->prepare("DELETE FROM movies WHERE id = ?");
    return $stmt->execute([$id]);
}

// Toggle "seen" status
function toggleMovieSeen($id) {
    $db = connectDB();
    $stmt = $db->prepare("UPDATE movies SET seen = NOT seen WHERE id = ?");
    return $stmt->execute([$id]);
}

// Initialize the database if not already set up
initializeDB();
