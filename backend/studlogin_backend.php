<?php
include '../db/db.php';
include '../db/queries.php';

$student_number = filter_input(INPUT_POST, 'student_number', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if(!student_number_exists($conn, $student_number))
send_message_and_redirect("There is no ".$student_number." in the system.", "/ereliv/studlogin.php");

if(!verified_student($conn, $student_number, $section, $password))
send_message_and_redirect("Wrong Credentials", "/ereliv/studlogin.php");

header("Location: /ereliv/success.php");

?>
