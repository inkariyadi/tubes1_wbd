<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willi Wangky</title>
    <!-- <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script> -->
    
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="container">
        <p>CHANJINK</p>
        <h1>Willi Wangky Choco Factory</h1>
        
        <?php
        include 'connect.php';
        if(isset($_COOKIE["username"]) && $_COOKIE["signedin"]){
            echo "udah login";
            echo "Hi " . $_COOKIE["username"];
            header("location: home.php");
            exit;
        }
        else{
            

            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {
                echo '<form method="POST" action=>
                <p>Username: </p>
                <input type="text" placeholder="Enter Username" name="username" id="username">
                <div class="con2" id="con2"></div>
                <p>Email: </p>
                <input type="text"  placeholder="Enter Email" name="email" id="email">
                <div class="con" id="con"></div>
                <p>Password: </p>
                <input type="password" placeholder="Enter Password" name="password" id="password">
                <p>Confirm Password: </p>
                <input type="password" placeholder="Enter Password Again" name="conpassword" id="conpassword">
                <div class="con3" id="con3"></div>
                <br>
                <input type="submit" value="REGISTER" id="reg" />
            </form>
            <p id="reg">Already have account?</p><a href="index.php">Sign in</a>
            ';
            }
            else{
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $conpassword = $_POST['conpassword'];
                $issuper = 0;

                if($password!=$conpassword){
                    //password tidak sama
                    echo '<form method="POST" action=>
                        <p>Username: </p>
                        <input type="text" placeholder="Enter Username" name="username" id="username">
                        <div class="con2" id="con2"></div>
                        <p>Email: </p>
                        <input type="email" placeholder="Enter Email" name="email" id="email">
                        <div class="con" id="con"></div>
                        <p>Password: </p>
                        <input type="password" placeholder="Enter Password" name="password" id="password">
                        <p>Confirm Password: </p>
                        <input type="password" placeholder="Enter Password Again" name="conpassword" id="conpassword">
                        <div class="con3" id="con3"></div>
                        <br>
                        <input type="submit" value="REGISTER" id="reg" />
                        </form>
                        <p id="reg">Already have account?</p><a href="index.php">Sign in</a>
                        ';
                    // echo'<p>Password not same. Please try again</p>';
                }
                else{
                    $sql_username = "SELECT *
                                    FROM user
                                    WHERE username='$username';
                                    ";
                    $sql_email = "SELECT *
                                    FROM user
                                    WHERE email='$email';
                                    ";
                    $result_username = mysqli_query($list, $sql_username);
                    $result_email = mysqli_query($list, $sql_email);
                    if((mysqli_num_rows($result_username) != 0) || mysqli_num_rows($result_email) != 0 ){
                        //data exists
                        echo '<form method="POST" action=>
                            <p>Username: </p>
                            <input type="text" placeholder="Enter Username" name="username" id="username">
                            <div class="con2" id="con2"></div>
                            <p>Email: </p>
                            <input type="email" placeholder="Enter Email" name="email" id="email">
                            <div class="con" id="con"></div>
                            <p>Password: </p>
                            <input type="password" placeholder="Enter Password" name="password" id="password">
                            <p>Confirm Password: </p>
                            <input type="password" placeholder="Enter Password Again" name="conpassword" id="conpassword">
                            <div class="con3" id="con3"></div>
                            <br>
                            <input type="submit" value="REGISTER" id="reg" />
                            </form>
                            <p id="reg">Already have account?</p><a href="index.php">Sign in</a>
                            ';
                            
                        // if(mysqli_num_rows($result_username) != 0){
                        //     echo'<p>Username taken. Please try again</p>';
                        // }
                        // if(mysqli_num_rows($result_email) != 0){
                        //     echo'<p>Email taken. Please try again</p>';
                        // }
                    }
                    else{
                        $sql = "INSERT INTO user
                        VALUES(
                            '$username',
                            '$email',
                            '$password',
                            '$issuper')
                        ";
                        $result = mysqli_query($list, $sql);
                        if(!$result)
                        { //query not error
                            echo '<form method="POST" action=>
                            <p>Username: </p>
                            <input type="text" placeholder="Enter Username" name="username" id="username">
                            <div class="con2" id="con2"></div>
                            <p>Email: </p>
                            <input type="email" placeholder="Enter Email" name="email" id="email">
                            <div class="con" id="con"></div>
                            <p>Password: </p>
                            <input type="password" placeholder="Enter Password" name="password" id="password">
                            <p>Confirm Password: </p>
                            <input type="password" placeholder="Enter Password Again" name="conpassword" id="conpassword">
                            <div class="con3" id="con3"></div>
                            <br>
                            <input type="submit" value="REGISTER" id="reg" />
                            </form>
                            <p id="reg">Already have account?</p><a href="index.php">Sign in</a>
                            ';
                            // echo'<p>Database failed. Please try again</p>';
                            // echo("Error description: " . $list -> error);
                        
                        }
                        else
                        {
                            setcookie("signedin", TRUE, time()+1*24*60*60);
                            setcookie("username", $_POST['username'], time()+1*24*60*60);
                            setcookie("super", false, time()+1*24*60*60);
                            header("location: home.php");
                            exit;
                        }
                    }
                }

                
                
                
            
            }
        }
        ?>

       
    </div>
<script src="script.js"></script>
</body>
</html>
