<?php
  include '../db/db.php';
  include '../db/queries.php';

  $section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
  $string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_STRING);
  
  if(sectionDuplicateCheck($conn, $section))
  send_message_and_redirect($section." was already in the Program", "http://localhost/ereliv/admin/programlist.php");
  
  if(addSection($conn, $section, $string))
  send_message_and_redirect($section." was added successfully", "http://localhost/ereliv/admin/programlist.php");
  
  // send_message_and_redirect($section." was not added, sorry", "http://localhost/ereliv/admin/programlist.php");

