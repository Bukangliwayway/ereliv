<?php require_once("../backend/session_faculty.php"); ?>
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

  <script src="https://cdn.tiny.cloud/1/o7w7sdre55xscvrprwcvde6nwnv4n2in1tg6taczesi9jmh2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
</head>

<body>
  <?php
  include '../db/db.php';
  include '../db/queries.php';
  $folder_path = "../assets/randbg/";
  $files = glob($folder_path . "*");
  $img_src = $files[array_rand($files)];

  // For Setting Display Attr
  $uploadresearchContainer = $_GET['uploadresearchContainer'] ?? 'none';
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
            <button class="btn btn-outline-success mb-2" id="uploadresearchBtn"><i class="bi bi-plus-lg"></i>
              Research</button>
            <button class="btn btn-outline-success mb-2" id="notificationsBtn"><i class="bi bi-bell-fill"></i>
              Notifications</button>
            <button class="btn btn-outline-success mb-2" id="searchresearchBtn"><i class="bi bi-search"></i> Search
              Research</button>
            <a href="#addauthormodal" class="btn btn-outline-primary mb-2 push-bottom " data-bs-toggle="modal"><i
                class="bi bi-plus-lg"></i> Author</a>
            <a href="#signoutmodal" class="btn btn-outline-danger mb-2" id="signoutBtn" data-bs-toggle="modal"><i
                class="bi bi-box-arrow-right"></i> Sign Out</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="col-md-12 rand-bg p-5">
        <div id="uploadresearchContainer">
          <?php include 'uploadresearch.php'; ?>
        </div>
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
          <form method="POST" action="../backend/addauthor_backend.php" class="container d-flex flex-row gap-3">
            <div class="form-floating">
              <input type="text" id="firstname" name="firstname" class="form-control" placeholder="firstname"
                required />
              <label for="firstname" class="form-label">First Name</label>
            </div>
            <div class="form-floating">
              <input type="text" id="lastname" name="lastname" class="form-control" placeholder="lastname" required />
              <label for="lastname" class="form-label">Last Name</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var uploadresearchContainer = document.getElementById("uploadresearchContainer");
      var notificationsContainer = document.getElementById("notificationsContainer");
      var searchresearchContainer = document.getElementById("searchresearchContainer");

      // Initially hide the containers
      uploadresearchContainer.style.display = "<?php echo $uploadresearchContainer ?>";
      notificationsContainer.style.display = "<?php echo $notificationsContainer ?>";
      searchresearchContainer.style.display = "<?php echo $searchresearchContainer ?>";

      // Get the button elements
      var uploadresearchBtn = document.getElementById("uploadresearchBtn");
      var notificationsBtn = document.getElementById("notificationsBtn");
      var searchresearchBtn = document.getElementById("searchresearchBtn");

      //   // Button click event for Add Programs
      uploadresearchBtn.addEventListener("click", function () {
        // Show the program list container
        uploadresearchContainer.style.display = "block";

        // Hide the faculty registration container and view accounts container
        notificationsContainer.style.display = "none";
        searchresearchContainer.style.display = "none";

        // Add active class to the clicked button
        uploadresearchBtn.classList.add("active");
        notificationsBtn.classList.remove("active");
        searchresearchBtn.classList.remove("active");
      });

      // Button click event for Notifications 
      notificationsBtn.addEventListener("click", function () {
        // Show the view accounts container
        notificationsContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        uploadresearchContainer.style.display = "none";
        searchresearchContainer.style.display = "none";

        // Add active class to the clicked button
        notificationsBtn.classList.add("active");
        uploadresearchBtn.classList.remove("active");
        searchresearchBtn.classList.remove("active");

      });

      searchresearchBtn.addEventListener("click", function () {
        // Show the view accounts container
        searchresearchContainer.style.display = "block";

        // Hide the program list container and faculty registration container
        uploadresearchContainer.style.display = "none";
        notificationsContainer.style.display = "none";

        // Add active class to the clicked button
        searchresearchBtn.classList.add("active");
        notificationsBtn.classList.remove("active");
        uploadresearchBtn.classList.remove("active");

      });
    });
  </script>

  <script>
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
    var dataInputAuthors = document.getElementById('authors');
    $("#author-select").on("change", function () {
      selectedOptionsAuthors = $(this).val();
      dataInputAuthors.value = JSON.stringify(selectedOptionsAuthors);
    });
    var selectedOptionsPrograms = [];
    var dataInputPrograms = document.getElementById('programs');
    $("#program-select").on("change", function () {
      selectedOptionsPrograms = $(this).val();
      dataInputPrograms.value = JSON.stringify(selectedOptionsPrograms);
    });

  </script>
</body>

</html>