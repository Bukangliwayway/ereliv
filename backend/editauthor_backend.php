<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$authorID = filter_input(INPUT_POST, 'authorID', FILTER_SANITIZE_NUMBER_INT);
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

try {
  editAuthor($conn, $firstname, $lastname, $authorID);
  $response = array(
    'status' => 'success',
    'message' => 'Author Updated Successfully!'
  );
} catch (Exception $e) {
  $response = array(
    'status' => 'error',
    'message' => 'Failed to Update Author'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>