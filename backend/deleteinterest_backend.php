<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$interestID = filter_input(INPUT_POST, 'interestID', FILTER_SANITIZE_NUMBER_INT);


try {
  deleteInterest($conn, $interestID);
  $response = array(
    'status' => 'success',
    'message' => 'Interest Deleted successfully'
  );
} catch (Exception $e) {
  $response = array(
    'status' => 'error',
    'message' => 'Failed to Delete Interest'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>