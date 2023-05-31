<?php
session_start(); // Start the session
include '../db/db.php';
include '../db/queries.php';

$studentnumber = filter_input(INPUT_POST, 'studentnumber', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!studentNumberExists($conn, $studentnumber))
  send_message_and_redirect("There is no " . $studentnumber . " in the system.", "/ereliv/studlogin.php");

if (!verifyStudent($conn, $studentnumber, $section, $password))
  send_message_and_redirect("Wrong Credentials", "/ereliv/studlogin.php");
  
if(getStudentStatus($conn, $studentnumber) != "Active")
  send_message_and_redirect("Wait for your Account Approval First", "/ereliv/studlogin.php");

// Set the session variable
$_SESSION['userID'] = getStudentID($conn, getStudentEmail2($conn, $studentnumber));
$_SESSION['usertype'] = "student";
$_SESSION['username'] = getFullNameByID($conn, "Student", $_SESSION['userID']);
header("Location: /ereliv/student/");

?>