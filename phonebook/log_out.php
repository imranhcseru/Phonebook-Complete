<?php
    require 'db_connect.php';
    if(isset($_POST['logout'])){
        session_destroy();
        session_unset();
        header('Location:index.php');
    }
?>