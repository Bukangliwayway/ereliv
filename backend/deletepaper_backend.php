<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$researchPaper = filter_input(INPUT_POST, 'researchID', FILTER_SANITIZE_STRING);

if (deleteActivePaper($conn, $researchPaper)) {
  $response['status'] = 'success';
  $response['message'] = "The Paper has been Deleted Successfully";
} else {
  $response['status'] = 'error';
  $response['message'] = "Failed to Delete the Paper";
}


echo json_encode($response);