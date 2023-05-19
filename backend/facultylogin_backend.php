<?php
include '../db/db.php';
include '../db/queries.php';

$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if (!verifyFaculty($conn, $emailadd, $password))
  send_message_and_redirect("Wrong Credentials", "/ereliv/facultylogin.php");

header("Location: /ereliv/faculty");

?>