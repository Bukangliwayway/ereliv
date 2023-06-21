<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$authorID = filter_input(INPUT_POST, 'authorID', FILTER_SANITIZE_NUMBER_INT);

try {
  deleteAuthor($conn, $authorID);

  $response = array(
    'status' => 'success',
    'message' => 'Author Deleted successfully'
  );
} catch (Exception $e) {
  $response = array(
    'status' => 'error',
    'message' => 'Failed to Delete Author'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>