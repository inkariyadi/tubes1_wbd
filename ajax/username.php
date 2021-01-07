<?php
    include "../connect.php";
    $sql = "SELECT * FROM user WHERE username=?";
    $stmt = $list->prepare($sql);
    $stmt->bind_param("s", $_GET['username']);
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
        if (!preg_match("/^[a-zA-Z0-9_]*$/",$_GET['username'])) {
            // $nameErr = "Only letters and white space allowed";
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