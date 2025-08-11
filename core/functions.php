<?php
require_once 'bdd.php';
// On vérifie d'abord si une action a été envoyée
if (isset($_POST['action'])) {
    error_log('function.php');
    if ($_POST['action'] === 'login') {
        error_log('Login action triggered: ' . $_POST['action']);

        session_start();

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            // Identifiants fictifs pour la démonstration
            $validUser = 'admin';
            $validPass = 'password123';

            if ($username === $validUser && $password === $validPass) {
                $_SESSION['user'] = $username;
                header('Location: ../public/index.php');
                exit;
            } else {
                $error = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        }
    
    }

    if ($_POST['action'] === 'aticleCreate') {
        error_log('Article creation action triggered: ' . $_POST['action']);
        // Logique pour créer un article
        // ...
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            error_log('Processing article creation form submission');
            // On récupère les données du formulaire
            $title = trim($_POST['titleArticle'] ?? '');
            $content = $_POST['article'] ?? '';

            //createArticle($title, $content);

            // Ici, vous pouvez ajouter la logique pour enregistrer l'article dans la base de données
            // Par exemple, en utilisant PDO pour insérer les données dans une table 'articles'

            // Pour l'instant, on va juste simuler une réussite
            $success = true; // Simulez le succès de l'opération

            if ($success) {
                header('Location: ../public/admin.php');
                exit;
            } else {
                $error = 'Erreur lors de la création de l\'article.';
            }
        }
    } 
    if ($POST['action'] === 'createUser') {
        // Code pour créer un utilisateur (à adapter selon vos besoins)
        // Par exemple, insérer un utilisateur dans la table user
        // Création de l'utilisateur...
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

}

}


function readArticles($nb) {
    $quantity = $nb; // Nombre d'articles à lire.
    $pdo = dbConnect();
    try {
        $stmt = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC LIMIT $quantity");
        return $stmt->fetchAll();
    } catch (\PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return false;
    }
}

function readArticle($id) {
    $pdo = dbConnect();
    try {
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    } catch (\PDOException $e) {
        error_log('Database error: ' . $e->getMessage());
        return false;
    }
}