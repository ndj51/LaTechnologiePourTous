<?php
echo 'la base de donnée est en cours de création...';

$host    = 'localhost:3306';
$db      = 'LaTechnologiePourTous';
$user    = 'root';
$pass    = 'password'; 
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
$sqlCategories = "
        CREATE TABLE IF NOT EXISTS `categories` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) NOT NULL UNIQUE,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlCategories);

    $sqlArticles = "
        CREATE TABLE IF NOT EXISTS `articles` (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            category_id INT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES `user`(id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES `categories`(id) ON DELETE SET NULL
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlArticles);
    $pdo->exec($sqlCategories);
    echo "Tables 'user' et 'articles' créées avec succès.";
} catch (PDOException $e) {
    die("Erreur de connexion ou de création de tables : " . $e->getMessage());
}
?>
<a href="./createFakesData.php?action=createFakeData">Créer des données factices</a>
<a href="../public/admin.php">Retour à la page admin</a>
