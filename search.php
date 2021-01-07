<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inka's Webpage</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
    <link rel="stylesheet" href="css/search.css">

</head>

<body>
    <?php

    include "header.php";

    if (isset($_COOKIE["username"]) && $_COOKIE["signedin"]) {

        // echo '<div id="search-result-container"></div>';
        include 'search-result.php';
        
        if (isset($_GET["page"])) {
            $page  = $_GET["page"]; 
        } else { 
            $page=1; 
        } 
        
        include('connect.php'); 
        $limit = 3;
        $page_count = ceil($count / $limit); 

        echo '<ul id="pagination">';
            if (isset($_GET["search"])) {
                $search  = $_GET["search"]; 
            } else { 
                $search=''; 
            } 
            for($i=1; $i<=$page_count; $i++){
                if($i == $page){
                    echo '<li class="pagination-child active">
                        <a href="?search='.$search.'&page='.$i.'">'.$i.'</a>
                    </li>';
                }
                else{
                    echo '<li class="pagination-child">
                        <a href="?search='.$search.'&page='.$i.'">'.$i.'</a>
                    </li>';
                }
            }

        echo '</ul>';
        
        
        // setcookie("signedin", "", time()-3600);
        // setcookie("username", "", time()-3600);


    } else {
        header("location: index.php");
        exit;
    }

    ?>

</body>

<script>
    Array.from(document.getElementsByClassName('search-result-item')).forEach(v=>{
        v.style.cursor = 'pointer';
        v.onclick = function() {
            window.open('detail.php?idcoklat=' + v.querySelector('#coklat_id').innerHTML, '_self');
        };
    });
</script>

</html>