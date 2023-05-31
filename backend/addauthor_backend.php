<?php
session_start(); // Start the session
include '../db/db.php';
include '../db/queries.php';

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

addAuthor($conn, $firstname, $lastname);

send_message_and_redirect("Author Added Succesfully", "http://localhost/ereliv/faculty/");

?>