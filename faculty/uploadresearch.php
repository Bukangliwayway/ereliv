<?php
require_once("../backend/session_faculty.php");
include '../db/db.php';
include '../db/queries.php';
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

  <script src="https://cdn.tiny.cloud/1/o7w7sdre55xscvrprwcvde6nwnv4n2in1tg6taczesi9jmh2/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <link rel="stylesheet" href="../styles/main.css" />

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

</head>

<body class="vh-100">
  <div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center ">
    <div
      class="col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 mx-auto p-5 border border-smoke mt-5">
      <h1 class="fs-2 fw-bold text-uppercase">
        upload research
      </h1>
      <form method="POST" action="../backend/uploadresearch_backend.php" class="d-flex flex-column gap-1 px-3">
        <div class="form-floating mb-3">
          <input type="text" id="title" name="title" class="form-control" placeholder="title" required />
          <label for="title" class="form-label">Research Title</label>
        </div>

        <div class="example author-select">
          <script type="text/javascript">
            require(["bootstrap-multiselect"], function (purchase) {
              $("#author-select").multiselect({
                includeSelectAllOption: true,
                buttonWidth: 250,
                enableFiltering: true,
              });
            });
          </script>
          <select id="author-select" multiple="multiple">
            <?php
            $author = getList($conn, '*', 'Author');
            foreach ($author as $authorData) {
              $fullName = ucfirst($authorData['lastname']) . ", " . ucfirst($authorData['firstname']);
              echo '<option value="' . $authorData['authorID'] . '">' . $fullName . '</option>';
            }
            ;
            ?>
          </select>
        </div>

        <div class="example program-select">
          <script type="text/javascript">
            require(["bootstrap-multiselect"], function (purchase) {
              $("#program-select").multiselect({
                includeSelectAllOption: true,
                buttonWidth: 250,
                enableFiltering: true,
              });
            });
          </script>
          <select id="program-select" multiple="multiple">
            <?php
            $program = getList($conn, '*', 'Program');
            foreach ($program as $programData) {
              echo '<option value="' . $programData['programID'] . '">' . strtoupper($programData['name']) . '</option>';
            }
            ;
            ?>
          </select>
        </div>

        <div class="form-floating mb-3">
          <textarea id="content-input" name="content-input" placeholder="Research Content"></textarea>
        </div>
        <div class="form-floating mb-3">
          <input type="keywords" id="keywords" name="keywords" class="form-control" placeholder="keywords" required />
          <label for="keywords" class="form-label">Keywords (Separate Each by Commas)</label>
        </div>
        <input type="hidden" name="content" id="content">
        <input type="hidden" name="authors" id="authors">
        <input type="hidden" name="programs" id="programs">

        <button type="submit" class="btn btn-primary">Upload Research</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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