<?php require_once("../backend/session_admin.php"); ?>

<div class="container d-flex flex-column gap-3 text-center justify-content-center">
  <h1 class="text-center m-auto text-uppercase my-3 border border-light p-3 rounded">Programs and Sections</h1>
  <div id="programList"></div>
</div>

<!-- Modals -->
<div class="modal fade" id="addsectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addsectionmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          Add Section
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="addSectionForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="section" name="section" class="form-control" placeholder="section" required />
            <label for="section" class="form-label">Section</label>
          </div>
          <input type="hidden" name="string" id="getprogramid_target">
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editsectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="editsectionmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          Edit Section
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editSectionForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="original_target" name="original" class="form-control" readonly />
            <label for="section" class="form-label">Previous Name: </label>
          </div>
          <div class="form-floating">
            <input type="text" id="section" name="section" class="form-control" placeholder="section" required />
            <label for="section" class="form-label">Section</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deletesectionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="deletesectionmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          Delete Section
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <h5 class="text-capitalize text-center"> You Sure You want to Delete this Section? </h5>
        <form id="deleteSectionForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="hidden" id="delete_target" name="sectionID" />
            <input type="text" id="delete_target_name" name="section" class="form-control" readonly />
            <label for="section" class="form-label">To Be Deleted</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="addprogrammodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          Add Program
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="addProgramForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" name="program" class="form-control" placeholder="program" required />
            <label for="program" class="form-label">Program Name: </label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="editprogrammodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          Edit Program
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="editProgramForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="original_program_target" name="original" class="form-control" readonly />
            <label for="program" class="form-label">Previous Name: </label>
          </div>
          <div class="form-floating">
            <input type="text" id="program" name="program" class="form-control" placeholder="program" required />
            <label for="program" class="form-label">Program</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteprogrammodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="deleteprogrammodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize">
          delete Program
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body">
        <form id="deleteProgramForm" class="container d-flex flex-row gap-3">
          <div class="form-floating">
            <input type="text" id="delete_program_target" name="program" class="form-control" readonly />
            <label for="section" class="form-label">To Be Deleted</label>
          </div>
          <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
          <button type="submit" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  updateProgramList();

  async function updateProgramList() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch('../backend/getcsrftoken.php');
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const formData = new FormData();
        formData.append('csrf_token', csrfToken);

        // Make the request to update the program list
        const updateResponse = await fetch('../backend/updateprogramlist.php', {
          method: 'POST',
          body: formData,
        });

        if (updateResponse.ok) {
          // Request succeeded, do something with the response if needed
          const addSectionContainer = document.getElementById('programList');
          addSectionContainer.innerHTML = await updateResponse.text();

          // Attach event listeners to the newly added elements
          attachEventListeners();
        } else {
          // Request failed, handle the error
          console.error('Error updating program list:', updateResponse.status);
          displayToastr('error', 'An error occurred. Please try again.');
        }
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
    const addSectionButtons = document.querySelectorAll('.addsectionbutton');
    addSectionButtons.forEach(button => {
      button.addEventListener('click', function () {
        const string = button.getAttribute('data-string');
        document.querySelector('#getprogramid_target').value = string;
      });
    });

    const editSectionButtons = document.querySelectorAll('.editsectionbutton');
    editSectionButtons.forEach(button => {
      button.addEventListener('click', function () {
        const string = this.getAttribute('data-string');
        document.querySelector('#original_target').value = string;
      });
    });

    const deleteSectionButtons = document.querySelectorAll('.deletesectionbutton');
    deleteSectionButtons.forEach(button => {
      button.addEventListener('click', function () {
        const name = this.getAttribute('data-string');
        const id = this.getAttribute('data-id');
        document.querySelector('#delete_target').value = id;
        document.querySelector('#delete_target_name').value = name;
      });
    });


    const editProgramButtons = document.querySelectorAll('.editprogrambutton');
    editProgramButtons.forEach(button => {
      button.addEventListener('click', function () {
        const string = this.getAttribute('data-string');
        document.querySelector('#original_program_target').value = string;
      });
    });

    const deleteProgramButtons = document.querySelectorAll('.deleteprogrambutton');
    deleteProgramButtons.forEach(button => {
      button.addEventListener('click', function () {
        const string = this.getAttribute('data-string');
        document.querySelector('#delete_program_target').value = string;
        console.log(string);
      });
    });

  }

  const addSectionForm = document.getElementById('addSectionForm');
  addSectionForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');
    $('#addSectionForm').css('pointer-events', 'none');

    const formData = new FormData(addSectionForm);

    fetch('../backend/addsection_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);

        // Reset the form after successful submission
        addSectionForm.reset();

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#addSectionForm').css('pointer-events', 'auto');
      });
  });

  const editSectionForm = document.getElementById('editSectionForm');
  editSectionForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');
    $('#editSectionForm').css('pointer-events', 'none');

    const formData = new FormData(editSectionForm);

    fetch('../backend/editsection_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status == 'success') {

          // Reset the form after successful edit 
          editSectionForm.reset();

          // Close the active modal section
          $('#editsectionmodal').modal('hide');

        }

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#editSectionForm').css('pointer-events', 'auto');
      });
  });

  const deleteSectionForm = document.getElementById('deleteSectionForm');
  deleteSectionForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');
    $('#deleteSectionForm').css('pointer-events', 'none');

    const formData = new FormData(deleteSectionForm);

    fetch('../backend/deletesection_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === 'success') {
          // Reset the form after successful deletion 
          deleteSectionForm.reset();

          // Close the active modal section
          $('#deletesectionmodal').modal('hide');
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#deleteSectionForm').css('pointer-events', 'auto');
      });
  });

  const addProgramForm = document.getElementById('addProgramForm');
  addProgramForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');

    $('#addProgramForm').css('pointer-events', 'none');

    const formData = new FormData(addProgramForm);

    fetch('../backend/addprogram_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);

        // Reset the form after successful submission
        addProgramForm.reset();

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#addProgramForm').css('pointer-events', 'auto');
      });
  });

  const editProgramForm = document.getElementById('editProgramForm');
  editProgramForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');
    $('#editProgramForm').css('pointer-events', 'none');

    const formData = new FormData(editProgramForm);

    fetch('../backend/editprogram_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === 'success') {

          // Reset the form after successful edit 
          editProgramForm.reset();

          // Close the active modal section
          $('#editprogrammodal').modal('hide');

        }

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#editProgramForm').css('pointer-events', 'auto');
      });
  });


  const deleteProgramForm = document.getElementById('deleteProgramForm');
  deleteProgramForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $('#loadingSpinner').removeClass('d-none');
    $('#loadingSpinner').addClass('d-flex');
    $('#deleteProgramForm').css('pointer-events', 'none');

    const formData = new FormData(deleteProgramForm);

    fetch('../backend/deleteprogram_backend.php', {
      method: 'POST',
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === 'success') {
          // Reset the form after successful deletion 
          deleteProgramForm.reset();

          // Close the active modal Program
          $('#deleteprogrammodal').modal('hide');
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch(error => {
        // Handle error response here
        console.log(error);
        displayToastr('error', 'An error occurred. Please try again.');
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#deleteProgramForm').css('pointer-events', 'auto');
      });
  });



</script>