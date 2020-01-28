
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

    // ajout des messages dans la BDD

    if (isset($_POST['pseudo']) AND isset($_POST['commentaire']))
    {
        $req = $bdd -> prepare('INSERT INTO minichat (pseudo, commentaire) VALUES (:pseudo, :commentaire)');
        $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'commentaire' => $_POST['commentaire']
        ));
        header('Location: index.php');
    }

?>

