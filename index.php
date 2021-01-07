<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willi Wangky</title>
    <script src="https://kit.fontawesome.com/a54d2cbf95.js"></script>
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
  
    <div class="container">
        <p>CHANJINK</p>
        <h1>Willi Wangky Choco Factory</h1>
        <?php
        include 'connect.php';
        $array = array(
            "inka" => "inkink",
            "inka222" => "ink",
            "Heri" => "mercy"
        );
        // Verifying whether a cookie is set or not
        if(isset($_COOKIE["username"]) && $_COOKIE["signedin"]){
            echo "udah login";
            echo "Hi " . $_COOKIE["username"];
            header("location: home.php");
            // setcookie("signedin", "", time()-3600);
            // setcookie("username", "", time()-3600);
            exit;
        } 
        else{
            if($_SERVER['REQUEST_METHOD'] != 'POST')
            {
            
                echo '<form method="POST" action=> 
                        <p>Email: </p>
                        <input type="email" placeholder="Enter Email" name="email" id="email">
                        <p>Password: </p>
                        <input type="password" placeholder="Enter Password" name="password" id="password">
                        <br>
                        <input type="submit" value="LOG IN" />
                        
                    </form>
                    <p>Dont have account?</p><a href="register.php">Register</a>';

        
            }
            else{
                
                $sql = "SELECT  
                        *
                        FROM
                        user
                        WHERE
                        email = '" . mysqli_real_escape_string($list, $_POST['email']) . "'
                        ;
                        ";
                
                $result = mysqli_query($list, $sql);
                
                    // echo $_POST['password'];
                    // echo $_POST['email'];
                

                if(mysqli_num_rows($result) == 0){
                        echo '<form method="POST" action=> 
                        <p>Email: </p>
                        <input type="email" placeholder="Enter Email" name="email" id="email">
                        <p>Password: </p>
                        <input type="password" placeholder="Enter Password" name="password" id="password">
                        <br>
                        <input type="submit" value="LOG IN" />
                    </form> <p>Dont have account?</p><a href="register.php">Register</a>
                    <p>Account not exist</p>' ;

                    
                }
                else{
                    $row = mysqli_fetch_assoc($result);
                    // echo $row['username'];
                    // echo $row['password'];
                    // echo $row['issuper'];
                    

                    if($row['password']==$_POST['password'])
                    {
                        setcookie("signedin", TRUE, time()+1*24*60*60);
                        setcookie("username", $row['username'], time()+1*24*60*60);
                        setcookie("super", $row['issuper'], time()+1*24*60*60);
                        echo "set cookie";
                        header("location: home.php");
                        exit;
                    }
                    else{
                        echo '<form method="POST" action=> 
                        <p>Email: </p>
                        <input type="email" placeholder="Enter Email" name="email" id="email">
                        <p>Password: </p>
                        <input type="password" placeholder="Enter Password" name="password" id="password">
                        <br>
                        <input type="submit" value="LOG IN" />
                    </form> <p>Dont have account?</p><a href="register.php">Register</a>
                    <p>Wrong username/password!. Please try again</p>' ;
                    }
                
                }
        

            }
    
        }
?>
        
        
        
        
        </div>
    </div>
</body>
</html>

