<?php
    if(!isset($_COOKIE["username"]) && !$_COOKIE["signedin"]){
        header("location: index.php");
        exit;
    }
    if(!isset($_GET['idcoklat'])){
        header("location: home.php");
        exit;
    }
    include_once 'connect.php';
    $user = $_COOKIE["username"];
    $sql = "SELECT * FROM user WHERE username='$user' LIMIT 1;";
    $result = mysqli_query($list, $sql);
    $user = mysqli_fetch_assoc($result);
    $issuper = $user['issuper'];
    if($issuper != 1){
        header("location: home.php");
        exit;
    }
    include "header.php";
    // id coklat nanti diganti sama  id yang di pass dari detail
    $id = $_GET['idcoklat'];
    $sql = "SELECT * FROM Chocolate WHERE id='$id' LIMIT 1;";
    $result = mysqli_query($list, $sql);
    $choco = mysqli_fetch_assoc($result);
    $amt_left = $choco['stok_total'] - $choco['stok_terjual'];
?>
<?php
    $value = isset($_POST['item']) ? $_POST['item'] : 1; //to be displayed
    if(isset($_POST['add'])){
        $value += 1;
    }

    if(isset($_POST['dec'])){
        if($value>1){
            $value -= 1; 
        }                                           
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Willy Wonka</title>
        <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
        <link rel="stylesheet" href="css/addstockstyle.css">
    </head> 
    <body>
        <div class="main">
            <div class="content-wrapper">
                <div class="pic-wrapper">
                    <p> Add Chocolate Stock </p>
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
                    <p>Amount</p>
                        <form class="amount" method='post' action='addstockController.php'>
                            <!-- <input class="btn" type="submit" name="dec" value="-"/>
                            <p><?= $value; ?></p>
                            <input type="hidden" name='item' value='<?= $value; ?>'/>
                            <input class="btn" type="submit" name="add" value="+"/> -->
                            <textarea name="amount" id="amount" type="number" required></textarea>
                            <input class="btnact" type='submit' name='submit_add' value='add stock'/>
                            <input type="hidden" name='idchoc' value='<?= $choco['id']; ?>'/>
                            <input type="hidden" name='curstock' value='<?= $choco['stok_total']; ?>'/> 
                        </form>
                        <form method='GET' action='detail.php'>
                            <input type="hidden" name='idcoklat' value='<?= $id; ?>'/>
                            <input class="btnact" type='submit' name='submit_cancel' value='cancel'/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</hmtl>