<?php require_once("../backend/session_student.php"); ?>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- tinycloud -->
    <script src="https://cdn.tiny.cloud/1/o7w7sdre55xscvrprwcvde6nwnv4n2in1tg6taczesi9jmh2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
    
  <!-- bootstrap-multiselect links -->
  <link rel="stylesheet" href="bootstrap-multiselect/docs/css/bootstrap-4.5.2.min.css" type="text/css" />
  <link rel="stylesheet" href="bootstrap-multiselect/docs/css/prettify.min.css" type="text/css" />
  <link rel="stylesheet" href="bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css" />
  <link rel="stylesheet" href="bootstrap-multiselect/docs/css/bootstrap-example.min.css" type="text/css" />
  <script data-main="bootstrap-multiselect/dist/js/" src="bootstrap-multiselect/docs/js/prettify.min.js"></script>
  <script data-main="bootstrap-multiselect/dist/js/" src="bootstrap-multiselect/docs/js/jquery-2.2.4.min.js"></script>
  <script type="text/javascript" src="bootstrap-multiselect/docs/js/bootstrap.bundle-4.5.2.min.js"></script>
  <script data-main="bootstrap-multiselect/dist/js/" src="bootstrap-multiselect/docs/js/require-2.3.5.min.js"></script>
  <!-- bootstrap-multiselect links -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

</head>

