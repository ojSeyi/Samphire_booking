<?php
if(isset($_POST['addfacility'])){
    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['addfacility'];
    echo "fuck";
}