<?php require_once("../backend/session_admin.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PUPQC Research Management Sytem</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
        <a class="navbar-brand mx-auto my-3 text-center" href="http://localhost/ereliv/admin">
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
            <button class="btn btn-outline-success mb-2 toggle-btn" id="addProgramsBtn"
              data-container="programListContainer">
              <i class="bi bi-plus-lg"></i> Programs and Sections
            </button>
            <button class="btn btn-outline-success mb-2 toggle-btn" id="addFacultyBtn"
              data-container="facultyRegistrationContainer">
              <i class="bi bi-plus-lg"></i> Faculty
            </button>
            <button class="btn btn-outline-success mb-2 toggle-btn" id="viewAccountsBtn"
              data-container="viewAccountsContainer">
              <i class="bi bi-eye-fill"></i> View Accounts
            </button>
            <button class="btn btn-outline-success mb-2 toggle-btn" id="notificationsBtn"
              data-container="notificationsContainer">
              <i class="bi bi-bell-fill"></i> Notifications
            </button>
            <a href="#signoutmodal" class="btn btn-outline-danger mb-2 mt-auto" id="signoutBtn" data-bs-toggle="modal">
              <i class="bi bi-box-arrow-right"></i> Sign Out
            </a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container p-5">
      <div id="programListContainer" class="d-none toggle-visibility">
        <?php include 'programlist.php'; ?>
      </div>
      <div id="facultyRegistrationContainer" class="d-none toggle-visibility">
        <?php include 'facultyregis.php'; ?>
      </div>
      <div id="viewAccountsContainer" class="d-none toggle-visibility">
        <?php include 'viewaccounts.php'; ?>
      </div>
      <div id="notificationsContainer" class="d-none toggle-visibility">
        <?php include 'notifications.php'; ?>
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

  <script>
    const displayToastr = (type, message) => {
      toastr[type](message);
    };

    document.addEventListener("DOMContentLoaded", function () {
      var programListContainer = document.getElementById("programListContainer");
      var facultyRegistrationContainer = document.getElementById(
        "facultyRegistrationContainer"
      );
      var viewAccountsContainer = document.getElementById("viewAccountsContainer");
      var notificationsContainer = document.getElementById(
        "notificationsContainer"
      );

      // Get the button elements
      var addProgramsBtn = document.getElementById("addProgramsBtn");
      var addFacultyBtn = document.getElementById("addFacultyBtn");
      var viewAccountsBtn = document.getElementById("viewAccountsBtn");
      var notificationsBtn = document.getElementById("notificationsBtn");

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