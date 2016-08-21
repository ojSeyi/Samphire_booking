<?php
if(isset($_POST['username'])=== true && empty($_POST['username']) === false){
    $user = $_POST['username'];
    $user = mysqli_real_escape_string($db, $user);
    include ('db_connection.php');
    $query = "SELECT * FROM customer_login WHERE username = '$user'";
    $result = mysqli_query($db, $query);

        echo (mysqli_num_rows($result) !== 0) ? 'this username already exists' : '';
}