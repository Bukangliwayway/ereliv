<?php
include '../db/db.php';
include '../db/queries.php';

$studentnumber = filter_input(INPUT_POST, 'studentnumber', FILTER_SANITIZE_STRING);
$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);
$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_EMAIL);
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$advisor = filter_input(INPUT_POST, 'advisor', FILTER_SANITIZE_STRING);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

if (studentNumberExists($conn, $studentnumber))
  send_message_and_redirect("Student number is already in use", "/ereliv/studregis.php");

if (emailAddressCheck($conn, $emailadd, 'Student'))
  send_message_and_redirect("Email is already in use", "/ereliv/studregis.php");

addStudent($conn, $studentnumber, $program, $section, $emailadd, $firstname, $lastname, $hashedPassword, $advisor);

linkStudentAndAdvisor($conn, $emailadd, $advisor);

$redirect = "http://localhost/ereliv/studregis.php";
$title = "PUPQCRMS Student Account Approval Request has been Sent";
$body = "Upon registration, an Approval Request is promptly sent to the advisor you have selected. We kindly request their timely attention to review and approve your account.<br><br>In the event that the advisor fails to approve your account within a period of two days, our system will automatically notify the administrator. This ensures that appropriate measures are taken to facilitate the approval process.<br><br>We emphasize the importance of a timely response to ensure a smooth account activation. Your cooperation in this matter is greatly appreciated.<br><br>If you have any questions or require further assistance, please do not hesitate to reach out to our support team.<br><br>Thank you for choosing our services.<br><br><br>Best regards,<br>PUPQCRMS - Ereliv";
sendEmail($conn, $emailadd, $title, $body, $redirect);

send_message_and_redirect("Student Account has been Submitted", $redirect);



?>