<?php

//Connexion BDD

try{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

if(!empty($_GET)){

    //Recuperation de l'id du billet selectionné
    $id = intval($_GET['id']);

    //Ajout d'un nouveau commentaire si POST

    if(!empty($_POST)){

        $auteur = $_POST['auteur'];
        $message = $_POST['message'];
        $dateDuCommentaire = date("Y-m-d H:i:s"); //Date et heure du moment

        $req = $bdd->prepare('INSERT INTO commentaires(id_billet, auteur, commentaire, date_commentaire) VALUES(?,?,?,?)');
        $req->execute(array($id,$auteur,$message,$dateDuCommentaire));

    }

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
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
<h2><b>Ajouter un commentaire</b></h2>

<div class="container">
    <div class="row">

        <form class="form" action="commentaires.php?id=<?php echo $id; ?>" role="form" method="post">

            <div class="input-group mb-3 col-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Auteur</span>
                </div>
                <input type="text" class="form-control text-center" id="auteur" name="auteur" aria-label="auteur"
                       aria-describedby="basic-addon1" style="max-width: 200px">
            </div>

            <div class="input-group mb-3 col-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Message</span>
                </div>
                <input type="text" class="form-control text-center" id="message" name="message" aria-label="pwd"
                       aria-describedby="basic-addon1" style="max-width: 200px">
            </div>

            <button type="submit" class="btn btn-outline-success">Publier</button>
        </form>
    </div>
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

