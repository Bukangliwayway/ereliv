<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$studentnumber = filter_input(INPUT_POST, 'studentnumber', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$response = array();

if (!studentNumberExists($conn, $studentnumber)) {
  $response['status'] = 'error';
  $response['message'] = "There is no " . $studentnumber . " in the system.";
} else if (!verifyStudent($conn, $studentnumber, $section, $password)) {
  $response['status'] = 'error';
  $response['message'] = "Wrong Credentials";
} else if (getStudentStatus($conn, $studentnumber) != "Active") {
  $response['status'] = 'error';
  $response['message'] = "Wait for your Account Approval First";
} else {
  // Set the session variable
  $_SESSION['userID'] = getStudentID($conn, getStudentEmail2($conn, $studentnumber));
  $_SESSION['usertype'] = "student";
  $_SESSION['username'] = getFullNameByID($conn, "Student", "studentID", $_SESSION['userID']);

  $response['status'] = 'success';
  $response['message'] = "Login successful";
  $response['redirect'] = "/ereliv/student/";
}

echo json_encode($response);
?>  