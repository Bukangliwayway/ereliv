<?php
session_start(); // Start the session
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$redirect = "/ereliv/";

//Redirects users when they are still online
if (!empty($_SESSION['userID'])) {
  $redirect = "/ereliv/" . $_SESSION['usertype'];
  echo "<script>
        setTimeout(function() {
            alert('Signout First!');
            window.location.replace('$redirect');
        }, 500);
      </script>";
  exit();
}

?>