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

<h2>MiniChat</h2>
<form action="minichat.php" method="POST">
    <input type="text" name="pseudo" size="50" placeholder="Pseudo" />
    <input type="text" name="commentaire" size="50" placeholder="Message" />
    <button type="submit">Envoyer</button>
</form>


<h2>Derniers Messages</h2>
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

// affichage des messages

$rep = $bdd->query('SELECT pseudo, commentaire, DATE_FORMAT(date_ajout, \'%d/%m/%Y à %Hh%i\') AS date_ajout FROM minichat ORDER BY ID DESC LIMIT 10');
while ($data = $rep->fetch())
{
    echo '<p>' . htmlspecialchars($data['commentaire']) . '</p><p id="comment">' . htmlspecialchars($data['pseudo']) . ' - Posté le: ' . $data['date_ajout'] . '</p><br/>';
}

$rep->closeCursor();

?>


</body>
</html>