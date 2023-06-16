<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
$redirect = filter_input(INPUT_POST, 'redirect', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_EMAIL);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (!emailAddressCheck($conn, $emailadd, $type)) {
  $response['status'] = 'error';
  $response['message'] = $emailadd . ' is not on the system';
  echo json_encode($response);
  exit;
}

if (!checkCode($conn, $type, $code, $emailadd)) {
  $response['status'] = 'error';
  $response['message'] = 'Invalid Reset Request';
  echo json_encode($response);
  exit;
}

updatePassword($conn, $hashed_password, $type, $emailadd, $redirect);

$response['status'] = 'success';
$response['message'] = 'Your Password has been Changed';
echo json_encode($response);
?>