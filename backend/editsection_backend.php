<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$response = array();

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);
$original = filter_input(INPUT_POST, 'original', FILTER_SANITIZE_STRING);

if (sectionDuplicateCheck($conn, $section)) {
  $response['status'] = 'error';
  $response['message'] = $section . ' was already in the Program';
  echo json_encode($response);
  exit;
}

if (editSection($conn, $section, $original)) {
  $response['status'] = 'success';
  $response['message'] = $section . ' was updated successfully';
  // Update the Section of Students Enrolled in it
  echo json_encode($response);
} else {
  $response['status'] = 'error';
  $response['message'] = 'An error occurred. Please try again.';
  echo json_encode($response);
}
?>  