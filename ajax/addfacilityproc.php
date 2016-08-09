<?php

echo "".$_SESSION['facili']."";
echo $_POST['addfacility'];

    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['facility'];
    echo (count($facilities) > 1) ?
         '<div><label> Facilities to be reserved:  </label><br><br></div>
                        <div>
                            <form>
                                <table>
                                    <tr>
                                        <?php
                                            foreach($facilityarray as $facility){
                                            echo <td>'.$facilityarray.'</td>;
                                            }
                                        ?>
                                    </tr>
                                </table>
                            </form>
                        </div>' :
         '<div><label> Facility to be reserved:  '.$facilityarray[0].'</label><br><br></div>';


foreach($facilityarray as $facility){
    echo '<label>'.$facilityarray.'</label>';
}