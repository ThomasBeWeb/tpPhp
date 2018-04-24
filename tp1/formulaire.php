<?php

if(!empty($_POST)){
    if($_POST['pwd'] == "kangourou"){
        header('Location: secret.php');
    }
}
?>
<!DOCTYPE html>

<html>

<head>
    <title>TP1</title>
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

        <h3>Login</h3>

        <form class="form-inline" action="formulaire.php" role="form" method="post">

            <div class="input-group mb-3 col-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text sr-only" id="basic-addon1">Login</span>
                </div>
                <input type="text" class="form-control text-center" id="login" name="login" aria-label="login"
                       aria-describedby="basic-addon1" style="max-width: 200px">
            </div>

            <div class="input-group mb-3 col-auto">
                <div class="input-group-prepend">
                    <span class="input-group-text sr-only" id="basic-addon1">Login</span>
                </div>
                <input type="password" class="form-control text-center" id="pwd" name="pwd" aria-label="pwd"
                       aria-describedby="basic-addon1" style="max-width: 200px">
            </div>


            <button type="submit" class="btn btn-outline-success">Valider</button>
    </div>

    </form>
</div>


</div>

</body>
</html>

