<?php
$reservation = $_POST['rsvDate'];
$reservation = date("Y-m-d",strtotime($reservation));
$type = $_POST['facility'];
$noDays = $_POST['daycount'];

if ($noDays < 1){
    $reservation ++ ;
}