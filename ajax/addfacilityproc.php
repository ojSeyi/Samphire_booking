<?php

echo "".$_SESSION['facili']."";
echo $_POST['addfacility'];

    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['facility'];
    echo (count($facilities) > 1) ? '<?php
                                            foreach($facilityarray as $facility){
                                            echo <td>'.$facilityarray.'</td>;
                                            }
                                        ?>' : '.$facilityarray[0].';


foreach($facilityarray as $facility){
    echo '<label>'.$facilityarray.'</label>';
}