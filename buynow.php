<?php
    include_once 'connect.php';
    if(!isset($_COOKIE["username"]) && !$_COOKIE["signedin"]){
        header("location: index.php");
        exit;
    }
    if(!isset($_GET['idcoklat'])){
        header("location: home.php");
        exit;
    }
    // id coklat nanti diganti sama  id yang di pass dari detail
    $id = $_GET['idcoklat'];
    $sql = "SELECT * FROM chocolate WHERE id='$id' LIMIT 1;";
    $result = mysqli_query($list, $sql);
    $choco = mysqli_fetch_assoc($result);
    $amt_left = $choco['stok_total'] - $choco['stok_terjual'];
?>
<?php
    $value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
    $total = isset($_POST['price']) ? $_POST['price'] : $choco["harga"];
    $message= "";
    if(isset($_POST['add'])){
        
        if($value<$amt_left){
            $message="";
            $value += 1;
            $total = $value * $choco["harga"];
        }else if($value>=$amt_left){
            $total = $amt_left* $choco["harga"];
            $message = "Jumlah pesanan melebihi stok";
        }

    }
    
    if(isset($_POST['dec'])){
        
        if($value>1){
            $value -= 1; 
            $total = $value * $choco["harga"];
        }                                           
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Willy Wonka</title>
        <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
        <link rel="stylesheet" href="css/buynowstyle.css">
    </head> 
    <body>
    <?php include 'header.php';?>
        <div class="main">
            <div class="content-wrapper">
                <div class="pic-wrapper">
                    <p> Buy Chocolate </p>
                    <img src="<?= $choco['image']; ?>" alt="ini harusnya isi foto" width="400" height="300">
                </div>
                <div class="chocolate-content">
                    <p><?php echo $choco['nama']; ?></p>
                    <p>Amount sold : <?php echo $choco['stok_terjual']; ?></p>
                    <p>Price : Rp.<?php echo $choco['harga']; ?></p>
                    <p>Amount remaining : <?php echo $amt_left; ?></p>
                    <p>Description</p>
                    <p><?php echo $choco['description']; ?></p>
                    <div class="amount-count">
                        <form class="amount" method='post' action='<?= $_SERVER['REQUEST_URI']; ?>'>
                            <input class="btn" type="submit" name="dec" value="-"/>
                            <p><?= $value; ?></p>
                            <input type="hidden" name='item' value='<?= $value; ?>'/>
                            <input class="btn" type="submit" name="add" value="+"/>
                        </form>
                        <div class="count">
                            <p>Total Price :</p>
                            <input type="hidden" name='price' value='<?= $total; ?>'/>
                            <p>Rp.<?= $total; ?></p>
                        </div>
                    </div>
                    <div class="error-msg">
                        <p><?= $message; ?></p>
                    </div>
                </div>
            </div>
            <div class="address-wrapper">
                <p>Input your address: </p>
                <div class="btn_wrapper">
                    <form class="address-input" action='buynowController.php' method='POST'>
                        <textarea name="address" id="address_text" cols="30" rows="3" required></textarea>
                        <input type="hidden" name='quantity' value='<?= $value; ?>'/>
                        <input type="hidden" name='total_price' value='<?= $total; ?>'/>
                        <input type="hidden" name='id_coklat' value='<?= $choco['id']; ?>'/>
                        <input type="hidden" name='cursold' value='<?= $choco['stok_terjual']; ?>'/>
                        <input class="btn-1" type='submit' name='submit_buy' value='buy'/>
                    </form>
                    <form action='detail.php' method='GET'>
                        <input type="hidden" name='idcoklat' value='<?= $choco['id']; ?>'/>
                        <input class="btn-2" type='submit' name='submit_cancel' value='cancel'/>
                    </form>
                </div>
            </div>
        </div>
    </body>
</hmtl>