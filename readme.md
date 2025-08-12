

/
├── public/                     # Dossier accessible publiquement
│   ├── index.php              # Page d'accueil statique
│   ├── admin.php              # Page d'administration statique
│   ├── blog.php               # Page de blog statique
│   ├── includes/
│   │   ├── header.php
│   │   └── footer.php
│   └── assets/
│       ├── css/
│       └── js/                 # Contient tout votre code JavaScript
│           ├── app.js          # Script principal pour la logique du site public
│           └── admin.js        # Script pour la logique de la partie admin
│
├── api/                        # Points d'accès aux données (le back-end)
│   ├── posts/
│   │   ├── getPosts.php        # Renvoie la liste des articles en JSON
│   │   ├── getPost.php         # Renvoie un article spécifique en JSON
│   │   ├── createPost.php      # Gère la création d'un article
│   │   └── deletePost.php      # Gère la suppression d'un article
│   └── users/
│       ├── login.php           # Gère la connexion des utilisateurs
│       └── createUser.php      # Gère la création d'un utilisateur
│
├── core/                       # Cœur de l'application
│   ├── bdd.php                 # Fonctions pour les interactions avec la base de données
│   └── functions.php           # Fonctions utilitaires (validation, etc.)
│
├── .htaccess                   # Gère les redirections et la sécurité
└── config.php                  # Fichier de configuration



