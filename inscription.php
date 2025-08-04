<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'sera';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['email'] ?? '';
        $mot_de_passe = $_POST['mot_de_passe'] ?? '';

        // Sécuriser le mot de passe (hash)
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Préparer et exécuter la requête
        $stmt = $pdo->prepare("INSERT INTO inscription (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $hashedPassword]);

        echo "<p style='color: green;'>Inscription réussie !</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
}
?>

<!-- Formulaire HTML -->
<h2>Formulaire d'inscription</h2>
<form method="post" action="inscription.php">
    <label>Nom:</label><br>
    <input type="text" name="nom" required><br><br>

    <label>Prénom:</label><br>
    <input type="text" name="prenom" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe:</label><br>
    <input type="password" name="mot_de_passe" required><br><br>

    <input type="submit" value="S'inscrire">
</form>
