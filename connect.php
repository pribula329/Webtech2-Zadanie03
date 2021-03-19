<?php
function postMetoda(){

    $conn = pokusLogin();
    $stm = $conn->prepare("INSERT INTO registracia (meno, priezvisko, email, nickname, heslo)
                                VALUES (?,?,?,?,?)");
    $stm->bindValue(1,$_POST["meno"]);
    $stm->bindValue(2, $_POST["priezvisko"]);
    $stm->bindValue(3, $_POST["email"]);
    $stm->bindValue(4, $_POST["nickname"]);
    $stm->bindValue(5, $_POST["heslo"]);;

    $stm->execute();
    session_start();
    $_SESSION["nickname"]=$_POST["nickname"];

}

function pokusLogin(){

    include_once("../config.php");

    try {
        $conn = new PDO("mysql:host=$servername;dbname=dbPribulikZadanie03",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    echo 'login';
    return $conn;


}