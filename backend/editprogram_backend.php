<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);
$original = filter_input(INPUT_POST, 'original', FILTER_SANITIZE_STRING);

$response = array();

if (programDuplicateCheck($conn, $program)) {
  $response['status'] = 'error';
  $response['message'] = $program . " is already in the system";
} else {
  if (editProgram($conn, $program, $original)) {
    $response['status'] = 'success';
    $response['message'] = $program . " was updated successfully";
    updateStudentsProgram($conn, $original, $program);
  } else {
    $response['status'] = 'error';
    $response['message'] = "Failed to update $program";
  }
}

echo json_encode($response);