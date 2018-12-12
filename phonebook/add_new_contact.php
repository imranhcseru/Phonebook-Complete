<?php
    include 'header.php';
    require 'db_connect.php';
    $fname = $lname=$email=$web=$mobile=$address=$bio="";
    $fnameErr = $emailErr = $lnameErr = $webErr = "";
    if(!isset($_SESSION)){
        session_start();
    }
    $user_id = $_SESSION['user_id'];
    $query = "SELECT MAX( contact_id ) AS max FROM contact_info WHERE user_id = '$user_id'";
    $rowSQL = mysqli_query($db_connect, $query);
    $row = mysqli_fetch_array( $rowSQL );
    $largestNumber = $row['max'];
    $contact_id = $largestNumber +1;
    if(isset($_POST['addnew'])){
        if(isset($_FILES['propic']['name'])){
            $pro_pic = $_FILES['propic']['name'];
            $target = "image/".basename($pro_pic);
            move_uploaded_file($_FILES['propic']['tmp_name'], $target);
        }
        else{
            $pro_pic = '';
        }
        $fname = mysqli_real_escape_string($db_connect,$_POST['fname']);
        $lname = mysqli_real_escape_string($db_connect,$_POST['lname']);
        $email = mysqli_real_escape_string($db_connect,$_POST['email']);
        $web = mysqli_real_escape_string($db_connect,$_POST['web']);
        $mobile = mysqli_real_escape_string($db_connect,$_POST['mobile']);
        $address = mysqli_real_escape_string($db_connect,$_POST['address']);
        $bio = mysqli_real_escape_string($db_connect,$_POST['bio']);
        if(!preg_match('/^[a-z ]+$/i', $fname)) {
            $fnameerror = 'First name is incorrect';
        }
        else if(!preg_match('/^[a-z ]+$/i', $lname)) {
            $lnameerror = 'First name is incorrect';
        }
        else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i',$email)){
            $emailErr = 'Email is incorrect';
        }
        else if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web)){
            $webErr = 'Website Not Valid';
        }
        else{
            $insert_query = "INSERT into contact_info (contact_id,user_id,pro_pic,fname,lname,email,web,mobile,address,bio) VALUES('$contact_id','$user_id','$pro_pic','$fname','$lname','$email','$web','$mobile','$address','$bio')";
            mysqli_query($db_connect,$insert_query);
            header('Location:all_contacts.php');
        }
    }
      
?>

<body>
    <div class = "container">
            <div class = "form">
                <form action = "<?php echo $_SERVER["PHP_SELF"];?>" method= "POST" enctype = "multipart/form-data">
                    <div >
                        <img class = "pro_pic" src="image/propic.png" alt = "propic">
                    </div>
                    <input id = "add_new_conta"class = "user_pic_all" type = "file" name = "propic" accept="image/*"><br>
                    <label >First Name</label>
                    <input class = "new_contact" type = "text" name = "fname" value = "" required placeholder = "First Name"><br>
                    <label>Last Name</label>
                    <input class = "new_contact" type = "text" name = "lname" value = ""  placeholder = "Last Name"><br>
                    <label>Email  </label>
                    <input class = "new_contact" type = "text" name = "email" value = ""  placeholder = "Email Address"><br>
                    <label>Website  </label>
                    <input class = "new_contact" type = "text" name = "web" value = ""  placeholder = "Website"><br>
                    <label>Mobile Number  </label>
                    <input class = "new_contact" type = "text" name = "mobile" value = ""  placeholder = "Mobile Number"><br>
                    <label>Address</label>
                    <input class = "new_contact" type = "text" name = "address" value = ""  placeholder = "Address"><br>
                    <label>Bio</label>
                    <textarea class = "new_contact" type = "text" name = "bio" value = "" width = "300px" height="200px" placeholder = "Bio"></textarea><br>
                    <button id = "addnew" class = "submit" type = "submit" name = "addnew" >Add New Contact</button>
                </form>
            </div>
    </div>
</body>
<script>
    document.querySelector('img').addEventListener('click', function(){
        document.querySelector('img').click();
    });
</script>
<?php
    include 'footer.php';
?>