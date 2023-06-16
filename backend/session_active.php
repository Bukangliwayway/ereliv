<?php
session_start(); // Start the session
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$redirect = "/ereliv/";

//Redirects users when they are still online
if (!empty($_SESSION['userID'])) {
  $redirect = "http://localhost/ereliv/" . $_SESSION['usertype'];
  // if ($_SESSION['usertype'] == "admin")
  //   $redirect = "http://localhost/ereliv/admin";
  // if ($_SESSION['usertype'] == "student")
  //   $redirect = "http://localhost/ereliv/student";
  // if ($_SESSION['usertype'] == "faculty")
  //   $redirect = "http://localhost/ereliv/faculty";
  echo "<script>
        setTimeout(function() {
            alert('Signout First!');
            window.location.replace('$redirect');
        }, 500);
      </script>";
  exit();
}

?>