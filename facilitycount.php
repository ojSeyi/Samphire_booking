<?php
$newfacilityone = $_POST['facilityarray'];
$facilityarray[0] = $newfacilityone;
$newfacility = $_POST['subsequentfacilityarray'];
$facilityarray[] = $newfacility;

$_SESSION['facilityarray'] = $facilityarray;

header('location: bookstate2.php');