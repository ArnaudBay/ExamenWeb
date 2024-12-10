<?php
require 'functions.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM albums WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $album = $result->fetch_assoc();
    echo json_encode($album);
    $stmt->close();
    $conn->close();
}
?>
