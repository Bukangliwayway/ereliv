<?php

// Define database connection parameters
$db_host = "localhost";
$db_user = "erelivadmin";
$db_pass = "ereliv2023";
$db_name = "ereliv";

try {   
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


