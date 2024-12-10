<?php
session_start();

// Connexion à la base de données avec MySQLi
$host = 'localhost';
$dbname = 'albums_centrafricains';  // Nom de ta base de données
$username_db = 'root';              // Utilisateur de la base de données
$password_db = '';                  // Mot de passe de la base de données (en fonction de ton environnement)

$conn = new mysqli($host, $username_db, $password_db, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête préparée pour sécuriser contre les injections SQL
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username); // 's' pour indiquer que $username est une chaîne de caractères
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'utilisateur existe et comparer le mot de passe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['password'] == $password) { // Comparaison avec le mot de passe stocké
            $_SESSION['username'] = $username;  // Créer la session
            header("Location: admin.php");      // Rediriger vers la page admin
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Nom d'utilisateur incorrect.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Administration</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion - Administration</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="admin_login.php" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Se connecter</button>
        </form>
    </div>
</body>
</html>
