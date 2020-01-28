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

if (isset($_POST['titre']) AND isset($_POST['contenu']))
{
    $req = $bdd->prepare('INSERT INTO blog (titre, contenu, date_creation) VALUES (:titre, :contenu, NOW())');
    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $_POST['contenu']
    ));
    header('Location: index.php');
}

?>

