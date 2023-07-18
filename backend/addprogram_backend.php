<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$program = filter_input(INPUT_POST, 'program', FILTER_SANITIZE_STRING);

$response = array();

if (addProgram($conn, $program)) {
  $response['status'] = 'success';
  $response['message'] = $program . " was added successfully";
} else {
  $response['status'] = 'error';
  $response['message'] = "Failed to add $program";
}

echo json_encode($response);