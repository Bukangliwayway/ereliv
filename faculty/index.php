<?php require_once("../backend/session_faculty.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <!-- tinycloud -->
  <script src="https://cdn.tiny.cloud/1/o7w7sdre55xscvrprwcvde6nwnv4n2in1tg6taczesi9jmh2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>

  <!-- datepicker -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
  </script>


  <!-- bootstrap-multiselect links -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bootstrap-multiselect/docs/css/bootstrap-4.5.2.min.css" type="text/css" />
  <link rel="stylesheet" href="../bootstrap-multiselect/docs/css/prettify.min.css" type="text/css" />
  <link rel="stylesheet" href="../bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css" />
  <link rel="stylesheet" href="../bootstrap-multiselect/docs/css/bootstrap-example.min.css" type="text/css" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
  <script data-main="../bootstrap-multiselect/dist/js/" src="../bootstrap-multiselect/docs/js/prettify.min.js">
  </script>
  <script data-main="../bootstrap-multiselect/dist/js/" src="../bootstrap-multiselect/docs/js/jquery-2.2.4.min.js">
  </script>
  <script data-main="../bootstrap-multiselect/dist/js/" src="../bootstrap-multiselect/docs/js/require-2.3.5.min.js">
  </script>
  <script data-main="../bootstrap-multiselect/dist/js/" src="
    ../bootstrap-multiselect/dist/js/bootstrap-multiselect.min.js"></script>

  <!-- bootstrap-5 and Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
  <script src="main.js"></script>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <?php
  include '../db/db.php';
  include '../db/queries.php';
  include 'modals.php';

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
              <i class="bi bi-upload"></i>
              Publish
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="notificationsBtn"
              data-container="notificationsContainer">
              <i class="bi bi-bell-fill"></i>
              Notifications
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="myworksBtn" data-container="myworksContainer">
              <i class="bi bi-clipboard-data"></i>
              My Works
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="adviseesBtn" data-container="adviseesContainer">
              <i class="bi bi-person-circle"></i>
              Advisees
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="searchresearchBtn"
              data-container="searchresearchContainer">
              <i class="bi bi-search"></i>
              Research
            </button>

            <button class="btn btn-outline-success mb-2 toggle-btn" id="modifycategoriesBtn"
              data-container="modifycategoriesContainer">
              <i class="bi bi-pencil"></i>
              Categories
            </button>

            <a href="#signoutmodal" class="btn btn-outline-danger mb-2 mt-auto" id="signoutBtn" data-bs-toggle="modal">
              <i class="bi bi-box-arrow-right"></i>
              Sign Out
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container-fluid p-0">
      <div id="uploadresearchContainer" class="d-none toggle-visibility h-100">
        <?php include 'uploadresearch.php'; ?>
      </div>
      <div id="notificationsContainer" class="d-none toggle-visibility h-100">
        <?php include 'notifications.php'; ?>
      </div>
      <div id="myworksContainer" class="d-none toggle-visibility h-100">
        <?php include 'myworks.php'; ?>
      </div>
      <div id="adviseesContainer" class="d-none toggle-visibility h-100">
        <?php include 'advisees.php'; ?>
      </div>
      <div id="searchresearchContainer" class="d-none toggle-visibility h-100">
        <?php include 'searchresearch.php'; ?>
      </div>
      <div id="modifycategoriesContainer" class="d-none toggle-visibility h-100">
        <?php include 'modifycategories.php'; ?>
      </div>
    </div>

  </div>

  <script>
    const indexButton = document.querySelectorAll(".toggle-btn");
    const containers = document.querySelectorAll(".toggle-visibility");

    document.addEventListener("DOMContentLoaded", function () {

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

          // Toggle the active class on indexButton
          indexButton.forEach((button) => {
            button.classList.toggle("active", button === target);
          });
        }
      });

    });
    document
      .querySelector("#uploadresearchBtn")
      .addEventListener("click", function (event) {
        if (event.isTrusted) {
          clearFields();
        }
      });
  </script>

</body>

</html>