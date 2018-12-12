<?php
    session_destroy();
    session_unset();
    header("Location:../sign_up.php");   
?>