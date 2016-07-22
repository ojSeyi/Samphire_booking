<?php
    session_start();

    include ("db_connection.php");


    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = "SELECT * FROM customer_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($login, $db);

    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_row($result);
        $user = $row['username'];
        $_SESSION['user'] = $user;
        header('Location: index1.php');
    }else{
        header('Location: index2.php');
    }