<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$string = filter_input(INPUT_POST, 'string', FILTER_SANITIZE_STRING);

$response = array();

// Duplicate
if (sectionDuplicateCheck($conn, $section)) {
  $response['status'] = 'error';
  $response['message'] = $section . ' was already in the Program';
  echo json_encode($response);
  exit();
}

// Success
if (addSection($conn, $section, $string)) {
  $response['status'] = 'success';
  $response['message'] = $section . ' was added successfully';
  echo json_encode($response);
  exit();
}

// Handle other Errors 
$response['status'] = 'error';
$response['message'] = $section . ' was not added, sorry';
echo json_encode($response);

?>