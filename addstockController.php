<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Something posted

        if (isset($_POST['submit_add'])) {
            include_once 'connect.php';
            $amount = $_REQUEST['amount'];
            $id = $_REQUEST['idchoc'];
            $curstock = $_REQUEST['curstock'];
            $newstock = $curstock + $amount;
            // echo $amount;
            // echo $id;
            // echo $curstock;
            // echo $newstock;
            $curl = curl_init();
            $url = sprintf('%s%s%s%s', 'http://localhost:3007/api/addstock/', (string)$id, '/amount/',  (string)$amount);
            echo $url;
            curl_setopt($curl ,CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            $result = curl_exec($curl);
            echo $result + '\n';
            curl_close($curl);
            // $sql = "UPDATE chocolate SET stok_total='$newstock' WHERE id='$id';";
            // $result = mysqli_query($list, $sql);
            // if($result){
            //     echo("success!");
            // }
            header("Location: detail.php");
        } else {
            echo("you cancelled!");
            header("Location: detail.php");
        }
    }
    
?>