<?php
// On inclut le fichier de données et on récupère le tableau.
$articleContent = include 'FakeDataTableContent.php';

// Si le tableau n'est pas valide, on arrête le script ici.
if (!is_array($articleContent)) {
    die("Erreur : Le fichier de données n'a pas retourné un tableau valide.");
}

error_log(print_r($articleContent, true));
echo 'La base de données est en train de se remplir avec les fakes data...';

// Configuration de la connexion à la base de données (pas de changement)
$os = 'macOS'; // Remplacez par une détection correcte ou une valeur par défaut
$host = ($os == 'macOS') ? 'localhost:8889' : 'localhost:3306';
$pass = ($os == 'macOS') ? 'root' : 'password';
$db = 'LaTechnologiePourTous';
$user = 'root';
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
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// -----------------------------------------------------------
// Fonctions corrigées
// -----------------------------------------------------------

function createFakeUser($pdo) {
    // Vérifier si l'utilisateur 'testuser' existe déjà pour éviter l'erreur de doublon
    $stmt = $pdo->prepare("SELECT id FROM user WHERE username = ?");
    $stmt->execute(['testuser']);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "L'utilisateur 'testuser' existe déjà. ID: " . $existingUser['id'] . "\n";
        return $existingUser['id'];
    }

    $username = 'testuser';
    $email = 'test@exemple.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO user (username, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $password, date('Y-m-d H:i:s')]);
    
    echo "Création de l'utilisateur : $username\n";
    return $pdo->lastInsertId();
}

// Fonction pour trouver l'ID d'une catégorie
function getCategoryId($pdo, $categoryName) {
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE name = ?");
    $stmt->execute([$categoryName]);
    $category = $stmt->fetch();
    
    // Si la catégorie n'existe pas, on pourrait la créer ici
    if (!$category) {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$categoryName]);
        return $pdo->lastInsertId();
    }
    return $category['id'];
}

// Fonction pour insérer des cathégories d'articles factices
function createFakeCategories($pdo, $categories) {
    $categories = [
        ['name' => 'Technologie', 'description' => 'Articles sur les dernières innovations technologiques.'],
        ['name' => 'hadware', 'description' => 'conseil sur les composants informatique.'],
        ['name' => 'Logiciels', 'description' => 'Tout sur les logiciels et applications.'],
        ['name' => 'Internet', 'description' => 'Nouveautés et astuces sur Internet.'],
        ['name' => 'Sécurité', 'description' => 'Conseils pour sécuriser vos données et appareils.'],
        ['name' => 'Réseaux Sociaux', 'description' => 'Actualités et conseils sur les réseaux sociaux.'],
        ['name' => 'Gadgets', 'description' => 'Tests et avis sur les derniers gadgets.'],
        ['name' => 'Intelligence Artificielle', 'description' => 'Articles sur l\'IA et ses applications.']
    ];
    foreach ($categories as $category) {
        $stmt = $pdo->prepare("INSERT INTO categories (name, description, created_at) VALUES (?, ?, ?)");
        $stmt->execute([$category['name'], $category['description'], date('Y-m-d H:i:s')]);
        echo "Catégorie '" . $category['name'] . "' insérée avec succès.<br>";
    }
}
// Nouvelle fonction d'insertion des articles
function createFakeArticles($pdo, $articleContent, $userId) {
    
    // Requête préparée pour l'insertion
    $sql = "INSERT INTO articles (user_id, title, content, category_id, created_at) VALUES (:user_id, :title, :content, :category_id, :created_at)";
    $stmt = $pdo->prepare($sql);
    
    echo "Insertion des articles...\n";
    foreach ($articleContent as $article) {
        try {
            // On récupère l'ID de la catégorie à partir de son nom
            $categoryId = getCategoryId($pdo, $article['category']);

            // Exécute la requête avec les valeurs de l'article courant
            $stmt->execute([
                ':user_id'    => $userId, // On utilise l'ID de l'utilisateur créé
                ':title'      => $article['title'],
                ':content'    => $article['content'],
                ':category_id'=> $categoryId,
                ':created_at' => $article['created_at']
            ]);
            echo "Article '" . $article['title'] . "' inséré avec succès.<br>";
        } catch (PDOException $e) {
            echo "Erreur d'insertion pour l'article '" . $article['title'] . "' : " . $e->getMessage() . "<br>";
        }
    }
}

// -----------------------------------------------------------
// Appel des fonctions
// -----------------------------------------------------------

try {
    // Étape 1 : Créer ou récupérer l'ID de l'utilisateur
    $userId = createFakeUser($pdo);
    
    // Étape 2 : Insérer tous les articles en utilisant l'ID de l'utilisateur
    createFakeArticles($pdo, $articleContent, $userId);
    createFakeCategories($pdo, $articleContent);
    
    echo "Faux articles insérés avec succès.";
    echo "<br><a href='../public/admin.php'>Retour à l'admin</a>";

} catch (PDOException $e) {
    echo "Erreur générale : " . $e->getMessage();
}
?>