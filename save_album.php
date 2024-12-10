<?php
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $artist_name = $_POST['artist_name'];
    $album_name = $_POST['album_name'];
    $release_year = $_POST['release_year'];
    $description = $_POST['description'];

    // Gérer le téléchargement de l'image
    $target_dir = "images/album_covers/";
    $target_file = $target_dir . basename($_FILES["album_cover"]["name"]);
    move_uploaded_file($_FILES["album_cover"]["tmp_name"], $target_file);

    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO albums (artist_name, album_name, release_year, description, album_cover) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $artist_name, $album_name, $release_year, $description, $target_file);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: admin.php");
    exit();
}
?>
