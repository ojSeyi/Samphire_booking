<?php
$reservation = $_POST['rsvDate'];
$reservation = date("Y-m-d",strtotime($reservation));
$type = $_POST['facility'];
$noDays = $_POST['daycount'];

if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){
    echo "<input id=".$meeting." type=".$type." value=".$date." />";
}