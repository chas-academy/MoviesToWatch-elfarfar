<?php

define('MOVIE_FILE', 'movies.json');

function getMovies() {
    if (!file_exists(MOVIE_FILE)) {
        return [];
    }
    $json = file_get_contents(MOVIE_FILE);
    return json_decode($json, true) ?? [];
}

function saveMovies($movies) {
    file_put_contents(MOVIE_FILE, json_encode($movies, JSON_PRETTY_PRINT));
}

function addMovie($namn, $typ, $genre) {
    $movies = getMovies();
    $id = count($movies) + 1;
    $movies[] = ['id' => $id, 'name' => $namn, 'type' => $typ, 'genre' => $genre, 'seen' => false];
    saveMovies($movies);
}

function getMovieById($id) {
    $movies = getMovies();
    foreach ($movies as $movie) {
        if ($movie['id'] == $id) {
            return $movie;
        }
    }
    return null;
}

function updateMovie($id, $name, $type, $genre) {
    $movies = getMovies();
    foreach ($movies as &$movie) {
        if ($movie['id'] == $id) {
            $movie['name'] = $name;
            $movie['type'] = $type;
            $movie['genre'] = $genre;
            saveMovies($movies);
            return true;
        }
    }
    return false;
}

function deleteMovie($id) {
    $movies = getMovies();
    $movies = array_filter($movies, fn($movie) => $movie['id'] != $id);
    saveMovies(array_values($movies));
}

function toggleMovieSeen($id) {
    $movies = getMovies();
    foreach ($movies as &$movie) {
        if ($movie['id'] == $id) {
            $movie['seen'] = !$movie['seen'];
            saveMovies($movies);
            return;
        }
    }
}
