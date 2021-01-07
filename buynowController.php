<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Something posted

        if (isset($_POST['submit_buy'])) {
            include_once 'connect.php';
            $quantity = $_REQUEST['quantity'];
            $total_price = $_REQUEST['total_price'];
            $address = $_POST['address'];
            $id_coklat = $_REQUEST['id_coklat'];
            $cursold = $_REQUEST['cursold'];
            $totalsold = $cursold + $quantity ;
            $user = $_COOKIE['username'];
            echo $quantity;
            echo $total_price;
            echo $address;
            echo $id_coklat;
            echo $cursold;
            echo $totalsold;
            $sql = "INSERT INTO order_chocolate(username, idcoklat, jumlah, harga_total, address) VALUES ('$user','$id_coklat','$quantity', '$total_price', '$address');";
            echo $sql;
            $result = mysqli_query($list, $sql);
            $sql_2 = "UPDATE chocolate SET stok_terjual='$totalsold' WHERE id='$id_coklat';";
            echo $sql_2;
            $result_2 = mysqli_query($list, $sql_2);
            // ADDING SALDO FACTORY
            $raw_data = file_get_contents('http://localhost:3007/api/saldo');
            $data = json_decode($raw_data, true);
            $saldoawal = $data[0]['saldo_pabrik'];
            echo $saldoawal;
            $curl = curl_init();
            $url = sprintf('%s%s%s%s', 'http://localhost:3007/api/addsaldo/',(string)$saldoawal, '/', (string)$total_price);
            echo $url;
            curl_setopt($curl ,CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            $resultcurl = curl_exec($curl);
            echo $resultcurl + '\n';
            curl_close($curl);
            if($result and $result_2){
                echo("success!");
                header("Location: history.php");
            }
        } else {
            echo("you cancelled!");
        }
    }
    
?>