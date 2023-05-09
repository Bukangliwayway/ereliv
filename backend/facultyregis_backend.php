<?php
include '../db/db.php';
include '../db/queries.php';
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$emailadd = filter_input(INPUT_POST, 'emailadd', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

if (emailAddressCheck($conn, $email, 'Faculty')) {
  send_message_and_redirect("Email is already in use", "/ereliv/admin/facultyregis.php");
} 

add_faculty($conn, $firstname, $lastname, $emailadd, $hashed_password, $category);
send_message_and_redirect("Account Successfully Added", "/ereliv/admin/");



