<?php
require 'functions.php';
$artists = get_artists(); // Fonction à définir dans functions.php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums Centrafricains</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <div class="container">
        <h1>Bienvenue aux Albums Centrafricains</h1>
        <div class="search-container">
            <input type="text" id="search" placeholder="Rechercher un artiste...">
            <ul class="search-results"></ul>
        </div>
        <div class="artist-list-container">
            <h2>Liste des Artistes</h2>
            <ul>
                <?php foreach ($artists as $artist): ?>
                    <li><?php echo htmlspecialchars($artist['artist_name']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="admin-button-container">
            <a href="admin_login.php">
                <button class="admin-button">Accéder à l'administration</button>
            </a>
        </div>
    </div>
</body>
</html>
