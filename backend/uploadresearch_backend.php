<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

require '../vendor/autoload.php';
// Initialize the response array


$response = array();

$curlResponse = array();
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
  $facultyProposerName = $_SESSION['username'];
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



  // Remove the Prev Paper if there is:
  if (!empty($researchID)) {
    try {
      $ch = curl_init();
      // Set cURL options
      $url = 'https://polytechnic-universi-8886090444.us-east-1.bonsaisearch.net:443/research/_doc/' . $researchID;
      $headers = array('Content-Type: application/json');
      $credentials = 'm35p75o9i6:7aav4zf2bd';
      // Set cURL options
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_USERPWD, $credentials);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      // Execute cURL session
      $resultDelete = curl_exec($ch);
      // Check for cURL errors
      if (curl_errno($ch)) {
        throw new Exception('cURL error: ' . curl_error($ch));
      }
      // Close cURL session
      curl_close($ch);
    } catch (Exception $e) {
      // Handle exception
      $response['message'] = "An error occurred: {$e->getMessage()}\n";
      $response['status'] = "error";
    }
  }

  // Create the Research
  $researchID = createResearchFaculty($conn, $title, $abstract, $introduction, $methodology, $results, $discussion, $conclusion, $datepublished, $keywords, $status, $proposer, $facultyProposerID, $advisorID, $researchstatus, $researchclassification);


  $author = [];
  foreach ($authorIDs as $authorID) {
    linkAuthorAndResearch($conn, $authorID, $researchID);
    $author[] = getAuthor($conn, $authorID);
  }

  $program = [];
  foreach ($programIDs as $programID) {
    linkProgramAndResearch($conn, $programID, $researchID);
    $program[] = getProgram($conn, $programID);
  }

  $interest = [];
  foreach ($interestIDs as $interestID) {
    linkInterestAndResearch($conn, $interestID, $researchID);
    $interest[] = getInterest($conn, $interestID);
  }


// ElasticIndex
$doc = [
 'index' => 'research',
 'id' => $researchID,
 'body' => [
   'title' => $title,
   'researchID' => $researchID,
   'datepublished' => $datepublished,
   'keywords' => $keywords,
   'status' => $status,
   'proposer' => $proposer,
   'facultyProposerName' => $facultyProposerName,
   'facultyProposerID' => $facultyProposerID,
   'advisorName' => $advisorName,
   'advisorID' => $advisorID,
   'researchstatus' => $researchstatus,
   'researchclassification' => $researchclassification,
   'abstract' => $abstract,
   'introduction' => $introduction,
   'methodology' => $methodology,
   'discussion' => $discussion,
   'results' => $results,
   'conclusion' => $conclusion,
   'program' => $program,
   'author' => $author,
   'interest' => $interest
 ]
];


// Initialize a new cURL session
$ch = curl_init();

// Set the URL for the Elasticsearch endpoint
curl_setopt($ch, CURLOPT_URL, 'https://polytechnic-universi-8886090444.us-east-1.bonsaisearch.net:443/research');

// Set the HTTP method to HEAD
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');

// Don't output the response
curl_setopt($ch, CURLOPT_NOBODY, true);

// Set the username and password for basic authentication
curl_setopt($ch, CURLOPT_USERPWD, 'm35p75o9i6:7aav4zf2bd');

// Execute the cURL request
curl_exec($ch);

// Get the HTTP response code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Close the cURL session
curl_close($ch);

// If the HTTP response code is not 200, the index does not exist, so create it
if($httpCode != 200) {
    // Initialize a new cURL session
    $ch = curl_init();

    // Set the URL for the Elasticsearch endpoint
    curl_setopt($ch, CURLOPT_URL, 'https://polytechnic-universi-8886090444.us-east-1.bonsaisearch.net:443/research');

    // Don't output the response
    curl_setopt($ch, CURLOPT_NOBODY, true);

    // Set the HTTP method to PUT
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

    // Set the Content-Type header to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    // Provide the settings data that you're sending
    $settingsData = json_encode([
        'settings' => [
            'number_of_shards' => 1,
            'number_of_replicas' => 1
        ]
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $settingsData);

    // Set the username and password for basic authentication
    curl_setopt($ch, CURLOPT_USERPWD, 'm35p75o9i6:7aav4zf2bd');

    // Execute the cURL request and get the response
    $curlResponse = curl_exec($ch);

    // Check for errors
    if ($curlResponse === false) {
        // Handle error
        die('Error: ' . curl_error($ch));
    }

    // Close the cURL session
    curl_close($ch);
}




// Convert the doc array to JSON
$jsonData = json_encode($doc['body']);

// Initialize a new cURL session
$ch = curl_init();

// Set the URL for the Elasticsearch endpoint
curl_setopt($ch, CURLOPT_URL, 'https://polytechnic-universi-8886090444.us-east-1.bonsaisearch.net:443/research/_doc/' . $researchID);

// Set the HTTP method to PUT
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

// Set the Content-Type header to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Provide the JSON data that you're sending
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Set the username and password for basic authentication
curl_setopt($ch, CURLOPT_USERPWD, 'm35p75o9i6:7aav4zf2bd');

// // Don't output the response
// curl_setopt($ch, CURLOPT_NOBODY, true);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request and get the response
$curlResponse = curl_exec($ch);

// Get the HTTP response code
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


if($httpCode != 201) {
  $response['status'] = 'error';
  $response['message'] = 'An error occurred while indexing the document in Elasticsearch: ' . $curlResponse;
  $response['nani'] = 'Nanii: ' . $httpCode;
  $response['aaaaa'] = 'aaaaa: ' . $researchID;
  header('Content-Type: application/json');
  echo json_encode($response);
  curl_close($ch);
  exit;
}

// Close the cURL session
curl_close($ch);

// Check for errors
if ($curlResponse === false) {
 // Handle error
 $response['status'] = 'error';
 $response['message'] = 'An error occurred while indexing the document in Elasticsearch: ' . curl_error($ch);
 
} else {
  // Handle response
  $response['status'] = 'success';
  $response['message'] = 'Research has been Uploaded Successfully';
}

// Close the cURL session
curl_close($ch);


if (empty($_POST['researchID'])) {
  $activePaper = createActivePaper($conn, $facultyProposerID, $researchID);
  $response['message'] = 'Research has been Uploaded Successfully';
} else {
  $activePaper = updateActivePaper($conn, $researchID, $_POST['researchID']);
  $response['message'] = 'Research has been Updated Successfully';
}

$response['status'] = 'success';

createEditHistory($conn, $activePaper, $researchID, $facultyProposerID);


header('Content-Type: application/json');
echo json_encode($response);
exit;
} catch (Exception $e) {
  // Set error response
  $response['status'] = 'error';
  $response['message'] = "An error occurred: {$e->getMessage()}\n";
}

?>

