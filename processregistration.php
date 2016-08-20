<?php
session_start();
include ("db_connection.php");
if(is_null($_SESSION['login'])){
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











?>