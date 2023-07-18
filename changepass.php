<?php
require_once("backend/session_active.php");
include_once $_SERVER['DOCUMENT_ROOT'] . '/ereliv/backend/randbg_generate.php';
$code = $_GET['code'];
$type = $_GET['type'];
$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
  <div
    class="container-fluid rounded d-flex flex-column align-items-center justify-content-center vh-100 vw-100 rand-bg"
    style="background-image: url('<?php echo $img_src ?>')">
    <div class="p-5 bg-light border border-smoke rounded">
      <h1 class="mb-3 text-capitalized">Change Password</h1>
      <form id="changepassForm" class="d-flex flex-column gap-3">
        <input type="hidden" name="redirect" value="<?php echo $current_url ?>" />
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <input type="hidden" name="code" value="<?php echo $code ?>" />
        <input type="hidden" name="type" value="<?php echo $type ?>" />
        <div class="form-floating">
          <input type="email" id="email" name="emailadd" class="form-control" placeholder="email" required />
          <label for="email" class="form-label">Email</label>
        </div>
        <div class="input-group">
          <div class="form-floating">
            <input type="password" minlength="8" maxlength="20" class="form-control" id="password" name="password"
              placeholder="Must be 8-20 long" required">
            <label for="password" class="form-label">New Password</label>
          </div>
          <button class="btn btn-outline-secondary" type="button" id="toggle-password">
            <i class="bi bi-eye" id="icon-password"></i>
          </button>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>

  <script>
    const displayToastr = (type, message) => {
      toastr[type](message);
    };
    $(document).ready(function () {
      $('#changepassForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        //Loading Routine
        $('#loadingSpinner').removeClass('d-none');
        $('#loadingSpinner').addClass('d-flex');
        $('#changepassForm').css({ 'pointer-events': 'none' });

        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'backend/changepass_backend.php',
          data: formData,
          success: function (response) {
            var data = JSON.parse(response);

            // Display a Toastr success message
            toastr[data.status](data.message);

            // Reset the form after submission
            $("#changepassForm")[0].reset();

            if(data.status == 'success') window.location.href = "index.php";

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
            $('#changepassForm').css('pointer-events', 'auto');
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