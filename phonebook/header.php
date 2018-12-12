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
            <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.csss" />
            
            <script src = javascript/jquery.js></script>
            <script src = javascript/ajax.js></script>
            <script src = javascript/owl.carousel.min.js></script>
        </head>
        <?php
            require 'db_connect.php';
            if(!isset($_SESSION))
                session_start();
            $user_id = $_SESSION['user_id'];
            $user_pic_query = "SELECT * FROM phonebook_info WHERE user_id = '$user_id'";
            $result = mysqli_query($db_connect,$user_pic_query);
            $row = mysqli_fetch_array($result);
        ?>
            <header>
            <div class = "user_mini">
                <img id = "user_pic"src="image/<?php if($row['pro_pic'] != '') {echo $row['pro_pic'];} else {echo 'propic.png';}?>" alt = "propic">
                <form method = "POST" action = 'log_out.php'>
                    <button name = "logout" type = "submit" id = "log_out">Log Out</button>
                </form>
            </div>
                <img id = "logo" src = "image/logo.jpg">
                <div class = "tab">
                    
                    <ul id = "head">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="all_contacts.php">Contacts</a></li>
                        <li><a href="add_new_contact.php">Add New Contact</a></li>
                    </ul>              
                </div>   
            </header>
    </html>