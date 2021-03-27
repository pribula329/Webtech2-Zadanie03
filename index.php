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

    if (isset($_SESSION['typ']) && $_SESSION['typ']=="reg" && !empty($_SESSION['typ'])){//ak ide od normalne prihlasenie
        if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname']) && isset($_SESSION['heslo']) && !empty($_SESSION['heslo'])){
            echo '<h3>Vitaj <strong>'.$_SESSION['nickname'].'</strong></h3>';
            include_once ("connect.php");
            $conn = pokusLogin();
            $stm = $conn->prepare("select id from registracia where nickname=?;");
            $stm->bindValue(1, $_SESSION['nickname']);

            $stm->execute();
            $existuje = $stm->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id']= $existuje['id'];
        }
        else{
            header('Location:'.'sign.php');
        }
    }
    elseif (isset($_SESSION['typ']) &&  $_SESSION['typ']=="google" && !empty($_SESSION['nickname'])){ //ak ide o google
        echo '<h3>Vitaj <strong>'.$_SESSION['nickname'].'</strong></h3>';
        include_once ("connect.php");
        $conn = pokusLogin();
    }
    elseif (isset($_SESSION['typ']) &&  $_SESSION['typ']=="stu" && !empty($_SESSION['nickname'])){
        echo '<h3>Vitaj <strong>'.$_SESSION['nickname'].'</strong></h3>';
        include_once ("connect.php");
        $conn = pokusLogin();
    }
    else{
        header('Location:'.'sign.php');
    }

    ?>

    <a href="logout.php">Odhlasenie</a>
    <br>
    <button id="zobrazit" type="button" class="btn btn-warning" onclick="zobrazit()">Zobraziť prihlásenia</button>
    <button id="skryt" type="button" class="btn btn-warning" onclick="skryt()">Skryť prihlásenia</button>
</div>
<div id="prihlasenia" >
<main  class="row">
<section  class="col-6">
    <h3>Tabuľka minulých prihlasení</h3>
    <div class=" tabulka">
    <table   class="table table-striped">
        <thead class="table-dark">
        <tr>
            <th scope="col">Nickname</th>
            <th scope="col">Dátum prihlasenia</th>
        </tr>
        </thead>
        <tbody>
        <?php


            $prihlasenia = minulePrihlasenia($conn,$_SESSION['id']);


            foreach ($prihlasenia as $hodnota)
            {
                echo '<tr>
                <td>'.$_SESSION['nickname']. '</td>
                <td>'.$hodnota["datum"]. '</td>
                </tr>';
            }
        ?>
        </tbody>

    </table>
    </div>
</section>
<section class="col-6" >
    <h3>Štatistika prihlasení</h3>
    <?php
    $statistika = statistika($conn);
    $reg =0;
    $google=0;
    $stu = 0;
    foreach ($statistika as $item){
        if ($item['typ']=='reg'){
            $reg=$reg+1;
        }
        else if ($item['typ']=='google'){
            $google=$google+1;
        }
        else if  ($item['typ']=='stu'){
            $stu=$stu+1;
        }
    }

    echo'<div id="graf"></div>';
    echo '<script type="text/javascript">graf('.$reg.','.$google.','.$stu.');</script>';
    ?>


</section>
</main>
</div>


<!-- JavaScript Bundle with Popper -->

</body>
</html>