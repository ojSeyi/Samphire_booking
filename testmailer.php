<?php

//email subject
$subject = "Friendship Link has been created for you!";
//email body in html
//ATTENTION, THE LINK MAY POINT TO THE MASTER DOMAIN, RATHER THAN YOUR OWN xxx.PHP
$txt = "Dear $name,
<br><br>
Thank you for being a part of International Students Friendship Link
<br>
You have a match on the friendship link program.
<br>
This match was made based on your preferences at sign-up:
<br>
Gender prefrence: $gender
Interested Nationality to host: $nation
Hobbies: $hobbies
<br><br>
Please contact Kathrine on kathrine@friendsUk.com for more infomation on the student selected.
<br><br>
King Regards,
<br><br>
The Friendship link";
//take in the necessary swiftmailer code
require_once 'swiftmailer/lib/swift_required.php';
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')->setUsername('ukpehmfon@gmail.com')->setPassword('seveneleven711');
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance('FriendshipLink: student matched')
->setFrom(array('oluwaseyiny@gmail.com' => 'Friendship link'))
->setTo(array('oluwaseyiny@gmail.com' => 'oluwaseyiny@gmail.com'))
->setBody($txt, 'text/html');
$mailer->send($message);