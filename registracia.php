<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

//kontrola registracie
    if ($_POST['heslo']!=$_POST['heslo2']){
        $problem = "Heslá sa nezhodujú!!!";
    }

    else{
        include_once("connect.php");
        kontrolaNickname();
        $problem = "Daný nickname už je obsadený!!!";

    }
}
else{
    $problem='';
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dizajn.css">
</head>
<body class="container">
<h1>PriStat</h1>
<section class="formular">
    <h2>Registrácia</h2>

    <form  action="registracia.php" method="post" enctype="multipart/form-data" class="row g-3 needs-validation"  novalidate>
        <div>
            <label for="validationMeno" class="form-label">Meno</label>
            <input type="text" class="form-control" id="validationMeno" name="meno" onkeypress="kontrola(id)" required>
            <div class="invalid-feedback">
                Prosím zadajte meno
            </div>
        </div>
        <div>
            <label for="validationPriezvisko" class="form-label">Priezvisko</label>
            <input type="text" class="form-control" id="validationPriezvisko" name="priezvisko" onkeypress="kontrola(id)" required>
            <div class="invalid-feedback">
                Prosím zadajte priezvisko
            </div>
        </div>
        <div>
            <label for="validationEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="email" class="form-control" id="validationEmail" name="email" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Prosím zadajte svoj email
                </div>
            </div>
        </div>
        <div>
            <label for="validationPM" class="form-label">Používateľské meno</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationPM"  name="nickname" required>
                <div class="invalid-feedback">
                    Prosím zvoľte si užívateľské meno.
                </div>
            </div>
        </div>
        <div>
            <label for="validationHeslo" class="form-label">Heslo</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" id="validationHeslo" name="heslo" required>
                <div class="invalid-feedback">
                    Prosím zvoľte si heslo.
                </div>
            </div>
        </div>
        <div>
            <label for="validationHeslo2" class="form-label">Kontrola hesla</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" id="validationHeslo2" name="heslo2" required>
                <div class="invalid-feedback">
                    Prosím skontrolujte si heslo.
                </div>

            </div>
            <input class="form-check-input me-1" type="checkbox" onclick="registraciaHeslo()"> Zobraziť heslo
            <span id="upozornenieY"></span>
            <span><?php echo $problem ?></span>
        </div>




        <div class="col-12">
            <button class="btn btn-primary" type="submit">Registrovať</button>
            <a href="signGoogle.php"><img class="google" src="img/google.jpg" alt="google"></a>
            <a href="signLDAP.php"><img class="logo" src="img/STULogo.png" alt="stuba"></a>
        </div>
    </form>
    <br>
    <p>Máš účet? <a href="sign.php">Prihlásenie</a> </p>
</section>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>