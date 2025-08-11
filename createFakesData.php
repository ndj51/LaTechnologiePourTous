<?php
 // Connexion à la base de données (à adapter selon vos paramètres)
$host = 'localhost:3306';
$db   = 'LaTechnologiePourTous';
$user = 'root';
$pass = 'password';
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
    echo "Erreur : " . $e->getMessage();
}

function createFakeUser() {
    global $pdo;
    $id = 1; // Exemple d'ID, à adapter selon votre logique
    $username = 'testuser';
    $email = 'test@exemple.com';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $timestamp_unix = time();
    $created_at = date('Y-m-d H:i:s', $timestamp_unix); // Date actuelle au format MySQL
    $stmt = $pdo->prepare("INSERT INTO user (
        id, username, email, password, created_at
    ) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id, $username, $email, $password, $created_at]);

    echo "Création de l'utilisateur : $username\n";
}


function createFakeArticle($user_id) {
    $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla sollicitudin tortor, eget sodales neque congue a. Sed at semper tortor, eget lobortis libero. Vivamus rhoncus elit non diam eleifend vehicula. Praesent ut nisi porttitor massa hendrerit tempus. Ut ut libero et quam venenatis pellentesque sit amet vitae nisi. Fusce non tellus et arcu pellentesque pretium eget sed arcu. Mauris accumsan libero at sagittis condimentum. Aliquam gravida a massa in gravida. Nulla tristique eu felis et malesuada. In tempor placerat tellus quis blandit.

Cras sit amet turpis eu mi semper porta vitae in ante. Praesent lobortis nec enim et ornare. Sed erat felis, elementum et augue id, vehicula viverra odio. Donec at turpis ultricies, tincidunt turpis vel, laoreet magna. Donec blandit, risus non condimentum dignissim, ipsum sem viverra dolor, maximus tincidunt enim nisl non leo. Nullam et ligula vitae ante ullamcorper blandit at sed velit. Cras vitae risus vitae lectus euismod fringilla. Phasellus vitae condimentum mauris. Morbi quam metus, ullamcorper vitae pulvinar vel, ullamcorper ac nibh. Integer eleifend condimentum cursus. Cras ipsum lorem, tincidunt vel lorem non, feugiat pharetra dui. Sed convallis, enim dignissim dapibus lobortis, augue mauris porta sem, in semper nisl nunc vitae lorem. Pellentesque at ultricies libero.

Nam egestas est ut orci porttitor sagittis. Nulla vel ornare magna. Maecenas auctor ultrices felis. Proin vehicula justo ut urna luctus, bibendum venenatis felis sodales. Phasellus id purus tempor, mattis lectus vel, efficitur elit. Nullam eu feugiat quam. Suspendisse aliquet, velit non volutpat eleifend, erat ex facilisis nisl, nec dictum nisi leo vitae leo. Aenean porta sagittis arcu. Praesent aliquam posuere urna, in vehicula nunc congue at. Quisque vitae ultrices arcu. Nulla sed ligula tincidunt, ornare tortor non, commodo augue. Praesent consectetur, augue in lacinia tincidunt, metus enim porttitor purus, non finibus nibh augue et lorem. Nunc nec rhoncus turpis, eu egestas urna.

Donec ipsum mi, suscipit ut lectus id, fermentum consequat libero. Suspendisse lobortis sapien nisl, ac sagittis tortor euismod at. Suspendisse molestie vel elit sed pulvinar. Cras laoreet tincidunt libero id blandit. Vivamus pharetra arcu quis mauris efficitur dignissim. Nunc interdum varius urna eget viverra. Aliquam arcu felis, iaculis non eleifend eu, imperdiet ac tortor. Proin at dapibus diam. Nunc libero mauris, ultrices sed sapien ut, lacinia egestas turpis. Etiam dolor odio, maximus viverra bibendum quis, eleifend a massa. Vivamus eu turpis lorem. Integer congue, lectus et facilisis suscipit, tortor ex tempus lectus, congue cursus risus felis vitae justo. Proin molestie libero eu tincidunt feugiat. Vivamus vitae mattis mauris, sit amet porta eros. Phasellus id tortor sed elit lacinia volutpat.

Suspendisse vel placerat nisl. Maecenas tempor placerat tristique. Morbi ornare in ipsum a ultricies. Donec laoreet mollis nulla, id fermentum nulla sagittis nec. Nunc accumsan mi nulla, ut tristique nisl lobortis auctor. Donec euismod ac nibh vitae tristique. Donec volutpat eget libero quis elementum. Fusce sollicitudin dictum dictum. Phasellus tellus eros, lacinia a facilisis ut, laoreet non lorem.

Generated 5 paragraphs, 480 words, 3251 bytes of Lorem Ipsum Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla sollicitudin tortor, eget sodales neque congue a. Sed at semper tortor, eget lobortis libero. Vivamus rhoncus elit non diam eleifend vehicula. Praesent ut nisi porttitor massa hendrerit tempus. Ut ut libero et quam venenatis pellentesque sit amet vitae nisi. Fusce non tellus et arcu pellentesque pretium eget sed arcu. Mauris accumsan libero at sagittis condimentum. Aliquam gravida a massa in gravida. Nulla tristique eu felis et malesuada. In tempor placerat tellus quis blandit.

Cras sit amet turpis eu mi semper porta vitae in ante. Praesent lobortis nec enim et ornare. Sed erat felis, elementum et augue id, vehicula viverra odio. Donec at turpis ultricies, tincidunt turpis vel, laoreet magna. Donec blandit, risus non condimentum dignissim, ipsum sem viverra dolor, maximus tincidunt enim nisl non leo. Nullam et ligula vitae ante ullamcorper blandit at sed velit. Cras vitae risus vitae lectus euismod fringilla. Phasellus vitae condimentum mauris. Morbi quam metus, ullamcorper vitae pulvinar vel, ullamcorper ac nibh. Integer eleifend condimentum cursus. Cras ipsum lorem, tincidunt vel lorem non, feugiat pharetra dui. Sed convallis, enim dignissim dapibus lobortis, augue mauris porta sem, in semper nisl nunc vitae lorem. Pellentesque at ultricies libero.

Nam egestas est ut orci porttitor sagittis. Nulla vel ornare magna. Maecenas auctor ultrices felis. Proin vehicula justo ut urna luctus, bibendum venenatis felis sodales. Phasellus id purus tempor, mattis lectus vel, efficitur elit. Nullam eu feugiat quam. Suspendisse aliquet, velit non volutpat eleifend, erat ex facilisis nisl, nec dictum nisi leo vitae leo. Aenean porta sagittis arcu. Praesent aliquam posuere urna, in vehicula nunc congue at. Quisque vitae ultrices arcu. Nulla sed ligula tincidunt, ornare tortor non, commodo augue. Praesent consectetur, augue in lacinia tincidunt, metus enim porttitor purus, non finibus nibh augue et lorem. Nunc nec rhoncus turpis, eu egestas urna.

Donec ipsum mi, suscipit ut lectus id, fermentum consequat libero. Suspendisse lobortis sapien nisl, ac sagittis tortor euismod at. Suspendisse molestie vel elit sed pulvinar. Cras laoreet tincidunt libero id blandit. Vivamus pharetra arcu quis mauris efficitur dignissim. Nunc interdum varius urna eget viverra. Aliquam arcu felis, iaculis non eleifend eu, imperdiet ac tortor. Proin at dapibus diam. Nunc libero mauris, ultrices sed sapien ut, lacinia egestas turpis. Etiam dolor odio, maximus viverra bibendum quis, eleifend a massa. Vivamus eu turpis lorem. Integer congue, lectus et facilisis suscipit, tortor ex tempus lectus, congue cursus risus felis vitae justo. Proin molestie libero eu tincidunt feugiat. Vivamus vitae mattis mauris, sit amet porta eros. Phasellus id tortor sed elit lacinia volutpat.

Suspendisse vel placerat nisl. Maecenas tempor placerat tristique. Morbi ornare in ipsum a ultricies. Donec laoreet mollis nulla, id fermentum nulla sagittis nec. Nunc accumsan mi nulla, ut tristique nisl lobortis auctor. Donec euismod ac nibh vitae tristique. Donec volutpat eget libero quis elementum. Fusce sollicitudin dictum dictum. Phasellus tellus eros, lacinia a facilisis ut, laoreet non lorem.

Generated 5 paragraphs, 480 words, 3251 bytes of Lorem Ipsum';
    foreach (range(1, 15) as $i) {
        global $pdo;
        $title = 'Titre de l\'article ' . $i;
        $content = 'Contenu de l\'article ' . $i . $content;
        $stmt = $pdo->prepare("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $title, $content]);
    }
    echo "Création de l'article : $title\n";
}

//createFakeUser();
createFakeArticle(1);