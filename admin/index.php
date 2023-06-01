<?php require_once("../backend/session_admin.php"); ?>


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
  <link rel="stylesheet" href="main.css" />
</head>

<body>
  <?php
  include '../db/db.php';
  include '../db/queries.php';
  $folder_path = "../assets/randbg/";
  $files = glob($folder_path . "*");
  $img_src = $files[array_rand($files)];

  // For Setting Display Attr
  $programListContainer = $_GET['programListContainer'] ?? 'none';
  $facultyRegistrationContainer = $_GET['facultyRegistrationContainer'] ?? 'none';
  $viewAccountsContainer = $_GET['viewAccountsContainer'] ?? 'none';
  $notificationsContainer = $_GET['noti$notificationsContainer'] ?? 'none';
  ?>

  <div class=" d-flex flex-row">
    <nav class="col-3 navbar navbar-expand-lg navbar-dark bg-dark flex-column min-vh-100">
      <div class="d-flex flex-column align-items-stretch p-3">
        <a class="navbar-brand mx-auto my-3 text-center"
          href="http://localhost/ereliv/faculty/?searchresearchContainer=block">
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
            <button class="btn btn-outline-success mb-2" id="addFacultyBtn"><i class="bi bi-plus-lg"></i> Faculty</button>
            <button class="btn btn-outline-success mb-2" id="addProgramsBtn"><i class="bi bi-plus-lg"></i> Programs and
              Sections
            </button>
            <button class="btn btn-outline-success mb-2" id="viewAccountsBtn"><i class="bi bi-eye-fill"></i> View Accounts
            </button>
            <button class="btn btn-outline-success mb-2" id="notificationsBtn"><i class="bi bi-bell-fill"></i> Notifications
            </button>
            <a href="#signoutmodal" class="btn btn-outline-danger mb-2 mt-auto" id="signoutBtn" data-bs-toggle="modal">
              <i class="bi bi-box-arrow-right"></i> Sign Out
            </a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="col-md-12 rand-bg p-5">
        <div id="programListContainer">
          <?php include 'programlist.php'; ?>
        </div>
        <div id="facultyRegistrationContainer">
          <?php include 'facultyregis.php'; ?>
        </div>
        <div id="viewAccountsContainer">
          <?php include 'viewaccounts.php'; ?>
        </div>
        <div id="notificationsContainer">
          <?php include 'notifications.php'; ?>
        </div>

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
            <button type="submit" class="btn btn-danger">Yes</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">No</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var programListContainer = document.getElementById("programListContainer");
      var facultyRegistrationContainer = document.getElementById("facultyRegistrationContainer");
      var viewAccountsContainer = document.getElementById("viewAccountsContainer");
      var notificationsContainer = document.getElementById("notificationsContainer");

      // Initially hide the containers
      programListContainer.style.display = "<?php echo $programListContainer ?>";
      facultyRegistrationContainer.style.display = "<?php echo $facultyRegistrationContainer ?>";
      viewAccountsContainer.style.display = "<?php echo $viewAccountsContainer ?>";
      notificationsContainer.style.display = "<?php echo $notificationsContainer ?>";

      // Get the button elements
      var addProgramsBtn = document.getElementById("addProgramsBtn");
      var addFacultyBtn = document.getElementById("addFacultyBtn");
      var viewAccountsBtn = document.getElementById("viewAccountsBtn");
      var notificationsBtn = document.getElementById("notificationsBtn");

      //   // Button click event for Add Programs
      addProgramsBtn.addEventListener("click", function () {
        // Show the program list container
        programListContainer.style.display = "block";

        // Hide the faculty registration container and view accounts container
        facultyRegistrationContainer.style.display = "none";
        viewAccountsContainer.style.display = "none";
        notificationsContainer.style.display = "none";

        // Add active class to the clicked button
        addProgramsBtn.classList.add("active");
        addFacultyBtn.classList.remove("active");
        viewAccountsBtn.classList.remove("active");
        notificationsContainer.classList.remove("active");
      });

      // Button click event for Add Faculty
      addFacultyBtn.addEventListener("click", function () {
        // Show the faculty registration container
        facultyRegistrationContainer.style.display = "block";

        // Hide the program list container and view accounts container
        programListContainer.style.display = "none";
        viewAccountsContainer.style.display = "none";
        notificationsContainer.style.display = "none";

        // Add active class to the clicked button
        addFacultyBtn.classList.add("active");
        addProgramsBtn.classList.remove("active");
        viewAccountsBtn.classList.remove("active");
        notificationsBtn.classList.remove("active");
      });

      // Button click event for View Accounts
      viewAccountsBtn.addEventListener("click", function () {
        // Show the view accounts container
        viewAccountsContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        programListContainer.style.display = "none";
        facultyRegistrationContainer.style.display = "none";
        notificationsContainer.style.display = "none";

        // Add active class to the clicked button
        viewAccountsBtn.classList.add("active");
        addProgramsBtn.classList.remove("active");
        addFacultyBtn.classList.remove("active");
        notificationsBtn.classList.remove("active");
      });

      // Button click event for Notifications 
      notificationsBtn.addEventListener("click", function () {
        // Show the view accounts container
        notificationsContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        programListContainer.style.display = "none";
        facultyRegistrationContainer.style.display = "none";
        viewAccountsContainer.style.display = "none";

        // Add active class to the clicked button
        notificationsBtn.classList.add("active");
        viewAccountsBtn.classList.remove("active");
        addProgramsBtn.classList.remove("active");
        addFacultyBtn.classList.remove("active");
      });
    });
  </script>

</body>

</html>