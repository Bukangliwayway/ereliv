<?php
require_once("backend/session_active.php");
include_once $_SERVER['DOCUMENT_ROOT'] . '/ereliv/backend/randbg_generate.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles/main.css" />
</head>

<body>

  <div class="row vh-100 m-0">
    <div class="col-md-8 rand-bg d-none d-sm-block" style="background-image: url('<?php echo $img_src ?>')"></div>
    <div
      class="col-md-4 col-sm-auto d-flex flex-column just justify-content-center align-items-center text-center gap-3 contain-form">
      <!-- <a href="index.php">
        <img src="assets/puplogo.png" alt="logohehe" width="60%" class="align-self-center" />
      </a> -->
      <h1 class="fs-2 fw-bold text-uppercase">
        Research Paper Management
      </h1>
      <p class="select-role-text fw-light m-0">
        Please select your role by clicking one of the button below.
      </p>
      <div class="d-flex justify-content-stretch flex-column gap-2 w-100 mb-3">
        <a href="facultylogin.php" class="btn btn-danger">Faculty </a>
        <a href="adminlogin.php" class="btn btn-dark">Admin</a>
      </div>
      <p class="fw-light">
        By using this service, you understood and agree to the PUP Online
        Services
        <a href="https://www.pup.edu.ph/terms/" target="_blank">
          Terms of Use
        </a>
        and
        <a href="https://www.pup.edu.ph/privacy" target="_blank">
          Privacy Statement
        </a>
      </p>
    </div>
  </div>
</body>

</html>