<?php
include '../db/db.php';
include '../db/queries.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if(!staff_username_exists($conn, $username))
send_message_and_redirect("There is no ".$username." in the system.", "/ereliv/stafflogin.php");

if(!verified_staff($conn, $username, $password))
send_message_and_redirect("Wrong Credentials", "/ereliv/stafflogin.php");

header("Location: /ereliv/users/FacultyPage/facultydashboard.php");

?>
