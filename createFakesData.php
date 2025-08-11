<?php
 // Connexion à la base de données (à adapter selon vos paramètres)
$host = 'localhost:3306';
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
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

function createFakeUser() {
    global $pdo;
    $id = 1; // Exemple d'ID, à adapter selon votre logique
    $username = 'testuser';
    $email = 'test@exemple.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $timestamp_unix = time();
    $created_at = date('Y-m-d H:i:s', $timestamp_unix); // Date actuelle au format MySQL
    $stmt = $pdo->prepare("INSERT INTO user (
        id, username, email, password, created_at
    ) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id, $username, $email, $password, $created_at]);

    echo "Création de l'utilisateur : $username\n";
}


function createFakeArticle($user_id) {
    foreach (range(1, 15) as $i) {
        global $pdo;
        $title = 'Titre de l\'article ' . $i;
        $content = 'Contenu de l\'article ' . $i;
        $stmt = $pdo->prepare("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $title, $content]);
    }
    echo "Création de l'article : $title\n";
}

//createFakeUser();
createFakeArticle(1);