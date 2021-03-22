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
    <?php
    session_start();
    if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname']) && isset($_SESSION['heslo']) && !empty($_SESSION['heslo'])){
        echo 'Vitaj '.$_SESSION['nickname'];
    }
    else{
        header('Location:'.'sign.php');
    }
    ?>

    <a href="logout.php">Odhlasenie</a>
</section>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>