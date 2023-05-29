<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="styles/main.css" />

</head>

<body>
  <?php
  include_once '/opt/lampp/htdocs/ereliv/backend/randbg_generate.php';
  ?>
  <div class="row vh-100 m-0">
    <div class="col-md-8 rand-bg d-none d-sm-block" style="background-image: url('<?php echo $img_src ?>')"></div>
    <div
      class="col-md-4 col-sm-auto d-flex flex-column just justify-content-center align-items-stretch text-center gap-3 contain-form">
      <img src="assets/puplogo.png" alt="logo hehe" width="60%" class="align-self-center" />
      <h1 class="fs-2 fw-bold text-uppercase">PUPQC Admin Login Form</h1>
      <form method="POST" action="backend/adminlogin_backend.php" class="d-flex flex-column gap-1 px-3">
        <div class="form-floating mb-3">
          <input type="text" id="username" name="username" class="form-control" placeholder="username" required />
          <label for="username" class="form-label">Username</label>
        </div>
        <div class="input-group mb-3">
          <div class="form-floating">
            <input type="password" minlength="8" maxlength="20" class="form-control" id="password" name="password"
              placeholder="Must be 8-20 long" required">
            <label for="password" class="form-label">Password</label>
          </div>
          <button class="btn btn-outline-secondary" type="button" id="toggle-password">
            <i class="bi bi-eye" id="icon-password"></i>
          </button>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
      </form>
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

<script src="scripts/main.js"></script>