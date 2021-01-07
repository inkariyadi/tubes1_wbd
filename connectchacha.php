<?php

$server = 'localhost';
$username   = 'root';
$password   = 'root';
$database   = 'tubes_wbd';

// $list=mysqli_connect($server, $username, $password);
// $conn = mysqli_select_db($list,$database);
$con = mysqli_connect($server,$username,$password,$database);
// $mysqli->select_db($db);

// if(!$con){
//     echo("not connected");
// }

?>