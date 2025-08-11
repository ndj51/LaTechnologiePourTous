<?php
// article.php
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../core/functions.php';
// Vérifier si un identifiant d'article est passé en paramètre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Article non trouvé.";
    exit;
}
echo "Article ID: " . htmlspecialchars($_GET['id']);
$article = readArticle($_GET['id']);




?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($article['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p><em>Publié le <?= htmlspecialchars($article['created_at']) ?></em></p>
    <div>
        <?= nl2br(htmlspecialchars($article['content'])) ?>
    </div>
    <p><a href="blog.php">Retour à la liste des articles</a></p>
</body>
</html>