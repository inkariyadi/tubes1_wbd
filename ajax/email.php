<?php
    include "../connect.php";
    //CEK EMAIL
    $sql = "SELECT * FROM user WHERE email=?";
    $stmt = $list->prepare($sql);
    $stmt->bind_param("s", $_GET['email']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $email, $pass, $issuper);
    $n = mysqli_stmt_affected_rows($stmt);
    $stmt->fetch();
    $stmt->close();


    // if($n==0){
    //     echo 'aman';
    // }
    // else{
    //     echo 'gaaman';
    // }
    if($n==0){
        if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
            // $emailErr = "Invalid email format";
            echo '1';
        }
        else{
            echo '0';
        }
        

    }
    else{
            echo '2';
    }
  

    // while($row = mysqli_fetch_assoc($result)){
    //     echo $row['username'];
    //     echo '<br>';
    // }
    // echo "<p>" . $n . "</p>";
    // echo "<p>" . $username . "</p>";
    // echo "<p>" . $email . "</p>";
    // echo "<p>" . $pass . "</p>";
    // echo "<p>" . $issuper . "</p>";
   
    

    // var_dump($result);

?>