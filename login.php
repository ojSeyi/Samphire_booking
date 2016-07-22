<?php
    session_start();

    include ("db_connection.php");

if(empty($_POST['username']) || empty($_POST['password'])) {
    echo "Enter Username and Password";
}else {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = "SELECT * FROM customer_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login) or die("Invalid Query".mysqli_error());

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_row($result);
        $userloginid = $row['log_id'];
        echo $userloginid;


    } else {
        header('Location: index2.php');
    }
}