<?php
    include "connect.php";

    $limit = 3;
    $count = 0;
    if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
    } else { 
        $page=1; 
    } 
    $start = ($page-1) * $limit;  

    $sql = "SELECT * FROM chocolate ORDER BY nama";
    $result = $list->query($sql);

    if($_GET['search'] === ''){
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if($count>=$start && $count<$start + $limit){
                    $remaining = $row['stok_total'] - $row['stok_terjual'];
                    echo '
                        <div class="search-result-item">
                            <div class="search-result-item-image">
                                <img class="choco-image" src="'.$row['image'].'" alt="Gambar '.$row['nama'].'"/>
                            </div>
                            <div class="search-result-item-detail">
                                <h2>'.$row['nama'].'</h2>
                                <h3>Price: Rp.'.$row['harga'].',00</h3>
                                <h3>Amount remaining: '.$remaining.'</h3>
                                <h3>Description:</h3>
                                <p>'.$row['description'].'</p>
                            </div>
                            <span id="coklat_id" style="display:none">'.$row['id'].'</>
                        </div>
                    ';
                }
                $count += 1;
            }
        }
    }else{
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if(strpos($row['description'], $_GET['search'])!== false){
                    if($count>=$start && $count<$start + $limit){
                        $remaining = $row['stok_total'] - $row['stok_terjual'];
                        echo '
                            <div class="search-result-item">
                                <div class="search-result-item-image">
                                    <img class="choco-image" src="'.$row['image'].'" alt="Gambar '.$row['nama'].'"/>
                                </div>
                                <div class="search-result-item-detail">
                                    <h2>'.$row['nama'].'</h2>
                                    <h3>Price: Rp.'.$row['harga'].',00</h3>
                                    <h3>Amount remaining: '.$remaining.'</h3>
                                    <h3>Description:</h3>
                                    <p>'.$row['description'].'</p>
                                </div>
                                <span id="coklat_id" style="display:none">'.$row['id'].'</>
                            </div>
                        ';
                    }
                    $count += 1;
                }
            }
        }
    }

?>