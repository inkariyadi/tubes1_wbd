<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inka's Webpage</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
    <link rel="stylesheet" href="css/home.css">

</head>

<body>
    <?php
    include "header.php";
    include "connect.php";
    if(isset($_COOKIE["username"]) && $_COOKIE["signedin"]){
        echo '<table>';
        echo '<th id="hello"><h2>Hello,  ' . $_COOKIE["username"] . '</h2></th>';
        // echo '<th id="view"><a href="#" >View all chocolate</a></th>';
        echo '</table>';
        $sql = "SELECT  
                *
                FROM
                chocolate
                ORDER BY 
                stok_terjual ASC
                ;
                ";
                
        $result = mysqli_query($list, $sql);
        echo '<div class="row">';
        while($row = mysqli_fetch_assoc($result)){
            // echo '<div class="group">
                
            //         <a href="detail.html">
            //             <div class="column">
            //                 <img src=' . $row['image'] . ' width="100%" height="200px">
            //                 <h3>' . $row['nama'] . '</h3>
            //                 <p>Amount Sold : ' . $row['stok_total'] . ' </p>
            //                 <p>Price : Rp ' . number_format($row['harga']) . '</p>
            //             </div>
            //         </a>
                    
            //     </div>';
            echo '<div class="group">
            <div class="column">
            <form action="detail.php" method="GET">
                <input type="hidden" name="idcoklat" value=' . $row['id'] . '/>
                <button type="submit">
                    <img src=' . $row['image'] . ' width="100%" height="200px">
                    <p id="choco-name">' . $row['nama'] . '</h3>
                    <p>Amount Sold : ' . $row['stok_terjual'] . ' </p>
                    <p>Price : Rp ' . number_format($row['harga']) . '</p>
                </button>
            </form>
            </div>

        </div> ';
        }
        // echo'</div>';
        
        // echo '
        // <div class="row">
            
        //     <div class="group">
                
        //         <a href="detail.html">
        //             <div class="column">
        //                 <img src="img/1.jpg" width="100%" height="200px">
        //                 <h4>Choco Name 1</h4>
        //                 <p>Amount Sold : </p>
        //                 <p>Price : </p>
        //             </div>
        //         </a>
                
        //     </div>   
        //     <div class="group">
        //         <div class="column">
        //         <form action="#" method="GET">
        //             <button type="submit">
        //                 <img src="img/2.jpg" width="100%" height="200px">
        //                 <p id="choco-name">Choco Name 2</h3>
        //                 <p>Amount Sold : </p>
        //                 <p>Price : </p>
        //             </button>
        //         </form>
        //         </div>

        //     </div>   
        //     <div class="group">
        //         <div class="column">
        //             <img src="img/3.jpg" width="100%" height="200px">
        //             <h4>Choco Name 3</h4>
        //             <p>Amount Sold : </p>
        //             <p>Price : </p>
        //         </div>
        //     </div>   
        //     <div class="group">
        //         <div class="column">
        //             <img src="img/4.jpg" width="100%" height="200px" >
        //             <h4>Choco Name 4</h4>
        //             <p>Amount Sold : </p>
        //             <p>Price : </p>
                    
        //         </div>
        //     </div>   
        //     <div class="group">
        //         <div class="column">
        //             <img src="img/4.jpg" width="100%" height="200px" >
        //             <h4>Choco Name 4</h4>
        //             <p>Amount Sold : </p>
        //             <p>Price : </p>
                    
        //         </div>
        //     </div>
        // </div>';
        
        
    } 
    else{
        header("location: index.php");
        exit;

    }

    ?>


    
       
    
</body>
</html>
