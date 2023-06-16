<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$section = filter_input(INPUT_POST, 'section', FILTER_SANITIZE_STRING);

$response = array();

if (getStudentsBySection($conn, $section)) {
  $response['status'] = 'error';
  $response['message'] = "Deletion failed. $section has students in it";
} else {
  if (deleteSection($conn, $section)) {
    $response['status'] = 'success';
    $response['message'] = "$section was deleted successfully";
  } else {
    $response['status'] = 'error';
    $response['message'] = "Failed to delete $section";
  }
}

echo json_encode($response);