<?php
    if(isset($_COOKIE["username"]) && $_COOKIE["signedin"]){
        setcookie("signedin", "", time()-3600);
        setcookie("username", "", time()-3600);
        setcookie("super", "", time()-3600);
        header("location: index.php");
        
        exit;
    } 
?>