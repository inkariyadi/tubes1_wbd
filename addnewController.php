<?php
    if (isset($_POST['addnew'])) {
        include_once 'connect.php';
        $nama = $_REQUEST['name'];
        $harga = $_REQUEST['price'];
        $description = $_REQUEST['description'];
        $file = $_FILES['fileUploaded'];
        $amount = $_REQUEST['amount'];
        $idbahan = $_POST['idbahan'];
        $namabahan = $_POST['namabahan'];
        $amtbahan = array();
        foreach ($namabahan as $id){
            echo $id;
            $temp = $_REQUEST[$id];
            echo $temp;
            array_push($amtbahan, $temp);
        }
        echo $nama;
        echo $harga;
        echo $description;
        echo $amount;
        // echo $namabahan[1];
        // echo $idbahan[1];
        // echo $amtbahan[1];
        print_r($file);
        echo($_FILES['fileUploaded']['name']);

        // file handler
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType =  $file['type'];
        $fileError = $file['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        if(in_array($fileActualExt , $allowed)){
            if($fileError===0){
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'img/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "INSERT INTO chocolate(nama, harga, image, description, stok_total, stok_terjual) VALUES ('$nama','$harga', '$fileDestination' ,'$description', '$amount', '0');";
                $result = mysqli_query($list, $sql);
            }else{
                echo("ada error");
            }
        }else{
            echo("this is not a picture");
        }
        $sql2 = "SELECT id FROM chocolate WHERE nama='$nama' LIMIT 1;";
        $result2 = mysqli_query($list, $sql2);
        $idcoklat = mysqli_fetch_assoc($result2);
        echo $idcoklat['id'];
        $curl = curl_init();
        $newname = str_replace(" ","",$nama);
        for ($x = 0; $x < count($namabahan); $x++) {
            $url = sprintf('%s%s%s%s%s%s%s%s%s%s', 'http://localhost:3007/api/addresep/', (string)$idcoklat['id'], '/',  (string)$newname, '/',  (string)$idbahan[$x], '/',  (string)$namabahan[$x], '/',  (string)$amtbahan[$x] );
            echo $url;
            // echo '--------';
            curl_setopt($curl ,CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            $result = curl_exec($curl);
            // echo $result + '\n';
        }
        curl_close($curl);
        // header("Location: home.php");
    }else{
        echo ("mencet apa?");
    }

    // header("Location: addnew.php")
?>