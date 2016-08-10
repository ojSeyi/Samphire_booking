<?php
$s = 0;
if(isset($_POST['number'])){
    $_SESSION['s'] = $s;
    $_SESSION['s'] = $_SESSION['s'] + $_POST['number'];
    echo 'success';
}else{
    $_SESSION['s'] = $s;
}
header('location: datecheck.php');