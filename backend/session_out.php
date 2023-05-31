<?php
session_start();

$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to another page after signout
header("Location: /ereliv/");
exit();
?>