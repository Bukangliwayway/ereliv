<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);

$response = array();

if (!noSectionBeforeProgramDeletion($conn, $program)) {
  $response['status'] = 'error';
  $response['message'] = "Delete the sections of the program first";
} else {
  if (deleteProgram($conn, $program)) {
    $response['status'] = 'success';
    $response['message'] = "$program was deleted successfully";
  } else {
    $response['status'] = 'error';
    $response['message'] = "Failed to delete $program";
  }
}

echo json_encode($response);