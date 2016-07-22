<?php
    session_start();
    if(isset($_SESSION['firstname'])) {
        echo "Welcome: " . $_SESSION['firstname'];
    }else{
        echo "not set";
    }

?>