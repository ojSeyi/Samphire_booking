<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: admin.php');
}


?>

<!DOCTYPE html>
<html lang="en">
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
<body>
<header>

</header>

<main>
    <div id="login" class="grid-container">
        <form method="post" action="adminlogin.php">
            <table>
                <tr>
                    <label>Please enter a valid username and password</label>
                </tr>
                <tr>
                    <td>
                        Username:
                    </td>
                    <td>
                        <input type="text" name="bigusername" id="bigusername" placeholder="Username..." required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Password:
                    </td>
                    <td>
                        <input type="password" name="bigpassword" id="bigpassword" placeholder="password..." required>
                    </td>
                </tr>
                <tr>
                    <input type="submit" name="login" value="Login">
                </tr>
            </table>
        </form>
    </div>
</main>


<




</body>
</html>