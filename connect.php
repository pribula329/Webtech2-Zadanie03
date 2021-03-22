<?php
function postMetoda($conn){
    $hesloHash = password_hash($_POST['heslo'], PASSWORD_DEFAULT);

    $stm = $conn->prepare("INSERT INTO registracia (meno, priezvisko, email, nickname, heslo)
                                VALUES (?,?,?,?,?)");
    $stm->bindValue(1,$_POST["meno"]);
    $stm->bindValue(2, $_POST["priezvisko"]);
    $stm->bindValue(3, $_POST["email"]);
    $stm->bindValue(4, $_POST["nickname"]);
    $stm->bindValue(5, $hesloHash);;

    $stm->execute();
    vlozenieLoginu($conn,$conn->lastInsertId());
    session_start();
    $_SESSION["nickname"]=$_POST["nickname"];
    $_SESSION["heslo"]=$hesloHash;
    header('Location:'.'index.php');

}

function kontrolaNickname(){

    $conn = pokusLogin();
    $stm = $conn->prepare("select * from registracia where nickname = ?");
    $stm->bindValue(1, $_POST["nickname"]);


    $stm->execute();
    $existuje = $stm->fetch(PDO::FETCH_ASSOC);

    if ($existuje==false){
        postMetoda($conn);
    }
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

    return $conn;


}

function prihlasenie(){

    $conn = pokusLogin();
    $stm = $conn->prepare("select * from registracia where nickname = ?");
    $stm->bindValue(1, $_POST["nicknameP"]);


    $stm->execute();
    $existuje = $stm->fetch(PDO::FETCH_ASSOC);

    if ($existuje==true && (password_verify($_POST['hesloP'], $existuje['heslo']))){

        vlozenieLoginu($conn,$existuje["id"]);

        session_start();
        $_SESSION["nickname"]=$_POST["nicknameP"];
        $_SESSION["heslo"]=$existuje['heslo'];
        header('Location:'.'index.php');

    }

}

function vlozenieLoginu($conn,$id){
    var_dump($conn);
    $stm = $conn->prepare("INSERT INTO loginy (id_uzivatela, datum, typ)
                                VALUES (?,?,?)");
    $stm->bindValue(1,$id);
    $stm->bindValue(2, date("Y-m-d"));
    $stm->bindValue(3, "reg");
    $stm->execute();
}
