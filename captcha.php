<?php
if (isset($_POST["g-recaptcha-response"]) && $_POST["g-recaptcha-response"]) {
    var_dump($_POST);
    $secret = "6LfOs80pAAAAALPG7IlEM115Ep7Nlx6J49_P2CD5";
    $ip = $_SERVER["REMOTE_ADDR"];
    
    $captcha = $_POST["g-recaptcha-response"];
    
    $result = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
    
    echo "<br>";
    echo "<br>";
    echo "<br>";
    var_dump($result);
    
    $array = json_decode($result, TRUE);
    echo "<br>";
    
    if ($array["success"]) {
        echo "É humano";
    } else {
        echo "É um robô";
    }
}
?>