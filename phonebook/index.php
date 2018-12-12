<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Phone Book</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/owl.carousel.min.css" />
            <link rel="stylesheet" type="text/css" media="screen" href="css/owl.theme.default.min.css" />
            <script src = javascript/jquery.js></script>
            <script src = javascript/owl.carousel.min.js></script>
        </head>
            <header>
            <header>
                <img id = "logo" src = "image/logo.jpg">   
                <div class = "tab">    
                    <ul id = "head">
                        <li><a href="index.php">Log In</a></li>
                        <li><a href="sign_up.php">Sign Up</a></li>
                    </ul>              
                </div>  
            </header>     
            </header>
    </html>
<?php
    require 'db_connect.php';
    $loginErr = "";
    if(isset($_POST['signin'])){
        $email = $_POST['email'];
        $pass = $_POST['password']; 
        $login_query = "SELECT * FROM phonebook_info WHERE email ='$email' AND pass = '$pass'";
        if($result = mysqli_query($db_connect,$login_query)){
            $total_rows = mysqli_num_rows($result);
            if ($total_rows>0){
                $row = mysqli_fetch_array($result);
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['fname'];
                header('Location:home.php');                
            }
            else{
                $loginErr = "Credentials Does not Match";
             }
        }
         
    }
?>
<body>
<div class = "sign_up_top"><h2>Login To Continue</h2></div>
    <div class = "login_err"><h3><?php echo $loginErr; ?></h3></div>
    <div class = "container">
            <?php $loginErr = "<h2>Email or Password is incorrect</h2>";?>
            <div class = "form">
                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
                    <label>Email  </label>
                    <input class = "login" type = "text" name = "email" value = "" required placeholder = "Enter Email"><br>
                    <label>Password</label>
                    <input class = "login" type = "password" name = "password" value = "" required placeholder = "Password"><br>
                    <button id = "login" class = "submit" type = "submit" name = "signin" >Log In</button>
                </form>
                    <h4>Don't have an account</h4><h3><a id = "reg_link" href = 'sign_up.php'>Register Now</a></h3>
            </div>
    </div>
</body>
<?php
    include 'footer.php';
?>