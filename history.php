<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inka's Webpage</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
    <link rel="stylesheet" href="css/history.css">

</head>

<body>
    <?php
    include "header.php";
    include "connect.php";
    

    if(isset($_COOKIE["username"]) && $_COOKIE["signedin"]){
        $sql = "SELECT chocho.id AS coklat, username, nama_coklat, jumlah, harga_total, DATE_FORMAT(timestamp,'%d %M %Y') AS buy_date, DATE_FORMAT(timestamp,'%H:%i:%s') AS buy_time, address  
        FROM order_chocolate,(SELECT id,nama AS nama_coklat FROM chocolate) AS chocho WHERE idcoklat = chocho.id
        ORDER BY timestamp DESC";
        $result = mysqli_query($list, $sql);
        
        echo '
        <div id="content">
            <h1>Transaction History</h1>

            <table>
                <thead>
                    <th>Chocolate Name</th>
                    <th>Amount</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                </thead>

            
                <tbody>
                    ';
                        $uname = $_COOKIE['username'];
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                if($row['username'] == $uname){
                                    echo 
                                    '<tr class="history-item">
                                    <td class="woi">'.$row["nama_coklat"].'</td>
                                    <td>'.$row["jumlah"].'</td>
                                    <td>'.$row["harga_total"].'</td>
                                    <td>'.$row["buy_date"].'</td>
                                    <td>'.$row["buy_time"].'</td>
                                    <td>'.$row["address"].'</td>
                                    <td id="coklat_id" style="display:none">'.$row["coklat"].'</td>
                                    </tr>';
                                    $count += 1;
                                }
                            }
                        } 
                        if($count === 0){
                            echo '<tr><td colspan="6" style="text-align:center">Belum ada riwayat pembelian</td></tr>';
                        }
            echo '
                
                </tbody>
            </table>
        </div>

        ';
        // setcookie("signedin", "", time()-3600);
        // setcookie("username", "", time()-3600);
    } 
    else{
        header("location: index.php");
        exit;

    }

    ?>
    
       
    
</body>

<script>
    Array.from(document.getElementsByClassName('history-item')).forEach(v=>{
        v.style.cursor = 'pointer';
        v.onclick = function() {
            window.open('detail.php?idcoklat=' + v.querySelector('#coklat_id').innerHTML, '_self');
        };
    });
</script>

</html>
