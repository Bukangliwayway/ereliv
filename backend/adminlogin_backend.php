<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$response = array();

if (!verifyAdmin($conn, $username, $password)) {
  $response['status'] = 'error';
  $response['message'] = 'Wrong Credentials';
  echo json_encode($response);
  exit(); // Stop further execution of the script
}

// Set the session variable
$_SESSION['userID'] = getAdminID($conn, $username);
$_SESSION['usertype'] = 'admin';
$_SESSION['username'] = getFullNameByID($conn, 'Admin', "adminID" ,$_SESSION['userID']);

$response['status'] = 'success';
$response['redirect'] = '/ereliv/admin/';
echo json_encode($response);
exit(); // Stop further execution of the script
?>
