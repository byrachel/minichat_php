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

<h2>Ajouter un post</h2>
<form action="add_post_dbb.php" method="POST">
    <p><input type="text" name="titre" size="100" placeholder="Titre" /></p>
    <p><textarea name="contenu" rows="10" cols="100" placeholder="Contenu"></textarea></p>
    <button type="submit">Envoyer</button>
</form>

</body>
</html>