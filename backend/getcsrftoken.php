<?php
// Start the session
session_start();

// Check if the CSRF token exists in the session
if (isset($_SESSION['csrf_token'])) {
  // Return the CSRF token as the response
  echo $_SESSION['csrf_token'];
} else {
  // CSRF token doesn't exist, return an error response
  header("HTTP/1.0 404 Not Found");
  exit;
}
?>