<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php
if(is_null($_SESSION['facilities']) && ($_SESSION['startdates'])){
    header('Location: index.php');
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
<header>
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="form">
        <form method="post" action="login.php">
            <input type="text" name="username" id="usernamebox" placeholder="Username" required/>
            <input type="password" name="password" id="passwordbox" placeholder="Password" required/>
            <input type="submit" value="Login" name="login" id="loginb"/>
        </form>
    </div>
    <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
</header>
<main>
    <section id="bannerbox">
        <img src="assets/images/banner1.jpg" id="bannerimage"/>
    </section>

    <div id="syscon">
        <?php
        session_start();
            //availabililty check start
            $facility = $_SESSION['facility'];
            $startdaterecieved = strtotime($_SESSION['startdates']);
            $startdates = date("Y-m-d",$startdaterecieved);
            if(isset($_SESSION['enddates'])) {
                $enddates = date("Y-m-d", strtotime($_SESSION['enddates']));;
            }else{
                $enddates = null;
            }

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
                            echo "<div>
                                    <label>Sorry, the $facilitys facility is unavailable on $startdates</label><br><br>
                                    <form id='search' method='post' action='datecheck2.php'>
                                    <label>Please select a different date: </label><br><br>
                                    <input id='startdate' name='startdate' type='date' value='2016-07-01'/><br><br>
                                    <input type='submit' value='Check' />
                                    </form>
                                </div>";
                        }else{
                            //header to booking
                            echo $startdates."<br>";
                            echo $enddates."<br>";
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
                        $results = mysqli_query($db, $availablerange);
                        if(mysqli_num_rows($results) > 0){
                            $unavailabledates[] = $date;
                        }else{
                            header('location: booking.php');
                        }
                    }
                    if(count($datesinrange) > 31){
                        echo "<label>For booking greater than 30 days please contact the office using the information in the contact page</label>";
                    }else{
                        echo "<label>The following dates are unavailable: </label><br>";
                        foreach($unavailabledates as $showdate){
                            echo "<label>".$showdate.", "."</label>";
                        }
                    }



                }
            }else{
                header('location: index.php');
                //Put code to show booking details and button to add new facility(must be contained within page)
            }
            //availability check end

            function generateRandomString($length = 6) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }



            $randomtable = generateRandomString();



        ?>

    </div>
</main>

</body>
</html>