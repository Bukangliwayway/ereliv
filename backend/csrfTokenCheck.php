<?php
session_start(); // Start the session
if (!isset($_SESSION['csrf_token']) || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
  header("HTTP/1.0 404 Not Found");
  exit;
}

?>