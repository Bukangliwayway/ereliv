<?php
session_start(); // Start the session
include '../db/db.php';
include '../db/queries.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!verifyAdmin($conn, $username, $password)) {
  send_message_and_redirect("Wrong Credentials", "/ereliv/adminlogin.php");
  exit(); // Stop further execution of the script
}



// Set the session variable
$_SESSION['userID'] = getAdminID($conn, $username);
$_SESSION['usertype'] = "admin";
$_SESSION['username'] = getFullNameByID($conn, "Admin", $_SESSION['userID']);

header("Location: /ereliv/admin");
exit(); // Stop further execution of the script
?>