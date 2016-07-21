<?php
define('db_server', "us-cdbr-azure-southcentral-f.cloudapp.net");
define('db_username', "b508b6e557b8b9");
define('db_password', "23ad37fd");
define('db_name', "samphire_subsea");

$db = mysqli_connect(db_server, db_username, db_password, db_name);

if(!$db){
    echo "Can't connect to Database" . mysqli_error();
}
?>

