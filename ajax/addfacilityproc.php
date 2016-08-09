<?php

echo $_SESSION['facili'];
echo $_POST['addfacility'];

    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['addfacility'];
    if(count($facilities) > 1){
        echo '<div><label> Facilities to be reserved:  </label><br><br></div>
                        <div>
                            <form>
                                <table>
                                    <tr>
                                        <?php
                                            foreach($facilityarray as $facility){
                                            echo <td>.$facility.</td>;
                                            }
                                        ?>
                                    </tr>
                                </table>
                            </form>
                        </div>';
    }elseif(count($facilities) == 0){
        echo '<div><label> Facility to be reserved:  ' . $_SESSION['facili'].'</label><br><br></div>';

    }elseif((count($facilities) == 1)){
        echo '<div><label> Facility to be reserved:  ' . $_SESSION['facili'].'</label><br><br></div>';
    }
    echo 'fuck';
