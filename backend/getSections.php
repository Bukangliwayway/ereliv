<?php
include_once 'csrfTokenCheck.php';
include '../db/db.php';
include '../db/queries.php';

// Simulating fetching sections from the database based on program ID
if (isset($_POST['programID'])) {
	$programID = $_POST['programID'];

	// Fetch sections from the database based on the program ID
	$sections = getLinkedSection($conn, $programID);

	// Generate options array for sections
	$options = [];
	foreach ($sections as $section) {
		$options[] = $section['name'];
	}

	// Prepare JSON response
	$response = [
		'options' => $options
	];

	header('Content-Type: application/json'); // Set the response header
	echo json_encode($response); // Echo the JSON response
}
?>