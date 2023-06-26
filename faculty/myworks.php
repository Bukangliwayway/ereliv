<?php require_once("../backend/session_faculty.php"); ?>

<div class="row mx-auto d-flex flex-column justify-content-center  align-items-center p-5">
  <div
    class="d-flex flex-row gap-3 sticky-top col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch gap-3 mx-auto mt-1">
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="search" name="search" class="form-control form-control-sm align-middle"
        placeholder="Search" required style="padding: 1.17rem 0.75rem;">
    </div>
    <div id="myWorksResult" class="d-flex flex-column gap-3"></div>
  </div>
</div>

<!-- modal -->
<div class="modal fade" id="displaypage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="min-width: 80vw;">
    <div class="modal-content" style="min-height: 80vh;">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-capitalize text-center">
          Overview of Research
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="container modal-body p-5">

        <h2 class="text-capitalize text-center mb-4" id="research-title-modal"></h2>
        <h5 class="mb-2"><strong>Abstract:</strong></h5>
        <div id="research-abstract-modal"></div>
        <span id="research-publish-date-modal"></span>
        <div class="text-reset" id="research-authors-modal"></div>
        <span class="text-capitalize" id="research-uploader-modal"></span>
        <h5 class="mt-3"><strong>Keywords:</strong></h5>
        <p id="research-keywords-modal"></p>
        <div id="research-programs-modal"></div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Define the attachEventListeners function
  function attachEventListeners() {
    // Select all the links with the specified class
    var links = document.querySelectorAll('.research-link');

    links.forEach(function (link) {
      // Assign a click event handler to the link
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var researchID = this.id;
        var researchTitle = this.querySelector('.research-title').textContent;
        var researchAbstract = this.querySelector('.research-abstract').getAttribute('data-full-text');
        var researchKeywords = this.querySelector('.research-keywords').getAttribute('data-full-text');
        var researchPublishDate = this.querySelector('.research-publish-date').textContent;
        var researchUploader = this.querySelector('.research-uploader').textContent;
        var researchProgram = this.querySelector('.research-programs').innerHTML;
        var researchAuthor = this.querySelector('.research-authors').innerHTML;

        document.getElementById('research-title-modal').textContent = researchTitle;
        document.getElementById('research-abstract-modal').innerHTML = researchAbstract;
        document.getElementById('research-keywords-modal').textContent = researchKeywords;
        document.getElementById('research-publish-date-modal').textContent = researchPublishDate;
        document.getElementById('research-programs-modal').innerHTML = researchProgram;
        document.getElementById('research-authors-modal').innerHTML = researchAuthor;
        document.getElementById('research-uploader-modal').innerHTML = researchUploader;
      });
    });
  }

  // Update research list on DOMContentLoaded event
  window.addEventListener('DOMContentLoaded', function () {
    // Trigger search on page load
    updateResearchList();
  });


  // Update research list function
  async function updateResearchList() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          facultyID: '<?php echo $_SESSION['userID']; ?>',
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updateresearchesfaculty.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#myWorksResult").html(response);
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