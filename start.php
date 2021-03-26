<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dizajn.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body class="container">
<h1>PriStat</h1>
<div class="formular">
    <?php
    session_start();
    if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname']) && isset($_SESSION['heslo']) && !empty($_SESSION['heslo'])){
        echo '<h3>Vitaj <strong>'.$_SESSION['nickname'].' tvoj QR-kód je</strong></h3>';
        require_once 'PHPGangsta/GoogleAuthenticator.php';

        $websiteTitle = 'PribulikZadanie03';

        $ga = new PHPGangsta_GoogleAuthenticator();

        $secret = $ga->createSecret();

        $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
        echo 'Google Charts URL QR-Code:<br /><img src="'.$qrCodeUrl.'" />';

        $myCode = $ga->getCode($secret);

//third parameter of verifyCode is a multiplicator for 30 seconds clock tolerance
        $result = $ga->verifyCode($secret, $myCode, 1);

        include_once ("connect.php");
        $conn = pokusLogin();
        $stm = $conn->prepare("UPDATE registracia SET secret_code=? WHERE registracia.nickname=?");
        $stm->bindValue(1,$secret);
        $stm->bindValue(2,$_SESSION['nickname']);
        $stm->execute();

    }
    else{
        header('Location:'.'sign.php');
    }
    ?>

</div>
<div>Tento kód si naskenuj do GOOGLE AUTENTIFICATOR</div>
<a href="sign.php"> Prihlasenie</a>

</body>
</html>
