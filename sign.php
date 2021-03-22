<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){


    if (isset($_POST['nicknameP']) && !empty($_POST['nicknameP']) && isset($_POST['hesloP']) && !empty($_POST['hesloP'])){
        include_once("connect.php");
        prihlasenie();
        $problem = 'Zadané meno alebo heslo je nesprávne';
    }

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
    <h2>Prihlásenie</h2>

    <form  action="sign.php" method="post" enctype="multipart/form-data" class="row g-3 needs-validation"  novalidate>
        <div>
            <label for="validationPM" class="form-label">Používateľské meno</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationPM" name="nicknameP" required>
                <div class="invalid-feedback">
                    Prosím zadajte svoje užívateľské meno.
                </div>
            </div>
        </div>
        <div>
            <label for="validationHeslo" class="form-label">Heslo</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="validationHeslo" name="hesloP" required>
                <div class="invalid-feedback">
                    Prosím zadajte svoje heslo.
                </div>
            </div>
        </div>
        <span id="upozornenieY"></span>
        <span><?php echo $problem ?></span>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Prihlasiť</button>
        </div>
    </form>
    <br>
    <p>Nemáš účet? <a href="registracia.php">Registracia</a> </p>
</section>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>