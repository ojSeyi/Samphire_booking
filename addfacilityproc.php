<?php
if(isset($_POST['addfacility'])){
    $facilityarray = array();
    $facilityarray[0] = $_SESSION['facili'];
    $facilityarray[] = $_POST['addfacility'];
    echo "<div><label> Facilities to be reserved:  </label><br><br></div>
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
                        </div>";
}