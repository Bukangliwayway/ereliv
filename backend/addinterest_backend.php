<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

if (addInterestExists($conn, $name)) {
  $response = array(
    'status' => 'error',
    'message' => 'Interest is already in the System'
  );
  echo json_encode($response);
  exit();
}

try {
  addInterest($conn, $name);
  $response = array(
    'status' => 'success',
    'message' => 'Interest added successfully'
  );
} catch (Exception $e) {
  $response = array(
    'status' => 'error',
    'message' => 'Failed to add Interest'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>