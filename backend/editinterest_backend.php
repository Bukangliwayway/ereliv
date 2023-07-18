<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$interestID = filter_input(INPUT_POST, 'interestID', FILTER_SANITIZE_NUMBER_INT);

try {
  editInterest($conn, $name, $interestID);
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