<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$response = array();

if (!verifyFaculty($conn, $emailadd, $password)) {
  $response['status'] = 'error';
  $response['message'] = 'Wrong Credentials';
  echo json_encode($response);
  exit(); // Stop further execution of the script
}

if (getFacultyStatus($conn, $emailadd) != "Active") {
  $response['status'] = 'error';
  $response['message'] = 'Wait for your Account Approval First';
  echo json_encode($response);
  exit(); // Stop further execution of the script
}

// Set the session variable
$_SESSION['userID'] = getFacultyID($conn, $emailadd);
$_SESSION['usertype'] = "faculty";
$_SESSION['username'] = getFullNameByID($conn, "Faculty", "facultyID" ,$_SESSION['userID']);

$response['status'] = 'success';
$response['message'] = 'Login successful';
$response['redirect'] = 'http://localhost/ereliv/faculty';  
echo json_encode($response);
exit(); // Stop further execution of the script
?>