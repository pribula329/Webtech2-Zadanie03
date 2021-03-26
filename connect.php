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

    session_start();
    $_SESSION["nickname"]=$_POST["nickname"];
    $_SESSION["heslo"]=$hesloHash;
    header('Location:'.'start.php');

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

        include_once ("check.php");
        if (codeCheck($existuje['secret_code'],$_POST['validationCode'])) {
            vlozenieLoginu($conn, $existuje["id"],"reg");

            session_start();
            $_SESSION["nickname"] = $_POST["nicknameP"];
            $_SESSION["heslo"] = $existuje['heslo'];
            $_SESSION["typ"] = "reg";
            header('Location:' . 'index.php');
        }
    }

}

function vlozenieLoginu($conn,$id,$typ){

    $stm5 = $conn->prepare("INSERT INTO loginy (id_uzivatela, datum, typ)
                                VALUES (?,?,?)");
    $stm5->bindValue(1,$id);
    $stm5->bindValue(2, date("Y-m-d"));
    $stm5->bindValue(3, $typ);
    $stm5->execute();
}

function minulePrihlasenia($conn,$id){



    $stm2 = $conn->prepare("select datum from loginy where id_uzivatela = ? ;");

    $stm2->bindValue(1, $id);


    $stm2->execute();

    $prihlasenia = $stm2->fetchAll(PDO::FETCH_ASSOC);


return $prihlasenia;

}


function statistika($conn){

    $stm = $conn->prepare("select * from loginy;");

    $stm->execute();
    $statistiky = $stm->fetchALl(PDO::FETCH_ASSOC);
    return $statistiky;
}
