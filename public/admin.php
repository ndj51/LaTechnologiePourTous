<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Technologie Pour Tous</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>
    <div id="admin-header">
        <h1>Administration</h1>
        <nav>
        <ul>
            <li><a href="../public/index.php">Accueil</a></li>
            <li><a href="../public/admin.php">Admin</a></li>
        </ul>
    </nav>
    </div>
   
    <h2>Bienvenue dans l'interface d'administration</h2>
    <p>Vous pouvez gérer les utilisateurs et les articles depuis cette page.</p>
    <p>Utilisez le menu de navigation pour accéder aux différentes sections.</p>
    <p>Pour créer un nouvel article, remplissez le formulaire ci-dessous.</p>
    <nav>
        <ul>
            <li><a href="utilisateurs">utilisateurs</a></li>
            <li><a href="articles">articles</a></li>
            <li><a href="">truc</a></li>
            <li><a href="">autre truc</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
