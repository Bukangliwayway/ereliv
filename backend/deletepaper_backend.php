<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$researchPaper = filter_input(INPUT_POST, 'researchID', FILTER_SANITIZE_STRING);

$client = Elastic\Elasticsearch\ClientBuilder::create()
  ->setHosts(['https://localhost:9200'])
  ->setBasicAuthentication('elastic', 'I_1ghHrS7B6qTK6mwg_F')
  ->setSSLVerification(false)
  ->build();

// Remove in Elastic
$response = $client->delete([
  'index' => 'research',
  'id' => $researchPaper,
]);


if (deleteActivePaper($conn, $researchPaper)) {
  $response['status'] = 'success';
  $response['message'] = "The Paper has been Deleted Successfully";
} else {
  $response['status'] = 'error';
  $response['message'] = "Failed to Delete the Paper";
}


echo json_encode($response);