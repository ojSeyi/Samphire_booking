<?php

require_once 'swiftmailer/lib/swift_init.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
    ->setUsername('oluwaseyiny@gmail.com')
    ->setPassword('Oluwas3y1.')
;
$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance();
$message->setSubject('My subject');
$message -> setBody('FUck all yall');
$message->setTo('seyiyusuf100@gmail.com');
$message->setFrom('oluwaseyiny@gmail.com');

$result = $mailer->send($message);

if ($result)
{
    echo "Sent\n";
}
else
{
    echo "Failed\n";
}