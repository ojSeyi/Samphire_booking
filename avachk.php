<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<?php session_start();
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
            //availabililty check start
            $facilitys = $_SESSION['facilities'];
            $startdates = date("d-m-Y",strtotime($_SESSION['startdates']));;
            $enddates = $_SESSION['enddates'];

            $available = "SELECT * FROM samphire_facilities WHERE 'name' = '$facilitys'";
            $result = mysqli_query($db, $result);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $rows = $row['f_id'];
                $availables = "SELECT * FROM guestbookings WHERE 'f_id' = '$rows' AND 'startdate' = $startdates";
                $results = mysqli_query($db, $availables);
                if(mysqli_num_rows($results) > 0){
                    $notavailable = 1;
                    header('Location: index3.php');

                }
            }else{
                $_SESSION['yes'] = $yesavailable;
                $getcosts = "SELECT cost FROM samphire_facilities WHERE name = '$facilitys'";
                $report = mysqli_query($db, $getcosts);
                $costs = mysqli_fetch_array($report);
                $costss = $costs['cost'];
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

        <form id="addto" action="avachk.php" method="post">
            <label>Click to add more facilities</label>
            <input type="submit" name="add" id="add" value="Add"/>
        </form>

    </div>
</main>

</body>
</html>