<body>
  <?php
  include '../db/db.php';
  include '../db/queries.php';
  ?>
  <div id="loadingSpinner" class="position-fixed top-0 start-0 d-none justify-content-center align-items-baseline pt-5"
    style="width: 100vw; height: 100vh; background-color: rgba(0, 0, 0, 0.2); z-index: 9999;">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>

  <div class=" d-flex flex-row">
    <nav class="col-3 navbar navbar-expand-lg navbar-dark bg-dark flex-column min-vh-100">
      <div class="d-flex flex-column align-items-stretch p-3">
        <a class="navbar-brand mx-auto my-3 text-center" href="http://localhost/ereliv/faculty">
          <img src="../assets/puplogo.png" alt="logo hehe" class="img-fluid" style="max-width: 80%;" />
        </a>
        <h2 class="text-center text-success text-capitalize mb-4"><i class="bi bi-person-fill"></i>
          <?php echo $_SESSION['username']; ?>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex flex-column flex-grow-1" style="height:55vh;">
            <button class="btn btn-outline-success mb-2 toggle-btn" id="uploadresearchBtn"
              data-container="uploadresearchContainer">
              <i class="bi bi-plus-lg"></i>
              Research
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="notificationsBtn"
              data-container="notificationsContainer">
              <i class="bi bi-bell-fill"></i>
              Notifications
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="searchresearchBtn"
              data-container="searchresearchContainer">
              <i class="bi bi-search"></i>
              Research
            </button>

            <a href="#addauthormodal" class="btn btn-outline-primary mb-2 mt-auto " data-bs-toggle="modal">
              <i class="bi bi-plus-lg"></i>
              Author
            </a>
            <a href="#signoutmodal" class="btn btn-outline-danger mb-2" id="signoutBtn" data-bs-toggle="modal">
              <i class="bi bi-box-arrow-right"></i>
              Sign Out
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container p-5">
      <div id="uploadresearchContainer" class="d-none toggle-visibility">
        <?php include 'uploadresearch.php'; ?>
      </div>
      <div id="notificationsContainer" class="d-none toggle-visibility">
        <?php include 'notifications.php'; ?>
      </div>
      <div id="searchresearchContainer" class="d-none toggle-visibility">
        <?php include 'searchresearch.php'; ?>
      </div>
    </div>

  </div>
  <!-- modals -->
  <div class="modal fade" id="signoutmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="signout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize text-center">
            Sign Out?
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form method="POST" action="../backend/session_out.php" class="container d-flex flex-row gap-3">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-capitalize text-center">
            Add Author
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="container modal-body">
          <form id="addAuthorForm" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname"
                required />
              <label for="firstname" class="form-label">First Name</label>
            </div>
            <div class="form-floating">
              <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" required />
              <label for="lastname" class="form-label">Last Name</label>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
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


      // Submit form using AJAX
      $('#addAuthorForm').submit(function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Serialize form data
        var formData = $(this).serialize();

        $.ajax({
          url: '../backend/addauthor_backend.php',
          method: 'POST',
          data: formData,
          dataType: 'json',
          beforeSend: function () {
            // Show loading animation or do any pre-request tasks
            $('#loadingSpinner').removeClass('d-none');
            $('#loadingSpinner').addClass('d-flex');
            $('#addAuthorForm').css({ 'pointer-events': 'none' });
          },
          success: function (data) {
            // Hide loading animation
            $('#loadingSpinner').removeClass('d-flex');
            $('#loadingSpinner').addClass('d-none');
            $('#addAuthorForm').css('pointer-events', 'auto');

            displayToastr(data.status, data.message);
            $('#addAuthorForm')[0].reset();
          },
          error: function () {
            // Hide loading animation
            $('#loadingSpinner').removeClass('d-flex');
            $('#loadingSpinner').addClass('d-none');
            $('#addAuthorForm').css('pointer-events', 'auto');

            // Handle error response here
            displayToastr('error', 'An error occurred. Please try again.');
          },
          complete: function () {
            // Hide loading animation or do any post-request tasks
            $('#loadingSpinner').removeClass('d-flex');
            $('#loadingSpinner').addClass('d-none');
            $('#addAuthorForm').css('pointer-events', 'auto');
          }
        });
      });

      tinymce.init({
        selector: 'textarea',
        plugins: "",
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough',
        height: 250,
        menubar: false,
        setup: function (editor) {
          editor.on('change', function () {
            document.getElementById('content').value = tinymce.get('content-input').getContent();
          });
        }
      });

      var selectedOptionsAuthors = [];
      var selectedOptionsPrograms = [];

      var dataInputAuthors = document.getElementById('authors');
      $("#author-select").on("change", function () {
        selectedOptionsAuthors = $(this).val();
        dataInputAuthors.value = JSON.stringify(selectedOptionsAuthors);
      });

      var dataInputPrograms = document.getElementById('programs');
      $("#program-select").on("change", function () {
        selectedOptionsPrograms = $(this).val();
        dataInputPrograms.value = JSON.stringify(selectedOptionsPrograms);
      });

      // Get the Containers
      var uploadresearchContainer = document.querySelector("#uploadresearchContainer");
      var notificationsContainer = document.querySelector("#notificationsContainer");
      var searchresearchContainer = document.querySelector("#searchresearchContainer");

      // Get the button elements
      var uploadresearchBtn = document.getElementById("uploadresearchBtn");
      var notificationsBtn = document.getElementById("notificationsBtn");
      var searchresearchBtn = document.getElementById("searchresearchBtn");

      // Get the buttons and div containers
      const buttons = document.querySelectorAll(".toggle-btn");
      const containers = document.querySelectorAll(".toggle-visibility");

      // Function to toggle visibility of div containers
      const toggleView = (containerToShow) => {
        // Hide all div containers
        containers.forEach((container) => {
          container.classList.add("d-none");
        });

        // Show the selected container
        containerToShow.classList.remove("d-none");
      };

      // Add click event listener to the button container
      document.addEventListener("click", (event) => {
        const target = event.target;

        // Check if the clicked element is a button
        if (target.classList.contains("toggle-btn")) {
          const containerId = target.dataset.container;
          const containerToShow = document.getElementById(containerId);

          // Toggle the visibility of div containers
          toggleView(containerToShow);

          // Toggle the active class on buttons
          buttons.forEach((button) => {
            button.classList.toggle("active", button === target);
          });
        }
      });
    });
  </script>
</body>

</html>