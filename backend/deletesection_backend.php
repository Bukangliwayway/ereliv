<?php
include '../db/db.php';
include '../db/queries.php';

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);

if (deleteSection($conn, $section))
  send_message_and_redirect($section . " was deleted successfully", "http://localhost/ereliv/admin/");