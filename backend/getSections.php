<?php
include '../db/db.php';
include '../db/queries.php';
// Simulating fetching sections from the database based on program ID
if(isset($_POST['programID'])){
	$programID = $_POST['programID'];

	// Fetch sections from the database based on the program ID
	$sections = getLinkedSection($conn, $programID);

	// Generate HTML options for sections
	$options = '<option value="" disabled selected>Select Section</option>';
	foreach($sections as $section){
		$options .= '<option value="'.$section['name'].'">'.$section['name'].'</option>';
	}

	// Prepare JSON response
	$response = [
		'options' => $options
	];

	echo json_encode($response); // Echo the JSON response
}
