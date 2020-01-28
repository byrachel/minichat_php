<?php

if (!empty($_POST['auteur']) && !empty($_POST['commentaires']))
{
    // connexion à la BDD
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test','root','root');
    }
        catch(Exception $e)
    {
        die('Erreur : ' .$e -> getMessage());
    }

    // ajout du commentaire dans le BDD

    $req = $bdd->prepare('INSERT INTO commentaire(id_billet, auteur, commentaires, date_ajout) VALUES(:id_billet, :auteur, :commentaires, NOW())');
    $req->execute(array(
        'id_billet'=> htmlspecialchars($_GET['id_billet']),
        'auteur'=>htmlspecialchars($_POST['auteur']),
        'commentaires'=>nl2br(htmlspecialchars($_POST['commentaires']))
    ));

}


?>