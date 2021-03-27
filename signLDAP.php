<?php

if ($_SERVER['REQUEST_METHOD']=="POST") {
    // using ldap bind

    $ldapuid = $_POST['stubaMeno'];
    $ldappass = $_POST['stubaHeslo'];


    $dn = 'ou=People, DC=stuba, DC=sk';
    $ldaprdn = "uid=$ldapuid, $dn";
// connect to ldap server
    $ldapconn = ldap_connect("ldap.stuba.sk")
    or die("Could not connect to LDAP server.");

    if ($ldapconn) {
        $set = ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        // binding to ldap server
        $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

        // verify binding
        if ($ldapbind) {
            session_start();
            $results=ldap_search($ldapconn,$dn,"uid=".$_POST['stubaMeno'],array("surname","uisid","uid"),0,1);
            $info=ldap_get_entries($ldapconn,$results);
            $_SESSION['id']=$info[0]['uisid'][0];
            $_SESSION['nickname']=$info[0]['uid'][0];
            $_SESSION['typ']="stu";
            include_once ("connect.php");
            $conn = pokusLogin();
            vlozenieLoginu($conn,$_SESSION['id'],"stu");
            ldap_unbind($ldapconn);
            header('Location:'.'index.php');
        } else {
            $problem1 = 'Zadané meno alebo heslo je nesprávne';
        }

    }

    ldap_unbind($ldapconn);


}
else{
    $problem1 = "";
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
    <img  src="img/stufull.png" alt="stubalogo">
    <h2>Prihlásenie </h2>

    <form  action="signLDAP.php" method="post" enctype="multipart/form-data" class="row g-3 needs-validation"  novalidate>
        <div>
            <label for="stubaMeno" class="form-label">Stuba používateľské meno</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="stubaMeno" name="stubaMeno" required>
                <div class="invalid-feedback">
                    Prosím zadajte svoje užívateľské meno.
                </div>
            </div>
        </div>
        <div>
            <label for="stubaHeslo" class="form-label">Heslo</label>
            <div class="input-group has-validation">
                <input type="password" class="form-control" id="stubaHeslo" name="stubaHeslo" required>
                <div class="invalid-feedback">
                    Prosím zadajte svoje heslo.
                </div>
            </div>

            <input class="form-check-input me-1" type="checkbox" onclick="stuHeslo()"> Zobraziť heslo


        </div>

        <span id="upozornenieY"></span>
        <span><?php echo $problem1 ?></span>


        <div class="col-12">
            <button class="btn btn-primary" type="submit">Prihlasiť</button>
            <a href="signGoogle.php"><img class="google" src="img/google.jpg" alt="google"></a>
            <a href="signLDAP.php"><img class="logo" src="img/STULogo.png" alt="stuba"></a>
        </div>
    </form>
    <br>
    <p>Máš účet? <a href="sign.php">Prihlásenie</a>
    <br>
    Nemáš účet? <a href="registracia.php">Registracia</a> </p>
</section>
<!-- JavaScript Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>