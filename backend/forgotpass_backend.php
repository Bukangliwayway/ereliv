<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';
$redirect = filter_input(INPUT_POST, 'redirect', FILTER_SANITIZE_STRING);

$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_EMAIL);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

$response = array();

try {
  if (!emailAddressCheck($conn, $emailadd, $type)) {
    $response['status'] = 'error';
    $response['message'] = $emailadd . ' is not on the system';
    echo json_encode($response);
    exit(); // Stop further execution of the script
  }

  $code = generateCode();

  $title = 'Password Reset';
  $body = 'To reset your password click <a href="http://localhost/ereliv/changepass.php?code=' . $code . '&type=' . $type . '">here</a>';

  sendEmail($conn, $emailadd, $title, $body);
  updateCode($conn, $code, $type, $emailadd, $redirect);

  $response['status'] = 'success';
  $response['message'] = 'Reset Request has been Sent, Check your Email';
  echo json_encode($response);
  exit(); // Stop further execution of the script
} catch (Exception $e) {
  $response['status'] = 'error';
  $response['message'] = 'An error occurred. Please try again';
  echo json_encode($response);
  exit(); // Stop further execution of the script
}
?>