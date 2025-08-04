<?php
$host = 'localhost'; // ou 127.0.0.1
$user = 'root';
$password = '';

try {
    // 1. Connexion à MySQL sans base spécifique (pour créer la base)
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Création de la base de données 'sera'
    $pdo->exec("CREATE DATABASE IF NOT EXISTS sera CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Base de données 'sera' créée ou existe déjà.<br>";

    // 3. Connexion à la base 'sera'
    $pdo = new PDO("mysql:host=$host;dbname=sera", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 4. Création de la table 'inscription'
    $sql = "
        CREATE TABLE IF NOT EXISTS inscription (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            mot_de_passe VARCHAR(255) NOT NULL,
            date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ";
    $pdo->exec($sql);
    echo "Table 'inscription' créée avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
