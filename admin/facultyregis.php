<?php
require_once("../backend/session_admin.php");
?>

<div class="container m-0 mx-auto d-flex flex-column justify-content-center align-items-center">
  <div
    class="col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 mx-auto p-5 border border-smoke">
    <form id="facultyForm" class="d-flex flex-column gap-1 px-3">
      <h1 class="fs-2 fw-bold text-uppercase">
        PUPQC ADD FACULTY FORM
      </h1>
      <div class="form-floating mb-3">
        <input type="text" id="first_name" name="firstname" class="form-control" placeholder="first_name" required />
        <label for="first_name" class="form-label">First Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" id="last_name" name="lastname" class="form-control" placeholder="last_name" required />
        <label for="last_name" class="form-label">Last Name</label>
      </div>
      <div class="form-floating mb-3">
        <input type="email" id="email" name="emailadd" class="form-control" placeholder="email" required />
        <label for="email" class="form-label">Email</label>
      </div>
      <div class="form-group mt-2 mb-3">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="category" id="supervisorcat" value="Advisor" checked>
          <label class="form-check-label" for="supervisorcat">Advisor</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="category" id="facultycat" value="Supervisor">
          <label class="form-check-label" for="facultycat">Supervisor</label>
        </div>
      </div>
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
      <button type="submit" id="addFacultyBtn" class="btn btn-dark">Add Faculty</button>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#facultyForm').submit(function (event) {
      event.preventDefault(); // Prevent the default form submission

      //Loading Routine
      $('#loadingSpinner').removeClass('d-none');
      $('#loadingSpinner').addClass('d-flex');
      $('#facultyForm').css({ 'pointer-events': 'none' });

      var formData = $(this).serialize();

      $.ajax({
        type: 'POST',
        url: '../backend/facultyregis_backend.php',
        data: formData,
        success: function (response) {
          var data = JSON.parse(response);

          // Display a Toastr success message
          displayToastr(data.status, data.message);

          // Reset the form after successful submission
          $("#facultyForm")[0].reset();
        },
        error: function (xhr, status, error) {
          // Handle error response here
          console.log(xhr.responseText);
          toastr.error('An error occurred. Please try again.');
        },
        complete: function () {
          // Revert Loading Routine back to normal
          $('#loadingSpinner').removeClass('d-flex');
          $('#loadingSpinner').addClass('d-none');
          $('#facultyForm').css('pointer-events', 'auto');

        }
      });
    });
  });
</script>