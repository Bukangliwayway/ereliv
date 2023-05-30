<?php require_once("../backend/session_check.php"); ?>


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
  <link rel="stylesheet" href="../styles/main.css" />
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
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark p-5" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-5" href="#">Admin Page</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
        <div class="d-flex gap-3">
          <button class="btn btn-outline-success" id="addFacultyBtn"><i class="bi bi-plus-lg"></i> Faculty</button>
          <button class="btn btn-outline-success" id="addProgramsBtn"><i class="bi bi-plus-lg"></i> Programs and
            Sections
          </button>
          <button class="btn btn-outline-success" id="viewAccountsBtn"><i class="bi bi-eye-fill"></i> View Accounts
          </button>
          <button class="btn btn-outline-success" id="notificationsBtn"><i class="bi bi-bell-fill"></i> Notifications
          </button>

        </div>
      </div>
    </div>
  </nav>
  <div class="row m-0">
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