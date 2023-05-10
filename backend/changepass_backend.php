<?php
include '../db/db.php';
include '../db/queries.php';

$code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$redirect = filter_input(INPUT_POST, 'redirect', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_EMAIL);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (!emailAddressCheck($conn, $emailadd, $type)) {
  send_message_and_redirect($emailadd.' is not on the system', $redirect);
}

if(!checkCode($conn, $type, $code, $emailadd))
send_message_and_redirect("Invalid Reset Request", $redirect);

updatePassword($conn, $password, $type, $emailadd, $redirect);
send_message_and_redirect('Your Password has been Changed', "http://localhost/ereliv/rbac.php");




