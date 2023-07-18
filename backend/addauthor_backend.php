<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

if (addAuthorExists($conn, $firstname, $lastname)) {
  $response = array(
    'status' => 'error',
    'message' => 'Author is already in the System'
  );
  echo json_encode($response);
  exit();
}

try {
  addAuthor($conn, $firstname, $lastname);

  $response = array(
    'status' => 'success',
    'message' => 'Author added successfully'
  );
} catch (Exception $e) {
  $response = array(
    'status' => 'error',
    'message' => 'Failed to add author'
  );
}

header('Content-Type: application/json');
echo json_encode($response);
?>