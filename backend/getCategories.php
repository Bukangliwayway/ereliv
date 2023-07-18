<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

// Simulating fetching categories from the database based on table content ID
if (isset($_POST['table'])) {
  $table = $_POST['table'];

  // Fetch categories from the database based on the table content
  $categories = getList($conn, '*', $table);


  header('Content-Type: application/json'); // Set the response header
  echo json_encode($categories); // Echo the JSON response
}
?>