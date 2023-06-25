<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

// Initialize the response array
$response = array();

try {
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $abstract = $_POST['content'];
  $datepublished = $_POST['date'];
  $authors = $_POST['authors'];
  $programs = $_POST['programs'];
  $interests = $_POST['interests'];
  $keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
  $status = 'Published';
  $proposer = $_SESSION['username'];
  $facultyProposerID = $_SESSION['userID'];
  $advisorID = $_SESSION['userID'];

  $type = $_POST['type'];

  $programIDs = json_decode($programs, true);
  $authorIDs = json_decode($authors, true);
  $interestIDs = json_decode($interests, true);

  // Create the Research
  $researchID = createResearchFaculty($conn, $title, $abstract, $datepublished, $keywords, $status, $proposer, $facultyProposerID, $advisorID);

  // Link the Authors
  foreach ($authorIDs as $authorID) {
    linkAuthorAndResearch($conn, $authorID, $researchID);
  }

  // Link the Programs
  foreach ($programIDs as $programID) {
    linkProgramAndResearch($conn, $programID, $researchID);
  }

  //Link the Interests
  foreach ($interestIDs as $interestID) {
    linkInterestAndResearch($conn, $interestID, $researchID);
  }
  
  $activePaper = createActivePaper($conn, $facultyProposerID, $researchID);

  // Start Edit History
  createEditHistory($conn, $activePaper, $researchID, $facultyProposerID);

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