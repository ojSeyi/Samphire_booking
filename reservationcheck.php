<?php
$meeting = "meeting";
$type = "date";
$date = "2016-07-02";

if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){
    echo "<input id=".$meeting." type=".$type." value=".$date." />";
}