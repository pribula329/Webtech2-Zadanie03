<?php
    require_once 'PHPGangsta/GoogleAuthenticator.php';


function codeCheck($secret,$code)
{


        $ga = new PHPGangsta_GoogleAuthenticator();
        $result = $ga->verifyCode($secret, $code);

    return $result;
}
?>