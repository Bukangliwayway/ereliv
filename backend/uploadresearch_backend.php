<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

// Initialize the response array
$response = array();

try {
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
  $abstract = $_POST['content'];
  $proposer = $_SESSION['username'];
  $authors = $_POST['authors'];
  $programs = $_POST['programs'];

  $programIDs = json_decode($programs, true);
  $authorIDs = json_decode($authors, true);

  // Create the Research
  $researchID = createResearch($conn, $title, $keywords, $abstract, $proposer);

  // Link the Authors
  foreach ($authorIDs as $authorID) {
    linkAuthorAndResearch($conn, $authorID, $researchID);
  }

  // Link the Programs
  foreach ($programIDs as $programID) {
    linkProgramAndResearch($conn, $programID, $researchID);
  }

  // Set Editor Access
  researchEditor($conn, $_SESSION['userID'], $researchID);

  // Set success response
  $response['status'] = 'success';
  $response['message'] = 'Research has been uploaded successfully';
} catch (Exception $e) {
  // Set error response
  $response['status'] = 'error';
  $response['message'] = 'An error occurred. Please try again.';
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
?>