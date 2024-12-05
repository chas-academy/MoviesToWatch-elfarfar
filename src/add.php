<?php
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize it
    $namn = htmlspecialchars($_POST['namn']);
    $typ = htmlspecialchars($_POST['typ']);
    $genre = htmlspecialchars($_POST['genre']);

    $query = "INSERT INTO media (namn, typ, genre) VALUES (:namn, :typ, :genre)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':namn', $namn);
    $stmt->bindParam(':typ', $typ);
    $stmt->bindParam(':genre', $genre);

    if ($stmt->execute()) {
        header('Location: index.php'); 
        exit;
    } else {
        echo "Error adding the item.";
    }
}
?>
