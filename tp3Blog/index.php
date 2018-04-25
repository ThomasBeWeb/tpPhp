<?php

//Connexion BDD

try{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

//Recuperation des 5 derniers billets

$reponse = $bdd->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 5');

$giveMeFive = $reponse->fetchAll();

?>

<!DOCTYPE html>

<html>

<head>
    <title>Mini Chat</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <h1>Mon super blog !</h1>
    <br>
    <p>Derniers billets du blog:</p>

    <div class="news">

    <?php

    foreach ($giveMeFive as $data){

        echo "<h3>".$data['titre']."</h3>";

        echo "<p>".$data['contenu']."<br>";

        echo "<a href='commentaires.php?id=".$data['id']."'>Commentaires</a></p>";
    }
    ?>
    </div>

</body>
</html>

