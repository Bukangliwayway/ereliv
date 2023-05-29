<?php
include '../db/db.php';
include '../db/queries.php';

session_start(); // Start the session

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!verifyAdmin($conn, $username, $password)) {
  send_message_and_redirect("Wrong Credentials", "/ereliv/adminlogin.php");
  exit(); // Stop further execution of the script
}


// Set the session variable
$_SESSION['userID'] = $username;

header("Location: /ereliv/admin");
exit(); // Stop further execution of the script
?>