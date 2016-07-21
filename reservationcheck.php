<?php
$reservation = $_POST['rsvDate'];
$reservation = date("Y-m-d",strtotime($reservation));
$type = $_POST['facility'];
$noDays = $_POST['daycount'];


if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){
    $meeting = "meeting";
    $type = "date";
    $date = "2016-07-02";
    echo "<input id=".$meeting." type=".$type." value=".$date." />";
}