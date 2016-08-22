<?php
session_start();

if(isset($_POST['logout'])){
    session_destroy();
    header('Location: admin.php');
}else{
    header('Location: admin.php');
}

?>