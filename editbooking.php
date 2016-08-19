<?php
if(empty($_POST['flow']) || empty($_POST['lastname'])) {
    echo header('location: locatebooking.php');
}else {$proceed = 1;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Samphire-Subsea: Facility Reservation</title>
    <link rel="stylesheet" href="assets/stylesheet.css">
    <link rel="stylesheet" href="assets/unsemantic-grid-responsive-tablet.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <meta name="viewpoint"
          content="width=device-width,
          initial-scale=1,
          minimum-scale=1,
          maximum-scale=1"/>
</head>

<body>

<header class="grid-container">
    <img src="assets/images/logo_2016.jpg" id="logo"/>
    <div id="log">
        <div id="form">
            <form method="post" action="login.php">
                <input type="text" name="username" id="usernamebox" placeholder="Username" required/>
                <input type="password" name="password" id="passwordbox" placeholder="Password" required/>
                <input type="submit" value="Login" name="login" id="loginb"/>
            </form>
        </div>
        <div id="pagetitle"><h4>Samphire-Subsea</h4><p>Facilities Booking System</p></div>
    </div>
    <nav id="upnav" class="grid-container">
        <ul>
            <li><a href='index.php'>Create Booking</a></li>
            <li><a href='contactus.php'>Contact Us</a></li>
            <li><a href='registration.php'>Register</a></li>
        </ul>
    </nav>
</header>

<?php
    $confirmation = $_POST['confirmation'];
    $firstname = $_POST['confirmation'];
    $lastname = $_POST['lastname'];
    $cusid = $_POST['cusid'];
    $facilityname = $_POST['facilityname'];
    $facilitycosts = $_POST['facilitycosts'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];


?>


<div id="system">
    <main class="grid-container">

        <div id="syscon">
            <div id="bookingconfirmation">
                <table id="bookingdetails" class="grid-container">
                    <caption id="tablehead"> Here are the details of your booking </caption>
                    <tr>
                        <td>Customer Name: </td>
                        <td><?php echo $firstname . " " . $lastname; ?></td>
                    </tr>
                    <tr>
                        <td>Booking Reference Number:</td>
                        <td><h3><?php echo $confirmation ?></h3></td>
                    </tr>
                    <tr>
                        <td>Booking Date(s): </td>
                        <?php
                        if(is_null($enddate)){
                            echo "<td>".$startdate."</td>";
                        }else{
                            echo "<td> From: ".$startdate." to: " . $enddate . "</td>";
                        }
                        ?>
                    </tr>
                    <tr id="pins">
                        <td>Facility(s)</td>
                        <td>Price(s)</td>
                    </tr>
                    <tr id="pin">
                        <td>
                            <?php
                            foreach ($facilityname as $showfacility) {
                                echo $showfacility ."</br>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            foreach ($facilitycosts as $costs) {
                                echo $costs ."</br>";
                            }
                            ?>
                        </td>
                    </tr><br><br>
                    <tr id="pind">
                        <td>Total: </td>
                        <td><?php
                            $totalcost = 0;
                            foreach ($facilitycosts as $showcost) {
                                $totalcost = $totalcost + $showcost;
                            }
                            echo $totalcost;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
        $k = 0;
        if(isset($_POST['rfacilityarray'])){
            $facilityarrays = $_SESSION['facilityarray'];
            foreach ($facilityarrays as $showfacility) {
                if ($showfacility = $_POST['rfacilityarray']){
                    $k = 1;
                }else{}
            }
            if($k == 1){
                $facilityarrays = array_diff($facilityarrays,[$_POST['rfacilityarray']]);
                $facilityarrays = array_values($facilityarrays);
                $_SESSION['facilityarray'] = $facilityarrays;
                header('location: bookstate2.php');
            }

        }
        ?>

        <?php $facilityarrays = $_SESSION['facilityarray'];?>
        <form method="post" action="removefacility.php">
            <select name="rfacilityarray" id="facilityarray" size="<?php echo count($facilityarrays) ?>" required>
                <?php
                foreach ($facilityarrays as $showfacilityy) {
                    echo "<option>".$showfacilityy ."</option>";
                }
                ?>
            </select>
            <input type="submit" value="remove">
        </form>


        <div id="editbooking">
            <form method="post" action="editbooking.php">
                <input type="hidden" name="flow" value="flow">
                <input type="submit" name="removefacility" value="Edit">
            </form>
        </div><br>

        <div id="Cancel booking">
            <form method="post" action="editbooking.php">
                <input type="hidden" name="iliya" value="iliya">
                <input type="submit" name="removefacility2" value="Cancel">
            </form>
        </div><br><br>

    </main>
</div>

</body>
</html>