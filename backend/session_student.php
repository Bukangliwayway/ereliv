<?php
session_start(); // Start the session
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
if (empty($_SESSION['userID']) || $_SESSION['usertype'] != "student") {
  header("HTTP/1.0 404 Not Found");
  exit();
}

?>