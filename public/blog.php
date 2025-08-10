<?php
require_once __DIR__ . '/includes/header.php';
// On inclut le fichier de fonctions au début du script
require_once __DIR__ . '/../core/functions.php';

?>

<h1> Vous pouvez lire ici mes article de blog !</h1>


<?php
$articles = readArticles();
if ($articles) {
    foreach ($articles as $article) {
        echo '<div class="article">';
        echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
        echo '<p>' . nl2br(htmlspecialchars($article['content'])) . '</p>';
        echo '<p><em>Publié le ' . htmlspecialchars($article['created_at']) . '</em></p>';
        echo '</div>';
    }
} else {
    echo '<p>Aucun article trouvé.</p>';
}
?>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
