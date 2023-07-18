<?php

// Define database connection parameters
$db_host = "localhost";
$db_user = "root"; //id20948457_root	
$db_pass = ""; // XiMQu)p+6{[c&>s0
$db_name = "ereliv"; // id20948457_ereliv	

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>