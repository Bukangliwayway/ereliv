<?php
include '../db/db.php';
include '../db/queries.php';

$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);

if (addProgram($conn, $program))
  send_message_and_redirect($program . " was added successfully", "http://localhost/ereliv/admin/programListContainer=block&facultyRegistrationContainer=none&viewAccountsContainer=none");

send_message_and_redirect($program . " was not added, sorry", "http://localhost/ereliv/admin/programListContainer=block&facultyRegistrationContainer=none&viewAccountsContainer=none");