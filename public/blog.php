<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Technologie Pour Tous</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>

    <header>
        <h1> La Technologie Pour Tous </h1>
        <?php
        require_once __DIR__ . '/includes/header.php';
        require_once __DIR__ . '/../core/functions.php';
        ?>
    </header>
    
    <main>
        <p>Contenu principal.</p>
    </main>


    <?php
    // affichage des résumés des cinq derniers articles
    $articles = readArticles(5); // On lit les 5 derniers articles
    if ($articles) {
        foreach ($articles as $article) {
            echo '<div class="article">';
            echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
            echo '<p>' . nl2br(htmlspecialchars(substr($article['content'], 0, 150))) . '...</p>';
            echo '<p><em>Publié le ' . htmlspecialchars($article['created_at']) . '</em></p>';
            echo '<a href="article.php?id=' . htmlspecialchars($article['id']) . '">Lire la suite</a>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucun article trouvé.</p>';
    };
    ?>

    <?php
    // Inclure le pied de page
    require_once __DIR__ . '/includes/footer.php';
    ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>