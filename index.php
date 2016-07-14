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
        <?php $action = array("http://samphire-subseafba.azurewebsites.net/reservationcheck.php", "http://samphire-subseafba.azurewebsites.net/index.php"); ?>
        <form method="post" action="<?php while ($link = mysqli_fetch_array($action)){echo $link;}; ?>">
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
            <input id="meeting" type="date" value="2016-07-01"/>
            <label>If you would require the facility for more than one day tick this box</label>
            <?php
                $meeting = "meeting";
                $type = "date";
                $date = "2016-07-02";
                echo "<input type='checkbox' name='enddate' value='yes'/>";
                if (isset($_POST['enddate']) && $_POST['enddate'] == 'yes'){
                    echo "<input id=".$meeting." type=".$type." value=".$date." />";
                }
            ?>
        </form>
    </div>


</body>
</html>