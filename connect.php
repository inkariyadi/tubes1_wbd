<?php

$server = 'localhost';
$username   = 'root';
$password   = 'inkink';
$database   = 'wbd5';

$list=mysqli_connect($server, $username, $password);
 
if(!$list)
{   
    // echo 'could not establish';
    exit('Error: could not establish database connection');
}
else{
    // echo 'berhasil 1';
}
if(!mysqli_select_db($list,$database))
{   
    // echo 'could not select database';
    exit('Error: could not select the database');
}
else{
    // echo 'berhasil 1';
}

include 'cekStatusPemesanan.php';

?>