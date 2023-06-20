<?php require_once("../backend/session_admin.php"); ?>


<div class="row col-8 m-auto gap-3">
  <div class="table-responsive overflow-auto" style="max-height:50vh" id="studentList">
    <h3 class="text-center">Student Accounts</h3>
    <!-- Table will be dynamically loaded here -->
  </div>
  <div class="table-responsive overflow-auto" style="max-height:50vh" id="facultyList">
    <!-- Table will be dynamically loaded here -->
  </div>
</div>

<!-- Modals -->
<div class="modal fade" id="activatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="activatemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Activate Account
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="activateModalForm" class="container d-flex flex-row gap-3">
          <input type="hidden" name="string" id="activateAccountID">
          <input type="hidden" name="status" value="Active">
          <input type="hidden" name="user" id="activateUserType">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">No</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deactivatemodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="activatemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Deactivate Account
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deactivateModalForm" class="container d-flex flex-row gap-3">
          <input type="hidden" name="string" id="deactivateAccountID">
          <input type="hidden" name="status" value="Inactive">
          <input type="hidden" name="user" id="deactivateUserType">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Yes</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">No</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

  $(document).ready(function () {
    // Function to load faculty accounts
    async function loadFacultyAccounts(column, order) {
      try {
        // Fetch the CSRF token from the server
        const response = await fetch('../backend/getcsrftoken.php');
        if (response.ok) {
          const csrfToken = await response.text();

          // Prepare the request data
          const requestData = {
            column_name: column,
            order: order,
            csrf_token: csrfToken
          };

          // Make the request to load faculty accounts
          const ajaxRequest = $.ajax({
            url: '../backend/updatefacultyaccounts.php',
            type: 'POST',
            data: requestData,
          });

          ajaxRequest.done(function (response) {
            // Update the table content
            $('#facultyList').html(response);
            $('.sortFaculty').find('.bi').remove(); // Remove arrows from other columns
            $('[data-faculty="' + column + '"]').append(getArrowHtml(order));
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

    // Function to load student accounts
    async function loadStudentAccounts(column, order) {
      try {
        // Fetch the CSRF token from the server
        const response = await fetch('../backend/getcsrftoken.php');
        if (response.ok) {
          const csrfToken = await response.text();

          // Prepare the request data
          const requestData = {
            column_name: column,
            order: order,
            csrf_token: csrfToken
          };

          // Make the request to load student accounts
          const ajaxRequest = $.ajax({
            url: '../backend/updatestudentaccounts.php',
            type: 'POST',
            data: requestData,
          });

          ajaxRequest.done(function (response) {
            // Update the table content
            $('#studentList').html(response);
            $('.sortStudent').find('.bi').remove(); // Remove arrows from other columns
            $('[data-student="' + column + '"]').append(getArrowHtml(order));
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
      // Function to handle activate button click
      const activateButton = document.querySelectorAll('.activatebutton');
      activateButton.forEach(button => {
        button.addEventListener('click', function () {
          const accountID = button.getAttribute('data-string');
          const user = button.getAttribute('data-user');
          document.querySelector('#activateAccountID').value = accountID;
          document.querySelector('#activateUserType').value = user;

          // Show the activate modal
          $('#activatemodal').modal('show');
        });
      });

      // Function to handle deactivate button click
      const deactivateButton = document.querySelectorAll('.deactivatebutton');
      deactivateButton.forEach(button => {
        button.addEventListener('click', function () {
          const accountID = button.getAttribute('data-string');
          const user = button.getAttribute('data-user');
          document.querySelector('#deactivateAccountID').value = accountID;
          document.querySelector('#deactivateUserType').value = user;

          // Show the deactivate modal
          $('#deactivatemodal').modal('show');
        });
      });
    }
    const activateModalForm = document.getElementById('activateModalForm');
    activateModalForm.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      // Perform loading routine before form submission
      $('#loadingSpinner').removeClass('d-flex');
      $('#loadingSpinner').addClass('d-none');
      $(activateModalForm).css('pointer-events', 'none');;

      const formData = new FormData(activateModalForm);

      fetch('../backend/updatestatus_backend.php', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          // Display a Toastr notification
          displayToastr(data.status, data.message);

          if (data.status === 'success') {
            // Reset the form after successful activation
            activateModalForm.reset();

            // Close the activate modal
            $('#activatemodal').modal('hide');
          }
        })
        .catch(error => {
          // Handle error response here
          console.log(error);
          displayToastr('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
          // Revert loading routine back to normal
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $(activateModalForm).css('pointer-events', 'auto');
          loadStudentAccounts('priority', 'asc');
          loadFacultyAccounts('priority', 'asc');
        });
    });

    const deactivateModalForm = document.getElementById('deactivateModalForm');
    deactivateModalForm.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent form from submitting normally

      $('#deactivatemodal').modal('hide');

      // Perform loading routine before form submission
      $('#loadingSpinner').removeClass('d-flex');
      $('#loadingSpinner').addClass('d-none');
      $(deactivateModalForm).css('pointer-events', 'none');

      const formData = new FormData(deactivateModalForm);

      fetch('../backend/updatestatus_backend.php', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          // Display a Toastr notification
          displayToastr(data.status, data.message);

          if (data.status === 'success') {
            // Reset the form after successful deactivation
            deactivateModalForm.reset();

            // Close the deactivate modal
            $('#deactivatemodal').modal('hide');
          }
        })
        .catch(error => {
          // Handle error response here
          console.log(error);
          displayToastr('error', 'An error occurred. Please try again.');
        })
        .finally(() => {
          // Revert loading routine back to normal
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $(deactivateModalForm).css('pointer-events', 'auto');

          loadStudentAccounts('priority', 'asc');
          loadFacultyAccounts('priority', 'asc');
        });
    });

    // Sort student accounts on column click
    $(document).on('click', '.sortStudent', function (e) {
      e.preventDefault();
      var column = $(this).data('student');
      var order = $(this).data('order');

      loadStudentAccounts(column, order);
    });

    // Sort faculty accounts on column click
    $(document).on('click', '.sortFaculty', function (e) {
      e.preventDefault();
      var column = $(this).data('faculty');
      var order = $(this).data('order');

      loadFacultyAccounts(column, order);
    });

    // Initial load of student accounts on page load
    loadFacultyAccounts('facultyID', 'desc');
    // Initial load of faculty accounts on page load
    loadStudentAccounts('studentID', 'desc');

    function getArrowHtml(order) {
      if (order === 'desc') {
        return '&nbsp;<span class="bi bi-arrow-down"></span>';
      } else {
        return '&nbsp;<span class="bi bi-arrow-up"></span>';
      }
    }
    function showLoadingAnimation(formElement) {
      // Perform loading routine before form submission
      $('#loadingSpinner').removeClass('d-flex');
      $('#loadingSpinner').addClass('d-none');
      $(formElement).css('pointer-events', 'none');
    }

    function hideLoadingAnimation(formElement) {
      // Revert loading routine back to normal
      $('#loadingSpinner').removeClass('d-flex');
      $('#loadingSpinner').addClass('d-none');
      $(formElement).css('pointer-events', 'auto');
    }
  });
</script>