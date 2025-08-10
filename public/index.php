<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <h1> Bienvenu sur mon blog !</h1>
        <?php
        require_once __DIR__ . '/includes/header.php';
        ?>
    </header>
    
    <main>
        <p>Contenu principal.</p>
    </main>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    ?>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/common.js"></script>
</body>
</html>





