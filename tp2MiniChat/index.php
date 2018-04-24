<?php

//Connexion BDD

try{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
}

//Variables

$login = $message = "";

//Insertion du nouveau message

if(!empty($_POST)){
    $login = $_POST['login'];
    $message = $_POST['message'];

    $req = $bdd->prepare('INSERT INTO minichat(login, message) VALUES(:login, :message)');
    $req->execute(array(
        'login' => $login,
        'message' => $message
    ));

}

?>

<!DOCTYPE html>

<html>

<head>
    <title>Mini Chat</title>
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

</head>

<body>

<div class="container">

    <br>
    <div class="row">

        <form class="form" action="index.php" role="form" method="post">

            <div class="input-group mb-3 col-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Login</span>
                </div>
                <input type="text" class="form-control text-center" id="login" name="login" aria-label="login"
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

    <div class="row">

        <br>
        <br>
        <br>

        <p>

        <?php

        $reponse = $bdd->query('SELECT * FROM minichat ORDER BY ID DESC');

        $donnees = $reponse->fetchAll();

        foreach ($donnees as $data){

            echo "<b>".$data['login'].":</b> ".$data['message']."<br>";
        }
        ?>

        </p>

    </div>

</div>

</body>
</html>

