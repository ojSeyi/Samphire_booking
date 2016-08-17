<?php

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
require_once 'swiftmailer-5.x/lib/swift_required.php';

if (function_exists('mb_internal_encoding') && ((int) ini_get('mbstring.func_overload')) & 2)
{
$mbEncoding = mb_internal_encoding();
mb_internal_encoding('ASCII');
}

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
->setUsername('ojtestall@gmail.com')
->setPassword('Oluwas3yi');

$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('Samphire Subsea Facilities: Reservation')
->setFrom(array('ojtestall@gmail.com' => 'Samphire Subsea Facilities'))
->setTo('seyiyusuf100@gmail.com')
->setBody($txt, ['text/html']);
$send = $mailer->send($message);

print_r($send);

if (isset($mbEncoding))
{
mb_internal_encoding($mbEncoding);
}