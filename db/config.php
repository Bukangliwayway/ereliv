<?php
// Database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'erelivadmin');
define('DB_PASSWORD', 'ereliv2023');
define('DB_NAME', 'ereliv');

// Website URL
define('SITE_URL', 'http://localhost/ereliv');

// Session configuration
ini_set('session.cookie_httponly', true);
ini_set('session.use_only_cookies', true);
ini_set('session.cookie_secure', true);
session_start();
?>