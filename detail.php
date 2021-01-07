<?php
    if(!isset($_COOKIE["username"]) && !$_COOKIE["signedin"]){
        header("location: index.php");
        exit;
    }
    include_once 'connect.php';
    if(!isset($_GET['idcoklat'])){
        header("location: home.php");
        exit;
    }
    $id = $_GET['idcoklat'];
    // id coklat nanti diganti sama  id yang di pass dari detail
    $sql = "SELECT * FROM chocolate WHERE id='$id' LIMIT 1;";
    $result = mysqli_query($list, $sql);
    $choco = mysqli_fetch_assoc($result);

    $curuser = $_COOKIE["username"];
    $sql2 = "SELECT * FROM user WHERE username='$curuser' LIMIT 1;";
    $result2 = mysqli_query($list, $sql2);
    $user = mysqli_fetch_assoc($result2);
    $usertype = $user['issuper'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inka's Webpage</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
    <link rel="stylesheet" href="css/detail.css">

</head>

<body>
    <?php include 'header.php';?>
    <div class="row">
        <div class="column">
            <h4><?php echo $choco['nama']; ?></h4>
            <img src="<?= $choco['image']; ?>" alt="ini harusnya isi foto" width="400" height="300">
        </div>
        <div class="column">
            <p>Amount Sold : <?php echo $choco['stok_terjual']; ?></p>
            <p>Price : <?php echo $choco['harga']; ?></p>
            <p>Amount : <?php echo $choco['stok_total']; ?></p>
            <p>Description</p>
            <p><?php echo $choco['description']; ?></p>
                <?php 
                    if($usertype=='1'){
                        echo "
                        <form action='addstock.php' method='GET'>
                            <input type='hidden' name='idcoklat' value= '$id'/>
                            <input class='tombol' type='submit' name='addstock' value='Add Stock'/>
                        </form>
                        ";
                    }else{
                        echo "
                        <form action='buynow.php' method='GET'>
                            <input type='hidden' name='idcoklat' value='$id'/>
                            <input class='tombol' type='submit' name='buynow' value='Buy Now'/>
                        </form> 
                           ";
                    }
                ?>
        </div>
    </div>      
</body>
</html>
