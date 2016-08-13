<?php
$s = 0;
$_SESSION['s'] = $s;
if(isset($_POST['number'])){
    $_SESSION['s'] = $_SESSION['s'] + $_POST['number'];
    echo 'success';
}else{
    $_SESSION['s'] = $s;
}

header('location: bookstate2.php');