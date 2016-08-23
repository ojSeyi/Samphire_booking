<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php session_start();
if(is_null($_SESSION['firstname']) && is_null($_SESSION['startdates'])){
    header('Location: home1.php');
};
?>
<head>
    <meta charset="UTF-8">
    <title>Samphire-Subsea: Facility Reservation</title>
    <link rel="stylesheet" href="assets/stylesheet.css">
    <link rel="stylesheet" href="assets/unsemantic-grid-responsive-tablet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <meta name="viewpoint"
          content="width=device-width,
          initial-scale=1,
          minimum-scale=1,
          maximum-scale=1"/>
</head>
<head>
    <meta charset="UTF-8">
    <title>Samphire Subsea Facilities Booking</title>
</head>
<body>
<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="logout">
            <form method="post" action="logout.php">
                <label><?php echo $_SESSION['firstname'];?></label>
                <input type="submit" name="logout" value="logout" id="logoutbutton"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='logmanagebooking.php'>Manage Booking</a></li>
            <li><a href='viewhistory.php'>View Past Bookings</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
        </ul>
    </nav>
</header>

<div id="system">
    <main class="grid-container">

    <div id="syscon">
        <?php
        //availabililty check start
        $facility = $_SESSION['facility'];
        $startdaterecieved = strtotime($_SESSION['startdates']);
        $startdates = date("Y-m-d",$startdaterecieved);
        if(isset($_SESSION['enddates'])) {
            $enddates = date("Y-m-d", strtotime($_SESSION['enddates']));;
        }else{
            $enddates = null;
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
                $availables = "SELECT * FROM customer_bookings WHERE f_id = '$rows' AND (startdate <= '$startdates' AND enddate >= '$startdates')";
                $results = mysqli_query($db, $availables) or die("failed");
                if(mysqli_num_rows($results) > 0){
                    $notavailable = 1;
                    echo "<div>
                                    <label>Sorry, the $facilitys facility is unavailable on $startdates</label><br><br>
                                    <form id='search' method='post' action='logdatecheck2.php'>
                                    <label>Please select a different date: </label><br><br>
                                    <input id='facility' name='facility' type='hidden' value='$facility'/><br><br>
                                    <input id='startdate' name='startdate' type='date' value='$currentdate'/><br><br>
                                    <input type='submit' value='Check' />
                                    </form>
                                </div>";
                }else{
                    $_SESSION['start'] = $startdates;
                    $_SESSION['facili'] = $facility;
                    header('location: logbookstate.php');
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

                if(count($datesinrange) > 31){
                    echo "<label>For booking greater than 30 days please contact the office using the information in the contact page</label>";
                }else{
                    $unavailabledates = array();
                    foreach($datesinrange as $date){
                        $availablerange = "SELECT * FROM customer_bookings WHERE f_id = '$rows' AND (startdate <= '$date' AND enddate >= '$date')";
                        $results = mysqli_query($db, $availablerange) or die("failed");
                        if(mysqli_num_rows($results) > 0){
                            $unavailabledates[] = $date;
                            echo "<div id='filled dates'><label>The $facilitys facility is unavailable on the following dates: </label><br>";
                            echo "<table><tr>";
                            foreach($unavailabledates as $showdate){
                                echo "<td>".$showdate."</td>";
                            }
                            echo "</tr></table></div>";
                            echo "<form id='search' method='post' action='logdatecheck.php'>
                                    <label>Please select different dates: </label><br><br>
                                    <input id='startdate' name='startdate' type='text' value='Click here to select a date'/><br><br>
                                    <input id='enddate' name='enddate' type='text' value='Click here to select a date'/><br><br>
                                    <input type='submit' value='Check' />
                                    </form>";
                        }else{
                            $_SESSION['Start'] = $startdates;
                            $_SESSION['end'] = $enddates;
                            $_SESSION['facili'] = $facility;
                            header('location: logbookstate.php');
                        }
                    }
                }

            }
        }else{

            header('location: index.php');
            //Put code to show booking details and button to add new facility(must be contained within page)
        }
        //availability check end


        ?>

    </div>
</main>
</div>

</body>
</html>