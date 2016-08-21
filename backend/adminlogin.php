<?php
session_start();
include ('db_connection.php');
if(isset($_SESSION['admin'])){
    header('location: admin.php');
}

if(isset($_POST['bigusername'])){
    $username = $_POST['bigusername'];
    $password = $_POST['bigpassword'];
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);

    $login = $_POST['login'];
    $_SESSION['admin'] = $login;

    $login = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $login) or die("Invalid Query");
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['firstname'] = $username;
        header('Location: admin.php');
    } else {
        header('Location: adminlogin.php');
    }
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