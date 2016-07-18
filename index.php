<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
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
    <div>
        <form method="post" action="reservationcheck.php">
            <Lablel>Please select a facility</Lablel>
            <select name="facility" size="1" required>
                <?php
                    $getfacilities = "SELECT name FROM samphire_facilities";
                    $result = mysqli_query($db, $getfacilities);
                    while ($row = mysqli_fetch_array($result))
                    echo "<option>". $row['name'] . "</option>";
                ?>
            </select>
            <label>Meeting Date : </label>
            <input id="meeting" type="date" value="2016-07-01" required/>
            <label>If you would require the facility for more than one day tick this box</label>
            <input type="number" name="daycount" size="1" required/>
            <input type='submit' value='submit'/>
        </form>
    </div>


</body>
</html>