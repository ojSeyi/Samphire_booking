<?php
session_start();

include ("db_connection.php");

if(empty($_POST['bigusername']) || empty($_POST['bigpassword'])) {
    echo "Enter Username and Password";
}else {
    $username = $_POST['bigusername'];
    $password = $_POST['bigpassword'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);
    $login = $_POST['login'];
    $_SESSION['login'] = $login;

    $login = "SELECT * FROM customer_login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login) or die("Invalid Query".mysqli_error());
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $userloginid = $row['log_id'];
        $getuserfullname = mysqli_query($db, "SELECT * FROM customers WHERE log_id = $userloginid");
        if(mysqli_num_rows($getuserfullname) == 1){
            $userfullname = mysqli_fetch_array($getuserfullname);
            $userfirstname = $userfullname['firstname'];
            $_SESSION['firstname'] = $userfirstname;
            $userlastname = $userfullname['lastname'];
            $_SESSION['lastname'] = $userlastname;
            $custid = $userfullname['cust_id'];
            $_SESSION['custid'] = $custid;
            $custemail = $userfullname['email'];
            $_SESSION['custemail'] = $custemail;
            $_SESSION['userfullname'] = $userfullname;
            header('Location: uyvsucvconfirmationhbdkcbosi.php');
        }

    } else {
        header('Location: iuadtfuiweyfbuakrjvacas.php');
    }
}

?>