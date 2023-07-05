<?php require_once("../backend/session_faculty.php"); ?>

<div class="row m-0 mx-auto d-flex flex-column justify-content-center  align-items-center p-5">
  <div
    class="col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch text-center gap-3 mx-auto border border-smoke mt-1 py-5">
    <h1 class="fs-2 fw-bold text-uppercase">
      Publish research
    </h1>
    <form id="uploadResearchForm" class="d-flex flex-column gap-1 px-3">
      <div class="form-floating mb-3">
        <input type="text" name="title" class="form-control upload-title" placeholder="title" required />
        <label for="title" class="form-label upload-title-label">Research Title</label>
      </div>

      <div class="form-floating mb-3">
        <textarea id="content-input" class="upload-abstract" name="content-input"
          placeholder="Research Abstract"></textarea>
      </div>

      <div class="input-group mb-3">
        <div class="form-floating">
          <input type="text" id="date" name="date" class="upload-date form-control bg-white" id="datepicker-output"
            data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true"
            value="<?php echo date('Y-m-d'); ?>" pattern="\d{4}-\d{2}-\d{2}"
            title="Please enter a valid date in the format YYYY-MM-DD" required>
          <label for="datepicker-output">Publish Date</label>
        </div>
        <span class="input-group-append">
          <span class="input-group-text bg-white">
            <i class="bi bi-calendar-date" id="datepicker-icon"></i>
          </span>
        </span>
      </div>

      <div class="example author-select">
        <select id="author-select" class="upload-author" multiple="multiple"></select>
      </div>

      <div class="example program-select">
        <select id="program-select" class="upload-program" multiple="multiple"></select>
      </div>

      <div class="example interest-select">
        <select id="interest-select" class="upload-interest" multiple="multiple"> </select>
      </div>

      <div class="form-floating mb-3">
        <input type="keywords" id="keywords" name="keywords" class="form-control upload-keywords" placeholder="keywords"
          required />
        <label for="keywords" class="form-label upload-keywords-label">Keywords (Separate Each by Commas)</label>
      </div>

      <input type="hidden" name="content" id="content">
      <input type="hidden" name="authors" id="authors">
      <input type="hidden" name="interests" id="interests">
      <input type="hidden" name="programs" id="programs">
      <input type="hidden" name="researchID" id="researchID">
      <input type="hidden" name="type" id="type" value="faculty">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <button type="submit" class="btn btn-primary">Upload Research</button>
    </form>
  </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

$(document).ready(function () {
  // UPLOADRESEARCH.PHP

  tinymce.init({
    selector: "textarea",
    plugins: "",
    toolbar:
      "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough",
    height: 250,
    menubar: false,
    setup: function (editor) {
      editor.on("change", function () {
        document.getElementById("content").value = tinymce
          .get("content-input")
          .getContent();
      });
    },
  });

  reloadMultiselects();
});

function updateHiddenFields() {
  var dataInputAuthors = document.getElementById("authors");
  var dataInputPrograms = document.getElementById("programs");
  var dataInputInterests = document.getElementById("interests");
  var dataInputContent = document.getElementById("content");

  var selectedOptionsAuthors = $("#author-select").val();
  dataInputAuthors.value = JSON.stringify(selectedOptionsAuthors);

  var selectedOptionsPrograms = $("#program-select").val();
  dataInputPrograms.value = JSON.stringify(selectedOptionsPrograms);

  var selectedOptionsInterests = $("#interest-select").val();
  dataInputInterests.value = JSON.stringify(selectedOptionsInterests);

  var inputtedTextContent = tinymce.get("content-input").getContent();
  dataInputContent.value = inputtedTextContent;
}

function clearFields() {
  // Reset the form after successful upload
  $("#uploadResearchForm")[0].reset();
  // //Deselect the prev select
  $("#author-select").multiselect("deselectAll");
  $("#program-select").multiselect("deselectAll");
  $("#interest-select").multiselect("deselectAll");
  //reset all the hidden fields as well
  document.getElementById("content").value = "";
  document.getElementById("authors").value = "";
  document.getElementById("interests").value = "";
  document.getElementById("programs").value = "";
  document.getElementById("researchID").value = "";
}

$("#uploadResearchForm").submit(function (event) {
  event.preventDefault(); // Prevent the default form submission

  updateHiddenFields(); // So that the hidden fields will have its value
  //Loading Routine
  $("#loadingSpinner").removeClass("d-none");
  $("#loadingSpinner").addClass("d-flex");
  $("#facultyForm").css({ "pointer-events": "none" });

  // Serialize form data
  var formData = $(this).serialize();

  // Perform AJAX request
  $.ajax({
    type: "POST",
    url: "../backend/uploadresearch_backend.php",
    data: formData,
    success: function (response) {
      displayToastr(response.status, response.message);
      if (response.status === "success") {
        clearFields();
        document.getElementById("myworksBtn").click();
      }
    },
    error: function (response) {
      // Handle error response here
      displayToastr("error", "An error occurred. Please try again.");
    },
    complete: function () {
      // Revert Loading Routine back to normal
      $("#loadingSpinner").removeClass("d-flex");
      $("#loadingSpinner").addClass("d-none");
      $("#facultyForm").css("pointer-events", "auto");
    },
  });
});

