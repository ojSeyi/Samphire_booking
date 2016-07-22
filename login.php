<?php
    session_start();

    include ("db_connection.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = "SELECT * FROM customer_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login) or die("failed query").mysqli_error();

    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_row($result);
        $logid = $row['log_id'];
        $user = mysqli_query($db, "SELECT firstname FROM customers WHERE log_id = '$logid'");
        $_SESSION['firstname'] = $user;
        header('Location: index1.php');
    }else{
        header('Location: index2.php');
    }
