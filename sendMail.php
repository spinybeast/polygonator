<?php
//header("Content-type: text/html; charset=WINDOWS-1251");

$userName = htmlspecialchars($_POST['name']);
$userMail = htmlspecialchars($_POST['mail']);
$userSubj = "Order";
$userText = htmlspecialchars($_POST['text']);
$userUtm = htmlspecialchars($_POST['phone']);
$userText = "Contact - Name: " . $userName . " Email: " . $userMail . "
Text: " . $userText . "

Phone: " . $userUtm . "

REF: " . print_r($_SERVER['HTTP_REFERER'], 1);

$to = "polygonator3d@gmail.com";

$subject = $userSubj;

$message = wordwrap($userText, 70);


$headers = array
(
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset="UTF-8";',
    'Content-Transfer-Encoding: 7bit',
    'Date: ' . date('r', $_SERVER['REQUEST_TIME']),
    'Message-ID: <' . $_SERVER['REQUEST_TIME'] . md5($_SERVER['REQUEST_TIME']) . '@' . $_SERVER['SERVER_NAME'] . '>',
    'From: ' . $userName . '<' . $userMail . '>',
    'Reply-To: ' . $userName . '<' . $userMail . '>',
    'Return-Path: ' . $userName . '<' . $userMail . '>',
    'X-Mailer: PHP v' . phpversion(),
    'X-Originating-IP: ' . $_SERVER['REMOTE_ADDR'],
);

$ok = mail($to, $subject, $message, implode("\n", $headers));

if ($ok)
    echo "ok";
else {
    echo "mail problem";

    $ok = file_put_contents("mail_bug_" . date("Y-m-d") . ".log", "\n--------------------------\n" . date("d.m.Y") . "\n$to , $subject , $message , " . implode("\n", $headers), FILE_APPEND . print_r(error_get_last()));
}
