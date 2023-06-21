<?php require_once("../backend/session_faculty.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center ">
  <div class="d-flex flex-row gap-3">
    <button class="btn btn-outline-success author-cat d-flex align-items-center gap-2">
      <i class="bi bi-people-fill"></i> Authors
    </button>
    <button class="btn btn-outline-success interest-cat d-flex align-items-center gap-2">
      <i class="bi bi-tag-fill"></i> Interests
    </button>
    <form id="searchForm" class="d-flex align-items-center justify-content-center ml-auto">
      <div class="d-flex justify-content-center gap-1">
        <input type="text" id="search" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
        <button class="btn btn-primary btn-sm" type="submit">
          <i class="bi bi-search" style="padding: 0rem 0.75rem;"></i>
        </button>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    </form>
  </div>
  <div id="categorylist"></div>

  <div id="fixed-addcat" class="position-fixed bottom-0 start-0 d-flex justify-content-end gap-2 p-3">
    <a href="#addauthormodal" class="btn btn-primary" data-bs-toggle="modal">
      <i class="bi bi-plus-lg"></i>
      Author
    </a>
    <a href="#addinterestmodal" class="btn btn-danger" data-bs-toggle="modal">
      <i class="bi bi-plus-lg"></i>
      Interest
    </a>
  </div>

</div>

<!-- modal -->
<div class="modal fade" id="addinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Add Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="addInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="name" name="name" class="form-control" placeholder="Interest Name" required />
            <label for="name" class="form-label">Interest Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    async function loadCategories(table) {
      try {
        // Fetch the CSRF token from the server
        const response = await fetch('../backend/getcsrftoken.php');
        if (response.ok) {
          const csrfToken = await response.text();

          // Prepare the request data
          const requestData = {
            table: table,
            csrf_token: csrfToken
          };

          // Make the request to load faculty accounts
          const ajaxRequest = $.ajax({
            url: '../backend/updatecategories.php',
            type: 'POST',
            data: requestData,
          });

          ajaxRequest.done(function (response) {
            // Update the table content
            $('#categorylist').html(response);
            attachEventListeners();
          });

          ajaxRequest.fail(function (xhr, status, error) {
            console.log(error);
          });
        } else {
          // Unable to fetch CSRF token, handle the error
          console.error('Error fetching CSRF token:', response.status);
          displayToastr('error', 'An error occurred. Please try again.');
        }
      } catch (error) {
        // General error occurred, handle it
        console.error('Error:', error);
        displayToastr('error', 'An error occurred. Please try again.');
      }
    }

    // Start with Authors
    loadCategories('Author');

    // Sort student accounts on column click
    $(document).on('click', '.interest-cat', function (e) {
      e.preventDefault();
      // var column = $(this).data('student');
      // var order = $(this).data('order');

      loadCategories('Interest');
    });

    $(document).on('click', '.author-cat', function (e) {
      e.preventDefault();
      // var column = $(this).data('student');
      // var order = $(this).data('order');
      loadCategories('Author');
    });

    $('#addInterestForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/addinterest_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#addInterestForm').css({ 'pointer-events': 'none' });
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addInterestForm').css('pointer-events', 'auto');

          displayToastr(data.status, data.message);
          $('#addInterestForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addInterestForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addInterestForm').css('pointer-events', 'auto');
        }
      });
    });
  });
</script>