function reloadMultiselects() {
  require(["bootstrap-multiselect"], function () {
    $("#interest-select").multiselect({
      includeSelectAllOption: true,
      buttonWidth: 250,
      enableFiltering: true,
    });
  });

  require(["bootstrap-multiselect"], function () {
    $("#program-select").multiselect({
      includeSelectAllOption: true,
      buttonWidth: 250,
      enableFiltering: true,
    });
  });

  require(["bootstrap-multiselect"], function () {
    $("#author-select").multiselect({
      includeSelectAllOption: true,
      buttonWidth: 250,
      enableFiltering: true,
    });
  });
  loadAuthorSelect();
  loadProgramSelect();
  loadInterestSelect();
}

async function loadAuthorSelect() {
  try {
    // Fetch the CSRF token from the server
    const response = await fetch("../backend/getcsrftoken.php");
    if (response.ok) {
      const csrfToken = await response.text();

      // Prepare the request data
      const requestData = {
        table: "Author",
        csrf_token: csrfToken,
      };

      // Make the request to load faculty accounts
      const ajaxRequest = $.ajax({
        url: "../backend/getCategories.php",
        type: "POST",
        data: requestData,
      });

      ajaxRequest.done(function (response) {
        var authorSelect = $("#author-select");

        // Clear existing options
        authorSelect.empty();

        // Add newauthorSelect options
        $.each(response, function (index, authorData) {
          var fullName =
            authorData.lastname.charAt(0).toUpperCase() +
            authorData.lastname.slice(1) +
            ", " +
            authorData.firstname.charAt(0).toUpperCase() +
            authorData.firstname.slice(1);
          var option = $("<option>", {
            value: authorData.authorID,
            text: fullName,
          });
          authorSelect.append(option);
        });

        // rebuild the Multiselect dropdown
        authorSelect.multiselect("rebuild");
        attachEventListeners();
      });

      ajaxRequest.fail(function (xhr, status, error) {
        console.log(error);
      });
    } else {
      // Unable to fetch CSRF token, handle the error
      console.error("Error fetching CSRF token:", response.status);
      displayToastr("error", "An error occurred. Please try again.");
    }
  } catch (error) {
    // General error occurred, handle it
    console.error("Error:", error);
    displayToastr("error", "An error occurred. Please try again.");
  }
}

async function loadProgramSelect() {
  try {
    // Fetch the CSRF token from the server
    const response = await fetch("../backend/getcsrftoken.php");
    if (response.ok) {
      const csrfToken = await response.text();

      // Prepare the request data
      const requestData = {
        table: "Program",
        csrf_token: csrfToken,
      };

      // Make the request to load faculty accounts
      const ajaxRequest = $.ajax({
        url: "../backend/getCategories.php",
        type: "POST",
        data: requestData,
      });

      ajaxRequest.done(function (response) {
        var programSelect = $("#program-select");

        // Clear existing options
        programSelect.empty();

        // Add newprogramSelect options
        $.each(response, function (index, programData) {
          var option = $("<option>", {
            value: programData.programID,
            text: programData.name.toUpperCase(),
          });
          programSelect.append(option);
        });

        // rebuild the Multiselect dropdown
        programSelect.multiselect("rebuild");
        attachEventListeners();
      });

      ajaxRequest.fail(function (xhr, status, error) {
        console.log(error);
      });
    } else {
      // Unable to fetch CSRF token, handle the error
      console.error("Error fetching CSRF token:", response.status);
      displayToastr("error", "An error occurred. Please try again.");
    }
  } catch (error) {
    // General error occurred, handle it
    console.error("Error:", error);
    displayToastr("error", "An error occurred. Please try again.");
  }
}

async function loadInterestSelect() {
  try {
    // Fetch the CSRF token from the server
    const response = await fetch("../backend/getcsrftoken.php");
    if (response.ok) {
      const csrfToken = await response.text();

      // Prepare the request data
      const requestData = {
        table: "Interest",
        csrf_token: csrfToken,
      };

      // Make the request to load faculty accounts
      const ajaxRequest = $.ajax({
        url: "../backend/getCategories.php",
        type: "POST",
        data: requestData,
      });

      ajaxRequest.done(function (response) {
        var interestSelect = $("#interest-select");

        // Clear existing options
        interestSelect.empty();

        // Add new options
        $.each(response, function (index, interestData) {
          var option = $("<option>", {
            value: interestData.interestID,
            text:
              interestData.name.charAt(0).toUpperCase() +
              interestData.name.slice(1).toLowerCase(),
          });
          interestSelect.append(option);
        });

        // rebuild the Multiselect dropdown
        interestSelect.multiselect("rebuild");
        attachEventListeners();
      });

      ajaxRequest.fail(function (xhr, status, error) {
        console.log(error);
      });
    } else {
      // Unable to fetch CSRF token, handle the error
      console.error("Error fetching CSRF token:", response.status);
      displayToastr("error", "An error occurred. Please try again.");
    }
  } catch (error) {
    // General error occurred, handle it
    console.error("Error:", error);
    displayToastr("error", "An error occurred. Please try again.");
  }
}

</script>