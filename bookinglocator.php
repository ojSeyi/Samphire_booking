<?php
session_start();

include ("db_connection.php");

if(empty($_POST['confirmation']) || empty($_POST['lastname'])) {
    echo "Enter Reference number and lastname";
}else {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);


}