<?php
include '../db/db.php';
include '../db/queries.php';

$student_number = filter_input(INPUT_POST, 'student_number', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (studentNumberCheck($conn, $student_number)) {
  send_message_and_redirect("Student number is already in use", "/ereliv/studregis.php");
}

if (emailAddressCheck($conn, $email, 'Student')) {
  send_message_and_redirect("Email is already in use", "/ereliv/studregis.php");
} 

add_student($conn, $student_number, $section, $email, $first_name, $last_name, $hashed_password);
send_message_and_redirect("Approval Request has been Submitted", "/ereliv/studlogin.php");
    
?>
