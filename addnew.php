<?php
    include "header.php";
    include "connect.php";
    if(!isset($_COOKIE["username"]) && !$_COOKIE["signedin"]){
        header("location: index.php");
        exit;
    }
    $user = $_COOKIE["username"];
    $sql = "SELECT issuper FROM user WHERE username='$user' LIMIT 1;";
    $result = mysqli_query($list, $sql);
    $issuper = mysqli_fetch_assoc($result);
    if($issuper == 0){
        header("location: home.php");
        exit;
    }
    // get from supplier
    $raw_data = file_get_contents('http://localhost:3005/api/getListBahan');
    $data = json_decode($raw_data, true);
    $total = 0;
    // $bahan = array('gula', 'pewarna', 'vanili', 'cocoa');
    foreach($data as $row) {
        $value[$row['nama_bahan']] = isset($_POST[$row['nama_bahan']]) ? $_POST[$row['nama_bahan']] : 0;
    }
    if(isset($_POST['checkprice']))
    {
        $action =  '';
        $_POST['addnew'] = 0;
        $namabahan = $_POST['namabahan'];
        $hargasatuan = $_POST['hargasatuan'];
        $amtbahan = array();
        foreach ($namabahan as $id){
            echo $id;
            $temp = $_REQUEST[$id];
            echo $temp;
            array_push($amtbahan, $temp);
        }
        // $total = 0;
        for ($x = 0; $x < count($namabahan); $x++) {
            echo $namabahan[$x], $amtbahan[$x], $hargasatuan[$x];
            $temp = $amtbahan[$x] * $hargasatuan[$x];
            $total+=$temp;
        }
        echo($total);
    }else if(isset($_POST['addnew'])){
        $_POST['checkprice'] = 0;
        $total = isset($_POST['total']) ? $_POST['total'] : 0;
        $action = "addnewController.php";
    }
?>

<http>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Willy Wonka</title>
        <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
        <link rel="stylesheet" href="css/addnewstyle.css">
    </head>
    <body>
        <div class="main">
            <p>ADD NEW CHOCOLATE</p>
            <form class="address-input" action= "<?php echo $action; ?>" method='POST' enctype="multipart/form-data">
                <div class="ta-wrapper">
                    <label>Name</label>
                    <textarea name="name" id="address_text" cols="30" rows="1" ></textarea>
                </div>
                <div class="ta-wrapper">
                    <label>Price</label>
                    <textarea name="price" id="address_text" cols="30" rows="1" type="number" ></textarea>
                </div>
                <div class="ta-wrapper">
                    <label>Description</label>
                    <textarea class="desc" name="description" id="address_text" cols="30" rows="5" ></textarea>
                </div>
                <div class="ta-wrapper-img">
                    <label>Image</label>
                    <input class="img" type="file" name="fileUploaded"  >
                </div>
                <div class="ta-wrapper">
                    <label>Amount</label>
                    <textarea name="amount" id="address_text" cols="30" rows="1" type="number" ></textarea>
                </div>
                <p>Resep Coklat</p>
                <?php
                    foreach ($data as $row) {
                ?>
                <div class="ta-wrapper">
                    <label><?=$row['nama_bahan']?></label>
                    <textarea class="quantity" name=<?=$row['nama_bahan']?> id="quantity" cols="10" rows="1" type="number" required><?= $value[$row['nama_bahan']]; ?></textarea>
                </div>
                <?php
                    }
                    foreach($data as $row)
                    {
                        echo '<input type="hidden" name="idbahan[]" value="'. $row['id_bahan']. '">';
                        echo '<input type="hidden" name="namabahan[]" value="'. $row['nama_bahan']. '">';
                        echo '<input type="hidden" name="hargasatuan[]" value="'. $row['harga_satuan']. '">';
                    }
                ?>
                <input type="hidden" name='total' value='<?= $total; ?>'/>
                <p>Total harga bahan : <?= $total; ?></p>
                <input class="addnew" type='submit' name='addnew' value='Add Chocolate'/>
                <input class="addnew" type='submit' name='checkprice' value='Check Price'/>
            </form>
        </div>
    </body>
</http>