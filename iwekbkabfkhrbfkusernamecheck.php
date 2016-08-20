<?php
if(isset($_POST['username'])=== true && empty($_POST['username']) === false){
    $user = $_POST['username'];
    include ('db_connection.php');
    $query = "SELECT * FROM customer_login WHERE username = '$user'";
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) == 1){
        echo "this username already exists";
    }
}