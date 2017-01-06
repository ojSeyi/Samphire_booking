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

<main>

<?php
$i = 7;

for ($n = $i; $n > 0; $n=$n-2){
    for($k = 1; $k <= $n; $k++){
        echo " ";
        echo " *";
    }

    echo " <br> ";
}

$temperatures = [];
$day1 = 22;

for ($i=0; $i<=10; $i++){
    array_push($temperatures, $day1);
    $day1 += 3;
}
$k=0;
for ($i=0; $i <= count($temperatures); $i++){
    echo $temperatures[$k];
    echo "<br>";
    $k++;
}

echo "<br><br>";

$rand = [3, 1, 6, 5, 7, 4, 2, 8];
$n = count($rand);
$randinv = [];
asort($rand);

echo "<br><br>";
$t = 0;
for($i=0; $i<=count($rand); $i++){
    echo $rand[$t];
    echo "<br>";
    $t++;
}



?>

</main>



</body>
</html>
