<?php
session_start();
include ("db_connection.php");
if(isset($_SESSION['login'])){
    header('Location: index.php');
}
if(is_null($_POST['register'])){
    header('Location: index.php');
}
/**
 * Created by PhpStorm.
 * User: OJ Pumping
 * Date: 20/08/2016
 * Time: 20:00
 */
$username = $_POST['username'];
$username = stripcslashes($username);
$username = mysqli_real_escape_string($db,$username);
$password = $_POST['password'];
$password = stripcslashes($password);
$password = mysqli_real_escape_string($db,$password);
$firstname = $_POST['firstname'];
$firstname = stripcslashes($firstname);
$firstname = mysqli_real_escape_string($db,$firstname);
$lastname = $_POST['lastname'];
$lastname = stripcslashes($lastname);
$lastname = mysqli_real_escape_string($db, $lastname);
$email = $_POST['email'];
$email = stripcslashes($email);
$email = mysqli_real_escape_string($db,$email);
$mobile = $_POST['mobile'];
$mobile = stripcslashes($mobile);
$mobile = mysqli_real_escape_string($db,$mobile);
$address = $_POST['address'];
$address = stripcslashes($address);
$address = mysqli_real_escape_string($db,$address);

$usernamecheckcommand = "SELECT username FROM customer_login WHERE username = '$username'";
$usernamecheck = mysqli_query($db, $usernamecheckcommand);
if(mysqli_num_rows($usernamecheck) < 1){
    $command1 = "INSERT INTO customer_login (username, password) VALUES ('$username'. '$password')";
    $executecommand1 = mysqli_query($db, $command1) or die('error1');
    if($executecommand1){
        $command2 = "INSERT INTO customers (firstname, lastname, email, mobile, address) VALUES ('$firstname', '$lastname', '$email', '$mobile', '$address')";
        $executecommand2 = mysqli_query($db, $command2) or die('error2');
        if($executecommand2){
            $login = $_POST['register'];
            $_SESSION['login'] = $login;
            header('location: home1.php');
        }
    }

}else{
    header('Location: registration2.php');
}







?>