<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
    <ul>
        <li><a href="../public/index.php">Accueil</a></li>
        <li><a href="../public/admin.php">Admin</a></li>
    </ul>
</nav>


<div>
    <form method="post" action="../core/functions.php">
        <label for="titleArticle">Titre de l'article:</label></br>
        <input type="text" id="titleArticle" name="titleArticle" required></br>
        </br>
        <label for="article">Votre article:</label></br>
        <textarea id="article" name="article" rows="5" cols="33">
        It was a dark and stormy night...
        </textarea></br>
        </br>
        <input type="hidden" name="action" value="aticleCreate">

        <button type="submit">Enregistrer</button>
    </form>
</div>
    <script src="assets/js/app.js"></script>
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/common.js"></script>
</body>
</html>
