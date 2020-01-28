<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php
    // connexion à la BDD
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test','root','root');
    }
    catch(Exception $e)
    {
        die('Erreur : ' .$e -> getMessage());
    }
?>

<h2>Le blog</h2>

<?php

    // affichage des articles de blog
    $rep = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y \') AS date_creation FROM blog ORDER BY ID DESC');
    while ($data = $rep->fetch())
    {
        echo '<h3><a href="post.php?id=' .$data['id']. '">' . htmlspecialchars($data['titre']) . '</a></h3><p>' . nl2br(htmlspecialchars($data['contenu'])) . '</p><p id="comment">Posté le: ' . $data['date_creation'] . '</p><br/>';
    }

    $rep->closeCursor();

?>
<a href="add_post.php">Ajouter un post</a>
<p>_ _ _ _ _</p>

<h2>MiniChat</h2>
<form action="minichat.php" method="POST">
    <input type="text" name="pseudo" size="50" placeholder="Pseudo" />
    <input type="text" name="commentaire" size="50" placeholder="Message" />
    <button type="submit">Envoyer</button>
</form>

<h2>Derniers Messages</h2>

<?php

// affichage des messages du minichat

$rep = $bdd->query('SELECT pseudo, commentaire, DATE_FORMAT(date_ajout, \'%d/%m/%Y à %Hh%i\') AS date_ajout FROM minichat ORDER BY ID DESC LIMIT 10');
while ($data = $rep->fetch())
{
    echo '<p>' . htmlspecialchars($data['commentaire']) . '</p><p id="comment">' . htmlspecialchars($data['pseudo']) . ' - Posté le: ' . $data['date_ajout'] . '</p><br/>';
}

$rep->closeCursor();

?>


</body>
</html>