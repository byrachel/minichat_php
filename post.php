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


    // affichage de l'article
    if(isset($_GET['id_billet']))
    {
        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y \') AS date_creation FROM blog WHERE id=?');
        $req->execute(array(htmlspecialchars($_GET['id_billet'])));
        $data = $req->fetch();
        // Si les données ne sont pas vides
        if(!empty($data))
        {
            echo '<h3>' . htmlspecialchars($data['titre']) . '</h3><p>' . htmlspecialchars($data['contenu']) . '</p><p id="comment">Posté le: ' . $data['date_creation'] . '</p><br/>';
        }
        $req->closeCursor();

        // affichage des commentaires
        $rep = $bdd->prepare('SELECT * FROM commentaire WHERE id_billet=?');
        $rep->execute(array($_GET['id_billet']));
        while($data = $rep->fetch())
        {
            echo '<p>' . htmlspecialchars($data['auteur']) . ' : ' . htmlspecialchars($data['commentaires']) . '</p><p id="comment">Posté le: ' . $data['date_ajout'] . '</p><br/>';
        }     

?>

<h2>Ajouter un commentaire</h2>

<form action="comment.php?id_billet=<?php echo $_GET['id_billet']; ?>" method="POST">
    <input type="text" name="auteur" size="50" placeholder="Auteur">
    <input type="text" name="commentaires" size="50" placeholder="Commentaire">
    <button type="Submit">Valider</button>
</form>

<?php
        $rep->closeCursor();
    }
    else { echo "<p>Aucun article n'est disponible.</p>";}

?>
</body>
</html>
