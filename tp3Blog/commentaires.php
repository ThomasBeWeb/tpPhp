<?php

//Connexion BDD



try{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

//Recuperation des commentaires pour ce billet

if(!empty($_GET)){

    //Recuperation de l'id du billet selectionné
    $id = intval($_GET['id']);

    //Requete pour afficher le billet en cours
    $reponse = $bdd->query('SELECT * FROM billets WHERE id = '.$id); //' ORDER BY date_commentaire ASC'

    $giveMeTheBillet = $reponse->fetch();

    //Requete pour recuperer les commentaires lies à ce billet
    $reponse2 = $bdd->query('SELECT *,
    DATE_FORMAT(date_commentaire, "%d/%m/%Y") AS dateDuBillet,
    DATE_FORMAT(date_commentaire, "%Hh%imin%ss") AS heureDuBillet
    FROM commentaires WHERE id_billet = '.$id);

    $giveMeComments = $reponse2->fetchAll();

}
?>

<!DOCTYPE html>

<html>

<head>
    <title>Commentaires</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
<h1>Mon super blog !</h1>
<br>
<a href="index.php">Retour à la liste des billets</a>

<div class="news">

    <?php

        echo "<h3>".$giveMeTheBillet['titre']."</h3>";

        echo "<p>".$giveMeTheBillet['contenu']."</p>";
    ?>
</div>
<br>
<h2><b>Commentaires</b></h2>

<?php

foreach ($giveMeComments as $data){

    //Conversion date et heure

    $dateDuCommentaire = $data['dateDuBillet'];
    $heureDuCommentaire = $data['heureDuBillet'];

    echo "<p><b>".$data['auteur']."</b> le ".$dateDuCommentaire." à ".$heureDuCommentaire."</p>";

    echo "<p>".$data['commentaire']."<br>";

}
?>

</body>
</html>

