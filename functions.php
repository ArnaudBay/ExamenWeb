<?php
function db_connect() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "albums_centrafricains";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }
    return $conn;
}

function get_artists() {
    $conn = db_connect();
    $result = $conn->query("SELECT DISTINCT artist_name FROM albums");
    $artists = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $artists;
}

function get_all_albums() {
    $conn = db_connect();
    $result = $conn->query("SELECT * FROM albums");
    $albums = $result->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $albums;
}
?>
