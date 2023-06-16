<?php
require_once("backend/session_active.php");
include 'db/db.php';
include 'db/queries.php';
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />

  <link rel="stylesheet" href="styles/main.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

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
      <h1 class="fs-2 fw-bold text-uppercase">
        PUPQC student registration form
      </h1>
      <form id="studregisForm" class="d-flex flex-column gap-1 px-3">
        <div class="form-floating mb-3">
          <input type="text" id="studentnumber" class="form-control" name="studentnumber" required
            pattern="\d{4}-\d{5}-[A-Z]{2}-\d" title="Please enter a valid student number in the format 2020-00001-CM-0"
            placeholder="Example format 2020-00001-CM-0" />
          <label for="studentnumber" class="form-label">Student Number</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname" required />
          <label for="firstname" class="form-label">First Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" required />
          <label for="lastname" class="form-label">Last Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="emailadd" id="emailadd" name="emailadd" class="form-control" placeholder="emailadd" required />
          <label for="emailadd" class="form-label">Email</label>
        </div>
        <div class="form-floating mb-3">
          <select id="program" name="program" class="form-select" required>
            <option value="" disabled selected>Select Program</option>
            <?php
            $program = getList($conn, '*', 'Program');
            foreach ($program as $programData) {
              echo '<option value="' . $programData['name'] . '" data-id="' . $programData["programID"] . '">' . $programData['name'] . '</option>';
            }
            ;
            ?>
          </select>
          <label for="program" class="form-label">Program</label>
        </div>
        <div class="form-floating mb-3">
          <select id="section" name="section" class="form-select" required disabled>
            <option value="" disabled selected>Select Section</option>
          </select>
          <label for="section" class="form-label">Section</label>
        </div>
        <div class="form-floating mb-3">
          <select id="advisor" name="advisor" class="form-select" required>
            <option value="" disabled selected>Select Advisor</option>
            <?php
            $advisor = getList($conn, '*', 'Faculty');
            foreach ($advisor as $advisorData) {
              $nameParts = explode(' ', $advisorData['firstname']);
              $initials = '';
              foreach ($nameParts as $part)
                $initials .= strtoupper(substr($part, 0, 1)) . '. ';

              echo '<option value="' . $advisorData['facultyID'] . '" class="text-capitalize"> Prof. ' . ucwords($advisorData['lastname']) . ' ' . $initials . '</option>';
            }
            ;
            ?>
          </select>
          <label for="advisor" class="form-label">Advisor</label>
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
        <button type="submit" class="btn btn-primary">Register</button>
      </form>
      <a href="studlogin.php" id="back-to-login"
        class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
        <b class="text-capitalize">Sign In Instead</b>
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


  <script>
    const programInput = document.querySelector('#program');
    const sectionInput = document.querySelector('#section');

    programInput.addEventListener('change', async () => {
      // Clears the options
      sectionInput.innerHTML = '';

      // Adds the disabled element
      const sectionOption = document.createElement('option');
      sectionOption.value = '';
      sectionOption.textContent = 'Select Section';
      sectionOption.disabled = true;
      sectionOption.selected = true;
      sectionInput.appendChild(sectionOption);

      // Enable the Section Select
      const programID = programInput.options[programInput.selectedIndex].dataset.id;
      sectionInput.disabled = (programID === '');

      try {
        // Fetch the CSRF token from the server
        const csrfResponse = await fetch('backend/getcsrftoken.php');
        if (csrfResponse.ok) {
          const csrfToken = await csrfResponse.text();

          // Prepare the request data
          const requestData = new FormData();
          requestData.append('programID', programID);
          requestData.append('csrf_token', csrfToken);

          // Make the AJAX request to get the section options
          const sectionsResponse = await fetch('backend/getSections.php', {
            method: 'POST',
            body: requestData,
          });

          if (sectionsResponse.ok) {
            const data = await sectionsResponse.json();
            const options = data.options;

            $('#section').empty();

            // Add the default "Select Section" option
            const defaultOption = $('<option>', {
              value: '',
              disabled: true,
              selected: true,
              text: 'Select Section'
            });
            $('#section').append(defaultOption);

            // Add the remaining options
            options.forEach((option) => {
              const optionElement = $('<option>', {
                value: option,
                text: option
              });
              $('#section').append(optionElement);
            });
          } else {
            console.error('Error fetching section options:', sectionsResponse.status);
            toastr.error('An error occurred while fetching section options. Please try again.');
          }
        } else {
          console.error('Error fetching CSRF token:', csrfResponse.status);
          toastr.error('An error occurred while fetching the CSRF token. Please try again.');
        }
      } catch (error) {
        console.error('Request failed:', error);
        toastr.error('An error occurred. Please try again.');
      }

    });


    const displayToastr = (type, message) => {
      toastr[type](message);
    };

    $(document).ready(function () {
      $('#studregisForm').submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

        //Loading Routine
        $('#loadingSpinner').removeClass('d-none');
        $('#loadingSpinner').addClass('d-flex');
        $('#studregisForm').css({ 'pointer-events': 'none' });

        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'backend/studregis_backend.php',
          data: formData,
          success: function (response) {
            var data = JSON.parse(response);
            // Display a Toastr success message
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
            $('#studregisForm').css('pointer-events', 'auto');

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