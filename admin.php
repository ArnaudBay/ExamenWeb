<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");  // Rediriger vers la page de connexion si non connecté
    exit();
}

require 'functions.php';  // Charger les fonctions nécessaires

// Logique de l'administration (exemple : récupération des albums)
$albums = get_all_albums();  // Assurez-vous de définir cette fonction dans `functions.php`
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Albums Centrafricains</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Administration des Albums</h1>
        <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</p>
        <a href="admin_login.php">Se déconnecter</a>

        <h2>Ajouter un nouvel album</h2>
        <form action="save_album.php" method="POST" enctype="multipart/form-data">
            <!-- Formulaire pour ajouter un album -->
            <div class="form-group">
                <label for="artist_name">Nom de l'artiste :</label>
                <input type="text" id="artist_name" name="artist_name" required>
            </div>
            <div class="form-group">
                <label for="album_name">Nom de l'album :</label>
                <input type="text" id="album_name" name="album_name" required>
            </div>
            <div class="form-group">
                <label for="release_year">Année de sortie :</label>
                <input type="number" id="release_year" name="release_year" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="album_cover">Couverture de l'album :</label>
                <input type="file" id="album_cover" name="album_cover" accept="image/*" required>
            </div>
            <button type="submit">Ajouter Album</button>
        </form>

        <h2>Albums Existants</h2>
        <ul>
            <?php foreach ($albums as $album): ?>
                <li><?php echo htmlspecialchars($album['album_name']); ?> par <?php echo htmlspecialchars($album['artist_name']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
