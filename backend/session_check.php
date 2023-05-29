<?php
include '../db/db.php';
include '../db/queries.php';

// Start the session
session_start();
// Check if the session is null or empty
if (empty($_SESSION['userID'])) {
  // Redirect the user back to the login page 
  send_message_and_redirect("Please Login First!", "/ereliv/");


  exit(); // Stop further execution of the script
}
?>