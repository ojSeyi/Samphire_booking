<?php
 echo "start";
$custemail = $_SESSION['custemail'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
//email subject
$subject = "Confirmation Of Your Facility Reservation With Samphire Subsea";
//email body in html
//ATTENTION, THE LINK MAY POINT TO THE MASTER DOMAIN, RATHER THAN YOUR OWN xxx.PHP
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

//take in the necessary swiftmailer code
require_once 'swiftmailer/lib/swift_required.php';


$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
->setUsername('ojtestall@gmail.com')
->setPassword('Oluwas3yi');

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Samphire Subsea Facilities: Reservation')
->setFrom(array('ojtestall@gmail.com' => 'Samphire Subsea Facilities'))
->setTo('oluwaseyiny@gmail.com')
->setBody($txt, 'text/html');
$send = $mailer->send($message);

echo $send;

