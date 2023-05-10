<?php
include '../db/db.php';
include '../db/queries.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$redirect = filter_input(INPUT_POST, 'redirect', FILTER_SANITIZE_STRING); 

if (!emailAddressCheck($conn, $email, $type)) {
  send_message_and_redirect($email.' is not on the system', $redirect);
}

$code = generateCode();

$title = "Password Reset";
$body = 'To reset your password click <a href="http://localhost/login_system/change_password.php?code='.$code.'&type='.$type.'">here </a>';

sendEmail($conn, $email, $title, $body, $redirect);
updateCode($conn, $code, $type, $emailadd, $redirect);

send_message_and_redirect('Reset Request has been Sent, Check your Email', $redirect);



