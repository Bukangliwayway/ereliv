<?php
session_start(); // Start the session
// Check if the session is null or empty
if (empty($_SESSION['userID']) || $_SESSION['usertype'] != "admin") {
  // Redirect the user back to the login page 
  echo "<script>
        setTimeout(function() {
            alert('You have no access here!');
            window.location.replace('/ereliv/');
        }, 500);
      </script>";
  exit();
}

?>