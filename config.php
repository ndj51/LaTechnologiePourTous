<?php

// 1. Détection de l'OS et des paramètres de connexion
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$os = 'Inconnu';

if (preg_match('/windows|win32/i', $user_agent)) {
    $os = 'Windows';
} elseif (preg_match('/macintosh|mac os x/i', $user_agent)) {
    $os = 'macOS';
} elseif (preg_match('/linux/i', $user_agent)) {
    $os = 'Linux';
}

if ($os == 'Linux') {
    $host = 'localhost:3306';
    $pass = 'password';
} elseif ($os == 'macOS') {
    $host = 'localhost:8889';
    $pass = 'root';
} else {
    // Si l'OS n'est pas reconnu pour le développement, le script s'arrête
    die("OS non supporté pour la connexion à la BDD.");
}

$db      = 'LaTechnologiePourTous';
$user    = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// 2. Connexion à la BDD et création des tables
try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Création de la table 'user'
    $sqlUser = "
        CREATE TABLE IF NOT EXISTS `user` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlUser);

    // Création de la table 'articles'
    $sqlArticles = "
        CREATE TABLE IF NOT EXISTS `articles` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES `user`(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlArticles);

    echo "Tables 'user' et 'articles' créées avec succès.";
} catch (PDOException $e) {
    die("Erreur de connexion ou de création de tables : " . $e->getMessage());
}

?>