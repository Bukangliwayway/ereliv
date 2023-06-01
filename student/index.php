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
  $notificationsContainer = $_GET['notificationsContainer'] ?? 'none';
  $searchresearchContainer = $_GET['searchresearchContainer'] ?? 'none';

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
            <button class="btn btn-outline-success mb-2" id="notificationsBtn"><i class="bi bi-bell-fill"></i>
              Notifications</button>
            <button class="btn btn-outline-success mb-2" id="searchresearchBtn"><i class="bi bi-search"></i> Search
              Research</button>
            <a href="#signoutmodal" class="btn btn-outline-danger mb-2 push-bottom" id="signoutBtn"
              data-bs-toggle="modal"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="col-md-12 rand-bg p-5">
        <div id="notificationsContainer">
          <?php include 'notifications.php'; ?>
        </div>
        <div id="searchresearchContainer">
          <?php include 'searchresearch.php'; ?>
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
      var notificationsContainer = document.getElementById("notificationsContainer");
      var searchresearchContainer = document.getElementById("searchresearchContainer");

      // Initially hide the containers
      notificationsContainer.style.display = "<?php echo $notificationsContainer ?>";
      searchresearchContainer.style.display = "<?php echo $searchresearchContainer ?>";

      // Get the button elements
      var notificationsBtn = document.getElementById("notificationsBtn");
      var searchresearchBtn = document.getElementById("searchresearchBtn");

      // Button click event for Notifications 
      notificationsBtn.addEventListener("click", function () {
        // Show the view accounts container
        notificationsContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        searchresearchContainer.style.display = "none";

        // Add active class to the clicked button
        notificationsBtn.classList.add("active");
        searchresearchBtn.classList.remove("active");

      });

      searchresearchBtn.addEventListener("click", function () {
        // Show the view accounts container
        searchresearchContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        notificationsContainer.style.display = "none";

        // Add active class to the clicked button
        searchresearchBtn.classList.add("active");
        notificationsBtn.classList.remove("active");

      });
    });
  </script>
</body>

</html>