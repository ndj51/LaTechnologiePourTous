<?php

function dbConnect() {
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

    return new PDO($dsn, $user, $pass, $options);
}

try {
    $bdd = dbConnect();
    //echo "Connexion réussie !";
} catch (Exception $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
};


function createArticle($title, $content) {
    error_log('Creating article with title: ' . $title);
    // user_id	title	content	created_at
    $pdo = dbConnect();
    $userId = 1; // Remplacez par l'ID de l'utilisateur actuel, si nécessaire
    $timestamp_unix = time();
    $createdAt = date('Y-m-d H:i:s', $timestamp_unix); // Date actuelle au format MySQL
    try {
        $stmt = $pdo->prepare("INSERT INTO articles (user_id, title, content, created_at) VALUES (:user_id, :title, :content, :created_at)");
        $stmt->execute([
            'user_id' => $userId,
            'title' => $title, 
            'content' => $content, 
            'created_at' => $createdAt]);
    } catch (\PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}