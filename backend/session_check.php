<?php
include '../db/db.php';
include '../db/queries.php';

// Start the session
session_start();
// Check if the session is null or empty
if (empty($_SESSION['user_id'])) {
  // Redirect the user back to the login page or show an error message
  send_message_and_redirect("Please Login First!", "/ereliv/rbac.php");


  exit(); // Stop further execution of the script
}
?>