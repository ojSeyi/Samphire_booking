<?php

    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['facility'];
    echo (count($facilities) > 1) ? "<?php foreach($facilityarray as $facility){
                                            echo $facilityarray;
                                            } ?>" :  $_SESSION['facili'];


