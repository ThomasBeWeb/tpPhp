<?php

//Connexion BDD

try{
    $bdd = new PDO('mysql:host=localhost;dbname=membres;charset=utf8', 'root', 'password', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}

if(!empty($_POST)){

    //Verification des 2 mots de passe
    if($_POST['password1'] == $_POST['password2']){

        // Hachage du mot de passe
        $pass_hache = password_hash($_POST['password1'], PASSWORD_DEFAULT);

        //Date du jour
        $dateInscription = date("Y-m-d H:i:s");

        //Login et couriel

        $login = $_POST['pseudo'];
        $email = $_POST['email'];

        // Insertion
        $req = $bdd->prepare('INSERT INTO users(pseudo, pass, couriel, date_inscription) VALUES(?,?,?,?)');
        $req->execute(array($login, $pass_hache, $email, $dateInscription));

        //Retour a la page de connexion
        header('Location: connexion.php');
    }

}

?>

<!DOCTYPE html>

<html>

<head>
    <title>Inscription</title>
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

<div class="container">

    <div class="row">

        <div class="col-5 offset-3">

            <form class="form" action="inscription.php" role="form" method="post">

                <!--PSEUDO-->
                <div class="form-row">
                    <div class="form-group col">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Pseudo</div>
                            </div>
                            <input type="text" class="form-control" id="pseudo" name="pseudo">
                        </div>
                    </div>
                </div>

                <!--PASSWORD-->
                <div class="form-row">
                    <div class="form-group col">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Mot de passe</div>
                            </div>
                            <input type="password" class="form-control" id="password1" name="password1">
                        </div>
                    </div>
                </div>

                <!--VERIF PASSWORD-->
                <div class="form-row">
                    <div class="form-group col">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Répetez le mot de passe</div>
                            </div>
                            <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                    </div>
                </div>

                <!--EMAIL-->
                <div class="form-row">
                    <div class="form-group col">
                        <div class="input-group ">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Email</div>
                            </div>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-success">Inscription</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

