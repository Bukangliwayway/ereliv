<?php
include '../db/db.php';
include '../db/queries.php';

$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!verifyFaculty($conn, $emailadd, $password))
  send_message_and_redirect("Wrong Credentials", "/ereliv/facultylogin.php");

if (getFacultyStatus($conn, $emailadd) != "Active")
  send_message_and_redirect("Wait for your Account Approval First", "/ereliv/facultylogin.php");

// Set the session variable
$_SESSION['userID'] = getFacultyID($conn, $emailadd);
$_SESSION['usertype'] = "faculty";
$_SESSION['username'] = getFullNameByID($conn, "Faculty", $_SESSION['userID']);

header("Location: /ereliv/faculty");



?>