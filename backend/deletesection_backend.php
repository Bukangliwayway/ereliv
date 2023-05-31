<?php
include '../db/db.php';
include '../db/queries.php';

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);

if (getStudentsBySection($conn, $section))
  send_message_and_redirect("Deletion failed. ".$section . " has students in it", "http://localhost/ereliv/admin/?programListContainer=block");
echo $section;

if (deleteSection($conn, $section))
  send_message_and_redirect($section . " was deleted successfully", "http://localhost/ereliv/admin/?programListContainer=block");