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
  <div class="p-5">

    <div class="d-flex flex-column">

      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchResearches" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search author works" required style="padding: 1.17rem 0.75rem;">
      </div>
      <div class="p-3">
        <span class="text-muted">Search results for:</span>
        <h4 class="m-3 mr-0">Author</h4>
      </div>
    </div>

  </div>
</body>

</html>