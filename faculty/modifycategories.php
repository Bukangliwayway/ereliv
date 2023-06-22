<?php require_once("../backend/session_faculty.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center ">
  <div class="d-flex flex-row gap-3 sticky-top p-5 bg-light">
    <button id="author-cat" class="btn btn-primary d-flex align-items-center gap-2">
      <i class="bi bi-people-fill"></i> Authors
    </button>
    <button id="interest-cat" class="btn btn-primary d-flex align-items-center gap-2">
      <i class="bi bi-tag-fill"></i> Interests
    </button>
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="search" name="search" class="form-control form-control-sm align-middle"
        placeholder="Search" required style="padding: 1.17rem 0.75rem;">
    </div>

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
            <input type="text" id="name" name="name" class="form-control" required />
            <label for="name" class="form-label">Interest Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Edit Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="editInterestName" name="name" class="form-control" required />
            <label for="name" class="form-label">Interest Name</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="editInterestID" type="hidden" name="interestID">
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteinterestmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Delete Interest
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deleteInterestForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="deleteInterestName" name="name" class="form-control bg-white" readonly />
            <label for="name" class="form-label">To Be Deleted</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="deleteInterestID" type="hidden" name="interestID">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Edit Author
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editAuthorForm" class="container d-flex flex-column gap-3">
          <div class="d-flex gap-3">
            <div class="form-floating">
              <input type="text" id="editAuthorFirstName" name="firstname" class="form-control" required />
              <label for="firstname" class="form-label">First Name</label>
            </div>
            <div class="form-floating">
              <input type="text" id="editAuthorLastName" name="lastname" class="form-control" required />
              <label for="lastname" class="form-label">Last Name</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Edit</button>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="editAuthorID" type="hidden" name="authorID">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteauthormodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Delete Author
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deleteAuthorForm" class="container d-flex flex-row gap-3">
          <div class="d-flex gap-3">
            <div class="form-floating">
              <input type="text" id="deleteAuthorFirstName" name="firstname" class="form-control bg-white" readonly />
              <label for="section" class="form-label">First Name:</label>
            </div>
            <div class="form-floating">
              <input type="text" id="deleteAuthorLastName" name="lastname" class="form-control bg-white" readonly />
              <label for="section" class="form-label">Last Name:</label>
            </div>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <input id="deleteAuthorID" type="hidden" name="authorID">
          <button type="submit" class="btn btn-danger">Delete</button>
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

    function attachEventListeners() {
      const editinterestButtons = document.querySelectorAll('.editinterestbutton');
      editinterestButtons.forEach(button => {
        button.addEventListener('click', function () {
          const interestID = this.getAttribute('data-interestID');
          const name = this.getAttribute('data-name');
          document.querySelector('#editInterestName').value = name;
          document.querySelector('#editInterestID').value = interestID;
        });
      });

      const deleteinterestButtons = document.querySelectorAll('.deleteinterestbutton');
      deleteinterestButtons.forEach(button => {
        button.addEventListener('click', function () {
          const interestID = this.getAttribute('data-interestID');
          const name = this.getAttribute('data-name');
          document.querySelector('#deleteInterestName').value = name;
          document.querySelector('#deleteInterestID').value = interestID;
        });
      });

      const editauthorButtons = document.querySelectorAll('.editauthorbutton');
      editauthorButtons.forEach(button => {
        button.addEventListener('click', function () {
          const authorID = this.getAttribute('data-authorID');
          const firstname = this.getAttribute('data-firstname');
          const lastname = this.getAttribute('data-lastname');
          document.querySelector('#editAuthorLastName').value = lastname;
          document.querySelector('#editAuthorFirstName').value = firstname;
          document.querySelector('#editAuthorID').value = authorID;
        });
      });

      const deleteauthorButtons = document.querySelectorAll('.deleteauthorbutton');
      deleteauthorButtons.forEach(button => {
        button.addEventListener('click', function () {
          const authorID = this.getAttribute('data-authorID');
          const firstname = this.getAttribute('data-firstname');
          const lastname = this.getAttribute('data-lastname');
          document.querySelector('#deleteAuthorLastName').value = lastname;
          document.querySelector('#deleteAuthorFirstName').value = firstname;
          document.querySelector('#deleteAuthorID').value = authorID;
        });
      });
    }

    // Start with Authors
    loadCategories('Author');
    $('#author-cat').addClass('active');

    $(document).on('click', '#interest-cat', function (e) {
      e.preventDefault();
      // Remove active class from all buttons
      $('#interest-cat, #author-cat').removeClass('active');
      // Add active class to clicked button
      $(this).addClass('active');
      // Load Interests
      loadCategories('Interest');
    });

    $(document).on('click', '#author-cat', function (e) {
      e.preventDefault();
      // Remove active class from all buttons
      $('#interest-cat, #author-cat').removeClass('active');
      // Add active class to clicked button
      $(this).addClass('active');
      // Load Authors
      loadCategories('Author');
    });

    $(document).on('input', '#search', function (e) {
      // Get the search query
      const query = $(this).val();
      console.log(getActiveCategory());
      e.preventDefault();
      loadCategoriesSearch(getActiveCategory(), query);
    });

    function getActiveCategory() {
      var activeButton = $('#author-cat, #interest-cat').filter('.active');

      if (activeButton.attr('id') === 'author-cat') {
        return 'Author';
      } else if (activeButton.attr('id') === 'interest-cat') {
        return 'Interest';
      } else {
        // Handle the case when no button is active
        return null;
      }
    }

    async function loadCategoriesSearch(table, search) {
      try {
        // Fetch the CSRF token from the server
        const response = await fetch('../backend/getcsrftoken.php');
        if (response.ok) {
          const csrfToken = await response.text();

          // Prepare the request data
          const requestData = {
            table: table,
            search: search,
            csrf_token: csrfToken
          };

          // Make the request to load faculty accounts
          const ajaxRequest = $.ajax({
            url: '../backend/updatecategoriessearch.php',
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


    $('#addAuthorForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/addauthor_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#addAuthorForm').css({ 'pointer-events': 'none' });
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addAuthorForm').css('pointer-events', 'auto');

          displayToastr(data.status, data.message);
          $('#addAuthorForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addAuthorForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#addAuthorForm').css('pointer-events', 'auto');

          //Reload the Author List
          loadCategories('Author');
        }
      });
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
          //Reload the Author List
          loadCategories('Author');

        }
      });
    });

    $('#editInterestForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/editinterest_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#editInterestForm').css('pointer-events', 'auto');
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editInterestForm').css('pointer-events', 'auto');

          // Close the active modal section
          $('#editinterestmodal').modal('hide');

          displayToastr(data.status, data.message);
          $('#editInterestForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editInterestForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editInterestForm').css('pointer-events', 'auto');
          //Reload the Interest List
          loadCategories('Interest');

        }
      });
    });

    $('#deleteInterestForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/deleteinterest_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#deleteInterestForm').css('pointer-events', 'auto');
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteInterestForm').css('pointer-events', 'auto');

          // Close the active modal section
          $('#deleteinterestmodal').modal('hide');

          displayToastr(data.status, data.message);
          $('#deleteInterestForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteInterestForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteInterestForm').css('pointer-events', 'auto');
          //Reload the Interest List
          loadCategories('Interest');

        }
      });
    });

    $('#editAuthorForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/editauthor_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#editAuthorForm').css('pointer-events', 'auto');
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editAuthorForm').css('pointer-events', 'auto');

          // Close the active modal section
          $('#editauthormodal').modal('hide');

          displayToastr(data.status, data.message);
          $('#editAuthorForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editAuthorForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#editAuthorForm').css('pointer-events', 'auto');
          //Reload the Author List
          loadCategories('Author');

        }
      });
    });

    $('#deleteAuthorForm').submit(function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Serialize form data
      var formData = $(this).serialize();

      $.ajax({
        url: '../backend/deleteauthor_backend.php',
        method: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function () {
          // Show loading animation or do any pre-request tasks
          $('#loadingSpinner').removeClass('d-none');
          $('#loadingSpinner').addClass('d-flex');
          $('#deleteAuthorForm').css('pointer-events', 'auto');
        },
        success: function (data) {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteAuthorForm').css('pointer-events', 'auto');

          // Close the active modal section
          $('#deleteauthormodal').modal('hide');

          displayToastr(data.status, data.message);
          $('#deleteAuthorForm')[0].reset();
        },
        error: function () {
          // Hide loading animation
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteAuthorForm').css('pointer-events', 'auto');

          // Handle error response here
          displayToastr('error', 'An error occurred. Please try again.');
        },
        complete: function () {
          // Hide loading animation or do any post-request tasks
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#deleteAuthorForm').css('pointer-events', 'auto');
          //Reload the Author List
          loadCategories('Author');
        }
      });
    });
  });
</script>