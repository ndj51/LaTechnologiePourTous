<?php
// Connexion à la base de données (à adapter selon vos paramètres)
$host = 'localhost:3306'; // ou l'adresse de votre serveur MySQL
$db   = 'LaTechnologiePourTous';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Création de la table user (avec username)
    $sqlUser = "
        CREATE TABLE IF NOT EXISTS user(
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlUser);

    // Création de la table article (avec user_id)
    $sqlArticles = "
        CREATE TABLE IF NOT EXISTS articles (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;
    ";
    $pdo->exec($sqlArticles);

    echo "Tables 'user' et 'article' créées avec succès.";
    createUser();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

function createUser() {
    // Code pour créer un utilisateur (à adapter selon vos besoins)
    // Par exemple, insérer un utilisateur dans la table user
    // Création de l'utilisateur...
    error_log("Creation de l'utilisateur...");
    global $pdo;
    $id = 1; // Exemple d'ID, à adapter selon votre logique
    $username = 'testuser';
    $email = 'test@exemple.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');  
    $stmt = $pdo->prepare("INSERT INTO user (
    id, username, email, password, created_at
    ) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id, $username, $email, $password, $created_at]);

    echo "Création de l'utilisateur : $username\n";

}
?>