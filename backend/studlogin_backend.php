<?php
include '../db/db.php';
include '../db/queries.php';

$studentnumber = filter_input(INPUT_POST, 'studentnumber', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

if(!studentNumberExists($conn, $studentnumber))
send_message_and_redirect("There is no ".$studentnumber." in the system.", "/ereliv/studlogin.php");

if(!verifyStudent($conn, $studentnumber, $section, $password))
send_message_and_redirect("Wrong Credentials", "/ereliv/studlogin.php");

header("Location: /ereliv/users/student/");

?>
