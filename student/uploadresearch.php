<?php require_once("../backend/session_student.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center ">
  <div
    class="col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 mx-auto border border-smoke mt-1">
    <h1 class="fs-2 fw-bold text-uppercase">
      upload research
    </h1>
    <form id="uploadResearchForm" class="d-flex flex-column gap-1 px-3">
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
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <button type="submit" class="btn btn-primary">Upload Research</button>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $('#uploadResearchForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      // Perform AJAX request
      $.ajax({
        url: '../backend/uploadresearch_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          // showLoadingAnimation();
        },
        success: function (response) {
          // Handle the response and display Toastr notification
          displayToastr(response.status, response.message);

          if (response.status === 'success') {
            // Reset the form after successful upload
            $('#uploadResearchForm')[0].reset();
          }
        },
        error: function () {
          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          // hideLoadingAnimation();
        }
      });
    });

  });

</script>