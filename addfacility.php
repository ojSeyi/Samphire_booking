<?php
$newfacility = $_POST['newfacility'];
$facilityarray[0] = $_SESSION['facili'];
$facilityarray[] = $newfacility;

echo "<label> Facilities to be reserved are:  </label><br><br>
    <table><tr>
    foreach($facilityarray as $showfacility){
        <td>.$showfacility.</td>;
    }
    </tr></table>";