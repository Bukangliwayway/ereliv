<?php
include_once '../backend/csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

$response = getStatusesAnalytics($conn);

header('Content-Type: application/json');
echo json_encode($response);
?>