<?php
    include("header.php");
    require 'db_connect.php';
    if(!isset($_SESSION)){
        session_start();
        $user_id = $_SESSION['user_id'];
    }
    $profile_query = "SELECT * FROM phonebook_info where user_id = '$user_id'";
    $result = mysqli_query($db_connect,$profile_query);
    $row = mysqli_fetch_array($result);
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
        $update_query = "UPDATE phonebook_info SET pro_pic = '$pro_pic',fname = '$fname',lname = '$lname',email = '$email',web = '$web',mobile = '$mobile',address = '$address' WHERE user_id = '$user_id'";
        $update_success = mysqli_query($db_connect,$update_query);
        header('Location:profile.php');
    }
?>
    <div class = "container">
            <div class = "form">
                <form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "POST" enctype = "multipart/form-data">
                    <div >
                        <img class = "pro_pic" src="image/<?php if($row['pro_pic'] != '') {echo $row['pro_pic'];} else {echo 'propic.png';}?>" alt = "propic">
                    </div>
                    <div class = "name"><h2><?php echo $row['fname'];?></h2></div>
                    <input id  = "user_pic_upload" class = "user_pic_all" type = "file" name = "propic" value = "<?php echo $row['fname'];?>"accept="image/*" disabled><br>
                    <button id = "edit" class = "submit" type = "button" name = "edit" value = "Edit Profile">Edit Profile</button><br>
                    <label >First Name</label>
                    <input class = "edit_profile" type = "text" name = "fname" value = "<?php echo $row['fname'];?>"disabled><br>
                    <label>Last Name</label>
                    <input class = "edit_profile" type = "text" name = "lname" value = "<?php echo $row['lname'];?>"disabled><br>
                    <label>Email  </label>
                    <input class = "edit_profile" type = "text" name = "email" value = "<?php echo $row['email'];?>"disabled><br>
                    <label>Web  </label>
                    <input class = "edit_profile" type = "text" name = "web" value = "<?php echo $row['web'];?>"disabled><br>
                    <label>Mobile  </label>
                    <input class = "edit_profile" type = "text" name = "mobile" value = "<?php echo $row['mobile'];?>"disabled><br>
                    <label>Address  </label>
                    <input class = "edit_profile" type = "text" name = "address" value = "<?php echo $row['address'];?>"disabled><br>
                    <label>About Me</label>
                    <textarea class = "new_contact" type = "text" name = "bio"  width = "300px" height="200px" disabled><?php echo $row['bio'];?></textarea><br>
                    <button id = "save" class = "submit" type = "submit" name = "save" >Save</button>
                    <button id = "cancel" class = "submit" type = "button" name = "cancel" >Cancel</button><br>
                </form>
            </div>
    </div>
<script>
    $(document).ready(function(){
        $('#edit').click(function(){
            $('#save').show();
            $('#cancel').show();
            jQuery("input[name=email],input[name=fname],input[name=lname],input[name = propic],input[name = web],input[name = mobile],input[name = address],textarea[name = bio]").attr("disabled",false);
            $('#edit').hide();
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
    include 'footer.php';
?>