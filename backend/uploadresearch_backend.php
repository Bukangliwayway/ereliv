<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

require '../vendor/autoload.php';

// Initialize the response array
$response = array();
try {
  $researchID = $_POST['researchID'];
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $abstract = $_POST['abstract-input'];
  $introduction = $_POST['introduction-input'];
  $methodology = $_POST['methodology-input'];
  $results = $_POST['results-input'];
  $discussion = $_POST['discussion-input'];
  $conclusion = $_POST['conclusion-input'];
  $datepublished = $_POST['date'];
  $authors = $_POST['authors'];
  $interests = $_POST['interests'];
  $programs = $_POST['programs'];
  $keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_STRING);
  $proposer = $_SESSION['username'];
  $facultyProposerID = $_SESSION['userID'];
  $facultyProposerIName = $_SESSION['username'];
  $advisorID = $_SESSION['userID'];
  $advisorName = $_SESSION['username'];
  $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
  $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
  $researchstatus = filter_input(INPUT_POST, 'researchstatus', FILTER_SANITIZE_STRING);
  $researchclassification = filter_input(INPUT_POST, 'researchclassification', FILTER_SANITIZE_STRING);

  if (empty($researchstatus) || empty($researchclassification)) {
    $response['message'] = 'Fill the Required Forms. Please try again.';
    $response['status'] = 'error';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }

  if (!isValidDate($datepublished)) {
    $response['message'] = 'Invalid Date Format. Please try again.';
    $response['status'] = 'error';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }

  $programIDs = json_decode($programs, true);
  $authorIDs = json_decode($authors, true);
  $interestIDs = json_decode($interests, true);



  $client = Elastic\Elasticsearch\ClientBuilder::create()
    ->setHosts(['https://localhost:9200'])
    ->setBasicAuthentication('elastic', 'I_1ghHrS7B6qTK6mwg_F')
    ->setSSLVerification(false)
    ->build();


  // Remove the Prev Paper if there is:
  if (!empty($researchID)) {
    $response = $client->delete([
      'index' => 'research',
      'id' => $researchID,
    ]);
  }

  // Create the Research
  $researchID = createResearchFaculty($conn, $title, $abstract, $introduction, $methodology, $results, $discussion, $conclusion, $datepublished, $keywords, $status, $proposer, $facultyProposerID, $advisorID, $researchstatus, $researchclassification);


  $authorArray = [];
  foreach ($authorIDs as $authorID) {
    linkAuthorAndResearch($conn, $authorID, $researchID);
    $authorArray[] = getAuthorName($conn, $authorID);
  }

  $programArray = [];
  foreach ($programIDs as $programID) {
    linkProgramAndResearch($conn, $programID, $researchID);
    $programArray[] = getProgramName($conn, $programID);
  }

  $interestArray = [];
  foreach ($interestIDs as $interestID) {
    linkInterestAndResearch($conn, $interestID, $researchID);
    $interestArray[] = getInterestName($conn, $interestID);
  }


  // ElasticIndex
  $doc = [
    'index' => 'research',
    'id' => $researchID,
    'body' => [
      'title' => $title,
      'datepublished' => $datepublished,
      'keywords' => $keywords,
      'status' => $status,
      'proposer' => $proposer,
      'facultyProposerName' => $facultyProposerIName,
      'advisorName' => $advisorName,
      'researchstatus' => $researchstatus,
      'researchclassification' => $researchclassification,
      'abstract' => $abstract,
      'introduction' => $introduction,
      'methodology' => $methodology,
      'discussion' => $discussion,
      'results' => $results,
      'conclusion' => $conclusion,
      'programs' => $programArray,
      'author' => $authorArray,
      'interest' => $interestArray
    ]
  ];

  $params = [
    'index' => 'research',
    'id' => $researchID,
    'body' => [
      'doc' => $doc['body']
    ]
  ];

  // ElasticIndex

  try {
    $client->index($doc);
  } catch (Exception $e) {
    // Handle the exception
    $response['status'] = 'error';
    $response['message'] = 'An error occurred while indexing the document in Elasticsearch: ' . $e->getMessage();
    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
  }

  $response = $doc;

  if (empty($_POST['researchID'])) {
    $activePaper = createActivePaper($conn, $facultyProposerID, $researchID);
    $response['message'] = 'Research has been Uploaded Successfully';
  } else {
    $activePaper = updateActivePaper($conn, $researchID, $_POST['researchID']);
    $response['message'] = 'Research has been Updated Successfully';
  }

  $response['status'] = 'success';

  createEditHistory($conn, $activePaper, $researchID, $facultyProposerID);
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