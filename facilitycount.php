<?php
session_start();
<?php include ("db_connection.php"); ?>
if(is_null($_POST['bounce'])){
    header('location: bookstate.php');
};

$newfacility = $_POST['facilityarray'];
$facilityarray = $_SESSION['facilityarray'];

//availabililty check start
$facility = $_SESSION['facility'];
$startdaterecieved = strtotime($_SESSION['start']);
$startdates = date("Y-m-d",$startdaterecieved);
if(isset($_SESSION['end'])) {
    $end = date("Y-m-d", strtotime($_SESSION['end']));;
}else{
    $end = null;
}
$currentdate = date('d-m-Y');
$currentnextdate = date('d-m-Y', ($currentdate + 1));



echo "was good<br>";
echo "$facilitys <br>";
//Upgrade code to search through date range too
$available = "SELECT * FROM samphire_facilities WHERE f_name = '$facility'";
$result = mysqli_query($db, $available);
$show = mysqli_num_rows($result);
echo $show;
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $rows = $row['f_id'];
    echo $rows;
    if(is_null($enddates)){
        $availables = "SELECT * FROM guest_bookings WHERE f_id = '$rows' AND (startdate <= '$startdates' AND enddate >= '$startdates')";
        $results = mysqli_query($db, $availables) or die("failed");
        if(mysqli_num_rows($results) > 0){
            $notavailable = 1;
            $_SESSION['unavailablefacility'] = $rows;
            $unavailabledates = $startdates;
            $_SESSION['newfacilityunavailable'] = 1;
            header('location: bookstate2.php');

        }else{
            $_SESSION['newfacilityunavailable'] = 0;
            if (count($facilityarray) <= 3) {

                if (isset($facilityarray[0])) {

                } else {
                    $firstfacility = $_POST['firstfacility'];
                    $facilityarray[0] = $firstfacility;
                }

                $addfacility;
                $a = 1;
                $k = $a;
                foreach ($facilityarray as $checkfacility) {
                    if ($checkfacility == $_POST['facilityarray']) {

                        $addfacility = 0;
                        $a++;

                    } else {
                        if ($a > $k) {
                            $addfacility = 4;
                        } else {
                            $addfacility = 1;
                        }
                    }
                }


                if ($addfacility == 1) {
                    $facilityarray[] = $newfacility;
                    $_SESSION['facilityarray'] = $facilityarray;
                } else {
                    $_SESSION['facilityarray'] = $facilityarray;
                }

            }

            $_SESSION['facilityarraycheck'] = 1;
            header('location: bookstate2.php');
        }
    }else{
        function createDateRangeArray($strDateFrom,$strDateTo)
        {
            // takes two dates formatted as YYYY-MM-DD and creates an
            // inclusive array of the dates between the from and to dates.

            // could test validity of dates here but I'm already doing
            // that in the main script

            $aryRange=array();

            $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
            $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

            if ($iDateTo>=$iDateFrom)
            {
                array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
                while ($iDateFrom<$iDateTo)
                {
                    $iDateFrom+=86400; // add 24 hours
                    array_push($aryRange,date('Y-m-d',$iDateFrom));
                }
            }
            return $aryRange;
        }

        $datesinrange = createDateRangeArray($startdates, $enddates);


            $unavailabledates = array();
            foreach($datesinrange as $date){
                $availablerange = "SELECT * FROM guest_bookings WHERE f_id = '$rows' AND (startdate <= '$date' AND enddate >= '$date')";
                $results = mysqli_query($db, $availablerange) or die("failed");
                if(mysqli_num_rows($results) > 0){
                    $unavailabledates[] = $date;
                    $newfacilityunavailable = 2;
                    $_SESSION['unavailablefacility'] = $rows;
                }else{
                    $newfacilityunavailable = 0;
                }
            }

            if($newfacilityunavailable == 2) {
                $_SESSION['newfacilityunavailable'] = 2;
                $_SESSION['unavailabledates'] = $unavailabledates;
                header('location: bookstate2.php');
            }elseif($newfacilityunavailable == 0){
                $_SESSION['newfacilityunavailable'] = 0;

                if (count($facilityarray) <= 3) {

                    if (isset($facilityarray[0])) {

                    } else {
                        $firstfacility = $_POST['firstfacility'];
                        $facilityarray[0] = $firstfacility;
                    }

                    $addfacility;
                    $a = 1;
                    $k = $a;
                    foreach ($facilityarray as $checkfacility) {
                        if ($checkfacility == $_POST['facilityarray']) {

                            $addfacility = 0;
                            $a++;

                        } else {
                            if ($a > $k) {
                                $addfacility = 4;
                            } else {
                                $addfacility = 1;
                            }
                        }
                    }


                    if ($addfacility == 1) {
                        $facilityarray[] = $newfacility;
                        $_SESSION['facilityarray'] = $facilityarray;
                    } else {
                        $_SESSION['facilityarray'] = $facilityarray;
                    }

                }

                $_SESSION['facilityarraycheck'] = 1;
                header('location: bookstate2.php');
            }

    }
}else{

    header('location: index.php');
    //Put code to show booking details and button to add new facility(must be contained within page)
}
//availability check end


