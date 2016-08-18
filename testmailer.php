<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

<?php

require_once 'swiftmailer/lib/swift_required.php';
$txt = "Dear $firstname,
					<br><br>
					Your booking has been created.
					<br>
					Here is your reference number: <h2> $bookingconfirmationnumber </h2>
					<br>
					Here are the details of your booking
					<br>
					<table>
					    <tr>
					        <th>Facility</th>
					        <th>Price</th><br>
                        </tr>
                        <tr>
                            <td>KGB</td>
                        </tr>
                        <tr>
                            <td>Total: </td>
                            <td>". $totalcost . "</td>
                        </tr>
                    </table>

					<br><br>
					Thank you for choosing Samphire-Subsea facilities!
					<br>
					Please contact the facilities department on nomail@samphire-subsea.com with any complaints or enquiries.
					<br><br>
					King Regards,
					<br><br>
					Samphire Subsea Facilities";

try{

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587,'tls')
    ->setUsername('ojtestall@gmail.com')
    ->setPassword('Oluwas3yi');

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Samphire')
    ->setFrom(array('ojtestall@gmail.com' => 'Samphire Subsea Facilities'))
    ->setTo(array('oluwaseyiny@gmail.com' => 'OJ DON'))
    ->setSubject('Samphire Subsea Facilities: Reservation')
    ->setBody($txt, 'text/html');
$result = $mailer->send($message);

}catch(Exception $e){
$e->getMessage();
echo $e;

}

?>

</body>
</html>
