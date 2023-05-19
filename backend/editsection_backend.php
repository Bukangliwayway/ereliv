<?php
include '../db/db.php';
include '../db/queries.php';

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$original = filter_input(INPUT_POST, 'original', FILTER_SANITIZE_STRING);

if (sectionDuplicateCheck($conn, $section))
  send_message_and_redirect($section . " was already in the Program", "http://localhost/ereliv/admin/programlist.php");

if (editSection($conn, $section, $original))
  send_message_and_redirect($section . " was updated successfully", "http://localhost/ereliv/admin/programlist.php");