<?php
include '../db/db.php';
include '../db/queries.php';

$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);
$original = filter_input(INPUT_POST, 'original', FILTER_SANITIZE_STRING);

if (programDuplicateCheck($conn, $program))
  send_message_and_redirect($program . " is already in the System", "http://localhost/ereliv/admin/");

if (editProgram($conn, $program, $original))
  send_message_and_redirect($program . " was updated successfully", "http://localhost/ereliv/admin/");