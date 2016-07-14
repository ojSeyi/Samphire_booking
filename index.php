<!DOCTYPE html>
<html lang="en">
<?php include ("db_connection.php"); ?>
<head>
    <meta charset="UTF-8">
    <title>Samphire Subsea Facilities Booking</title>
</head>
<body>
    <div>
        <form>
            <Lable>Please select a facility</Lable>
            <select name="facility" size="1" required>
                <?php
                $getfacilities = "SELECT name FROM samphire_facilities";
                $result = mysqli_query($db, $getfacilities);
                while ($row = mysqli_fetch_array($result)) {
                echo "<option>". $row['name'] . "</option>";
                ?>
        </form>
    </div>


</body>
</html>