<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$researchPaper = filter_input(INPUT_POST, 'researchID', FILTER_SANITIZE_STRING);

$ch = curl_init();

  // Set cURL options
  $url = 'https://polytechnic-universi-8886090444.us-east-1.bonsaisearch.net:443/research/_doc/' . $researchPaper;
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

if (deleteActivePaper($conn, $researchPaper)) {
  $response['status'] = 'success';
  $response['message'] = "The Paper has been Deleted Successfully";
} else {
  $response['status'] = 'error';
  $response['message'] = "Failed to Delete the Paper";
}


echo json_encode($response);