<?php
$url = 'http://localhost:3007/api/datastok/notdelivered';
$raw_data = file_get_contents($url);
$data = json_decode($raw_data, true);
foreach ($data as $pesanan){

    $jumlah = (string)$pesanan['jumlah'];
    $id = (string)$pesanan['id_coklat'];
    echo $id;
    $sql = "UPDATE chocolate SET stok_total=stok_total+'$jumlah' WHERE id='$id'";
    $res = mysqli_query($list, $sql);


    echo $pesanan['id_addstock'];
    $curl = curl_init();
    $url = sprintf('%s/%s', 'http://localhost:3007/api/datastok/deliver', (string)$pesanan['id_addstock']);
    curl_setopt($curl ,CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    $result = curl_exec($curl);
    curl_close($curl);
}
?>