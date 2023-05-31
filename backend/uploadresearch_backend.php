<?php
session_start(); // Start the session
include '../db/db.php';
include '../db/queries.php';

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
$abstract = $_POST['content'];
$proposer = $_SESSION['username'];
$authors = $_POST['authors'];
$programs = $_POST['programs'];

$programIDs = json_decode($programs, true);
$authorIDs = json_decode($authors, true);


//Create the Research
$researchID = createResearch($conn, $title, $keywords, $abstract, $proposer);

//Link the Authors
foreach ($authorIDs as $authorID) {
  linkAuthorAndResearch($conn, $authorID, $researchID);
}

//Link the Programs
foreach ($programIDs as $programID) {
  linkProgramAndResearch($conn, $programID, $researchID);
}

//Set Editor Access 
researchEditor($conn, $_SESSION['userID'], $researchID);

send_message_and_redirect('Research has been Uploaded Successfully', "http://localhost/ereliv/faculty/uploadresearch.php");
?>