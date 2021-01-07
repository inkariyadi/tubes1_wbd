<?php
    include "../connect.php";
    if($_GET['conpassword']==$_GET['password']){
        echo '0';
    }
    else{
        echo '1';
    }

?>