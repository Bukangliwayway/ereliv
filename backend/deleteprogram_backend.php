<?php
  include '../db/db.php';
  include '../db/queries.php';

  $program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);

  if(deleteProgram($conn, $program))
  send_message_and_redirect($program." was deleted successfully", "http://localhost/ereliv/admin/programlist.php");
  

