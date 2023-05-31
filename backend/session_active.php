<?php
session_start(); // Start the session
$redirect = "/ereliv/";
if (!empty($_SESSION['userID'])) {
  if($_SESSION['usertype'] == "admin") $redirect = "http://localhost/ereliv/admin/";
  if($_SESSION['usertype'] == "student") $redirect = "http://localhost/ereliv/student";
  if($_SESSION['usertype'] == "faculty") $redirect = "http://localhost/ereliv/faculty";
  echo "<script>
        setTimeout(function() {
            alert('Signout First!');
            window.location.replace('$redirect');
        }, 500);
      </script>";
  exit();
}

?>