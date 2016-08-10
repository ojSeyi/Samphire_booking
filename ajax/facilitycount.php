<?php
$s = 0;
if(isset($_POST['number'])){
    $s = $s + $_POST['number'];
    $_SESSION['s'] = $s;
    echo 'success';
}