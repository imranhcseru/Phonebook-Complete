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
                <img id = "logo" src = "image/logo.jpg">   
                <div class = "tab">    
                    <ul id = "head">
                        <li><a href="index.php">Log In</a></li>
                        <li><a href="sign_up.php">Sign Up</a></li>
                    </ul>              
                </div>  
            </header>
    </html>
    <?php
        require 'db_connect.php';
        $fnameErr = $emailErr = $lnameErr = $websiteErr = $passcountErr = $passmatchErr = "";
        $fname = $lname=$email=$pass=$con_pass="";
        if(isset($_POST['signup'])){
            $pro_pic = "propic.png";
            $fname = mysqli_real_escape_string($db_connect,$_POST['fname']);
            $lname = mysqli_real_escape_string($db_connect,$_POST['lname']);
            $email = mysqli_real_escape_string($db_connect,$_POST['email']);
            $pass = $_POST['pass'];
            $con_pass = $_POST['con_pass'];
            $check_email_query = "SELECT * FROM phonebook_info WHERE email = '$email'"; 
            $result = mysqli_query($db_connect,$check_email_query);
            $total_rows = mysqli_num_rows($result);
            if(!preg_match('/^[a-z ]+$/i', $fname)) {
                $fnameErr = 'First name is incorrect';
            }
            else if(!preg_match('/^[a-z ]+$/i', $lname)) {
                $lnameErr = 'First name is incorrect';
            }
            else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i',$email)){
                $emailErr = 'Email is incorrect';
            }
            else if ($total_rows>0){
                    $emailErr = "User already registered";
            }
            else if(strlen($pass)<8){
                $passcountErr = 'Minimum length of password is 8 charachter';
            }
            else if($pass != $con_pass){
                $passmatchErr = 'Password does not match';
            }
            else{
                $insert_query = "INSERT INTO phonebook_info (fname,lname,email,pass,pro_pic) VALUES('$fname','$lname','$email','$pass','$pro_pic')";
                mysqli_query($db_connect,$insert_query);
                header('Location:index.php');
            }
        }    
    ?>
    <body>
    <div class = "sign_up_top"><h2>Get in Touch</h2></div>
    <div class = "container">      
            <div class = "form">
                <form action = "<?php echo $_SERVER["PHP_SELF"];?>" method= "POST">
                    <label >First Name</label>
                    <input class = "sign_up" type = "text" autocomplete="off" required name = "fname" value = "<?php echo $fname;?>" placeholder = "Your First Name"><br><span class="error"> <?php echo $fnameErr;?></span><br>
                    <label>Last Name</label>
                    <input class = "sign_up" type = "text" autocomplete="off" required name = "lname" value = "<?php echo $lname;?>" placeholder = "Your Last Name"><br><span class="error"><?php echo $lnameErr;?></span><br>
                    <label>Email  </label>
                    <input class = "sign_up" type = "text" autocomplete="off" required name = "email" value = "<?php echo $email;?>" placeholder = "Enter Email"><br><span class="error"> <?php echo $emailErr;?></span><br>
                    <label>Password</label>
                    <input class = "sign_up" type = "password" autocomplete="off" name = "pass" value = "" ><br><span class="error"> <?php echo $passcountErr;?> </span><br>
                    <label>Confirm Password</label>
                    <input class = "sign_up" type = "password" autocomplete="off" name = "con_pass" value = "" ><br><span class="error"> <?php echo $passmatchErr;?> </span><br>
                    <button id = "signup" class = "submit" type = "submit" name = "signup" >Sign Up</button>
                </form>
            </div>
    </div>
    </body>
<?php
    include 'footer.php';
?>