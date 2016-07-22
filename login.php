<?php
    session_start();

    include ("db_connection.php");

if(empty($_POST['username']) || empty($_POST['password'])) {

}else{

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = "SELECT log_id FROM customer_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login);

    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_row($result);
        $user = $row['firstname'];
        $_SESSION['firstname'] = $user;
        header('Location: index1.php');
    }else{
        header('Location: index2.php');
    }
}