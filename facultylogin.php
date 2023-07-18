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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="styles/main.css" />

</head>

<body>
  <div id="loadingSpinner" class="position-fixed top-0 start-0 d-none justify-content-center align-items-baseline pt-5"
    style="width: 100vw; height: 100vh; background-color: rgba(0, 0, 0, 0.2); z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  <div class="row vh-100 m-0">
    <div class="col-md-8 rand-bg d-none d-sm-block" style="background-image: url('<?php echo $img_src ?>')"></div>
    <div
      class="col-md-4 col-sm-auto d-flex flex-column just justify-content-center align-items-stretch text-center gap-3 contain-form">
      <a href="http://localhost/ereliv/">
        <img src="assets/puplogo.png" alt="logohehe" width="60%" class="align-self-center" />
      </a>
      <h1 class="fs-2 fw-bold text-uppercase">PUPQC Faculty Login Form</h1>
      <form id="facultyloginForm" class="d-flex flex-column gap-1 px-3">
        <div class="form-floating mb-3">
          <input type="text" id="emailadd" name="emailadd" class="form-control" placeholder="emailadd" required />
          <label for="emailadd" class="form-label">Email Address</label>
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
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit" class="btn btn-primary">Sign In</button>
      </form>
      <a href="#resetPassModal" id="forgot-pass"
        class="link-danger link-offset-2 link-underline-opacity-0 link-underline-opacity-100-hover text-capitalize"
        data-bs-toggle="modal">
        <b>🗝️ I forgot my password</b>
      </a>
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
  <!-- Modal -->
  <div class="modal fade" id="resetPassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="resetPassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="resetPassModalLabel">
            Password Reset
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form id="resetPassForm" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="email" name="emailadd" class="form-control" placeholder="emailadd" required />
              <label for="email" class="form-label">Email Address</label>
            </div>
            <input type="hidden" name="type" value="Faculty" />
            <input type="hidden" name="redirect" value="/ereliv/facultylogin.php" />
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn btn-primary">Reset</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    const displayToastr = (type, message) => {
      toastr[type](message);
    };
    $(document).ready(function () {
      $('#facultyloginForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        //Loading Routine
        $('#loadingSpinner').removeClass('d-none');
        $('#loadingSpinner').addClass('d-flex');
        $('#facultyloginForm').css({ 'pointer-events': 'none' });

        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'backend/facultylogin_backend.php',
          data: formData,
          success: function (response) {
            var data = JSON.parse(response);
            // Display a Toastr success message
            if (data.status === 'success') {
              // Redirect to the admin panel
              window.location.href = data.redirect;
            }
            displayToastr(data.status, data.message);
          },
          error: function (xhr, status, error) {
            // Handle error response here
            console.log(xhr.responseText);
            toastr.error('An error occurred. Please try again.');
          },
          complete: function () {
            // Revert Loading Routine back to normal
            $('#loadingSpinner').removeClass('d-flex');
            $('#loadingSpinner').addClass('d-none');
            $('#facultyloginForm').css('pointer-events', 'auto');

          }
        });
      });
      $('#resetPassForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        //Loading Routine
        $('#loadingSpinner').removeClass('d-none');
        $('#loadingSpinner').addClass('d-flex');
        $('#resetPassForm').css({ 'pointer-events': 'none' });

        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'backend/forgotpass_backend.php',
          data: formData,
          success: function (response) {
            var data = JSON.parse(response);
            displayToastr(data.status, data.message);
          },
          error: function (xhr, status, error) {
            // Handle error response here
            console.log(xhr.responseText);
            toastr.error('An error occurred. Please try again.');
          },
          complete: function () {
            // Revert Loading Routine back to normal
            $('#loadingSpinner').removeClass('d-flex');
            $('#loadingSpinner').addClass('d-none');
            $('#resetPassForm').css('pointer-events', 'auto');
            $('#resetPassModal').modal('hide');


          }
        });
      });
    });
    const passwordInput = document.getElementById("password");
    const togglePassword = document.getElementById("toggle-password");
    const iconPassword = document.getElementById("icon-password");

    togglePassword.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        iconPassword.classList.remove("bi-eye");
        iconPassword.classList.add("bi-eye-slash");
      } else {
        passwordInput.type = "password";
        iconPassword.classList.remove("bi-eye-slash");
        iconPassword.classList.add("bi-eye");
      }
    });

  </script>

</body>

</html>