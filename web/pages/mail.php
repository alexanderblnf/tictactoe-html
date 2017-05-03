<?php
require_once '../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

if(isset($_POST['user']) && isset($_POST['message']) && $_POST['user'] != '' && $_POST['message'] != ''){
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
        ->setUsername('smity.mailserver@gmail.com')
        ->setPassword('Iamsmity1*');

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Feedback')
        ->setFrom(array('smity.mailserver@gmail.com' => $_POST['user']))
        ->setTo(array('smity.mailserver@gmail.com'))
        ->setBody($_POST['message']);

    $result = $mailer->send($message);

    $response = array(
        "success" => "Mail sent"
    );
    echo json_encode($response);
} else {
    $response = array(
        'error' => 'You have not provided all the information'
    );
    echo json_encode($response);
}
