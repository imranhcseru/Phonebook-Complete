<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include("header.php");
    require 'db_connect.php';
    $user_id = $_GET['user'];
    $contact_id = $_GET['contact'];
    $details_query = "SELECT * FROM contact_info where user_id = '$user_id' AND contact_id = '$contact_id'";
    $delete_query = "DELETE FROM contact_info where contact_id = '$contact_id' AND user_id = '$user_id'";
    $result = mysqli_query($db_connect,$details_query);
    $row = mysqli_fetch_array($result);
    echo $user_id;
    echo $contact_id;
    if(isset($_POST['save'])){
        if(isset($_FILES['propic']['name'])){
            $pro_pic = $_FILES['propic']['name'];
            $target = "image/".basename($pro_pic);
            move_uploaded_file($_FILES['propic']['tmp_name'], $target);
        }
        $fname =isset($_POST['fname']) ? $_POST['fname'] : '';
        $lname =isset($_POST['lname']) ? $_POST['lname'] : '';
        $email =isset($_POST['email']) ? $_POST['email'] : '';
        $web =isset($_POST['web']) ? $_POST['web'] : '';
        $mobile =isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $address =isset($_POST['address']) ? $_POST['address'] : '';
        $bio = isset($_POST['bio']) ? $_POST['bio'] : '';
        $update_query = "UPDATE contact_info SET pro_pic = '$pro_pic',fname = '$fname',lname = '$lname',email = '$email',web = '$web',mobile = '$mobile',address = '$address',bio = '$bio' WHERE user_id = '$user_id' AND contact_id = '$contact_id'";
        mysqli_query($db_connect,$update_query);
        header('Location:all_contacts.php');
    }
    if(isset($_POST['delete'])){
        if(mysqli_query($db_connect,$delete_query)){
           header('Location:all_contacts.php'); 
        }
    }
    
?>

<body>
    <div class = "container">
            <div class = "form">
                <form class = "cont_deatails" action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method= "POST" enctype = "multipart/form-data">
                    <div >
                        <img class = "pro_pic" src="image/<?php if($row['pro_pic'] != '') {echo $row['pro_pic']; } else {echo 'propic.png';} ?>" alt = "propic">
                    </div>
                    <button id = "edit" class = "submit" type = "button" name = "edit" value = "Edit Profile">Edit Contact</button>
                    <button id = "delete" class = "submit" type = "submit" name = "delete" value = "Delete Profile">Delete Contact</button><br>
                    <div class = "name"><h2><?php echo $row['fname'];?></h2></div>
                    <div class  = "user_pic">
                    <input  id  = "contact_pic" class = "user_pic_all" type = "file" name = "propic" value = ""accept="image/*" disabled><br>
                    </div>
                    <label>First Name</label>
                    <input class = "new_contact" type = "text" name = "fname" value = "<?php echo $row['fname']; ?>" disabled><br>
                    <label>Last Name</label>
                    <input class = "new_contact" type = "text" name = "lname" value = "<?php echo $row['lname']; ?>"disabled><br>
                    <label>Email  </label>
                    <input class = "new_contact" type = "text" name = "email" value = "<?php echo $row['email']; ?>"disabled><br>
                    <label>Website  </label>
                    <input class = "new_contact" type = "text" name = "web" value = "<?php echo $row['web']; ?>"disabled><br>
                    <label>Mobile Number  </label>
                    <input class = "new_contact" type = "text" name = "mobile" value = "<?php echo $row['mobile']; ?>"disabled><br>
                    <label>Address</label>
                    <input class = "new_contact" type = "text" name = "address" value = "<?php echo $row['address']; ?>"disabled><br>
                    <label>Bio</label>
                    <textarea class = "new_contact" type = "text" name = "bio"  width = "300px" height="200px" disabled><?php echo $row['bio']; ?></textarea><br>
                    <button id = "save" class = "submit" type = "submit" name = "save" >Save</button>
                    <button id = "cancel" class = "submit" type = "button" name = "cancel" >Cancel</button><br>
                </form>
            </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        $('#edit').click(function(){
            $('#save').show();
            $('#cancel').show();
            jQuery("input[name=email],input[name=fname],input[name=lname],input[name = propic],input[name = web],input[name = mobile],input[name = address],textarea[name = bio]").attr("disabled",false);
            $('#edit').hide();
            $('#delete').hide();
        })
        $('#save').click(function(){
            $('#edit').show();
            $('#save').hide();
            $('#cancel').hide();
        })
        $('#cancel').click(function(){
            $('#edit').show();
            $('#save').hide();
            $('#cancel').hide();
            jQuery("input[name=email],input[name=fname],input[name=lname],input[name = propic],input[name = web],input[name = mobile],input[name = address],textarea[name = bio]").attr("disabled",true);
        })
    })
</script>
<?php
    include("footer.php");
?>