<?php
include '../db/db.php';
include '../db/queries.php';

$string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);

if ($user == "Student" && toggleStudentAccount($conn, $string, $status))
  send_message_and_redirect("Student Account was Updated successfully", "http://localhost/ereliv/admin/");

if ($user == "Faculty" && toggleFacultyAccount($conn, $string, $status)) {
  toggleFacultyAccount($conn, $string, $status);
  send_message_and_redirect("Faculty Account was Updated successfully", "http://localhost/ereliv/admin/");
}