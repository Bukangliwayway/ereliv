<?php require_once("../backend/session_faculty.php"); ?>

<div class="row mx-auto d-flex flex-column justify-content-center  align-items-center">
  <div
    class="d-flex flex-row gap-3 sticky-top col-lg-12 col-sm-auto d-flex flex-column justify-content-center align-items-stretch gap-3 mx-auto mt-1 p-5 pb-3">
    <div class="input-group">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="search-myworks" name="search" class="form-control form-control-sm align-middle"
        placeholder="Search" required style="padding: 1.17rem 0.75rem;">
    </div>
  </div>
  <div id="myWorksResult" class="d-flex flex-column gap-3 px-5"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  //Initialize MyWorks
  updateMyWorksListSearch('%');

  document.getElementById("myworksBtn").addEventListener("click", function () {
    updateMyWorksList();
  });

  // Define the attachEventListeners function
  function attachEventListeners() {
    // Select all the links with the specified class
    var links = document.querySelectorAll('.research-link');

    links.forEach(function (link) {
      // Assign a click event handler to the link
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var researchID = this.querySelector('.research-id').getAttribute('data-full-text');
        var researchTitle = this.querySelector('.research-title').textContent;
        var researchAbstract = this.querySelector('.research-abstract').getAttribute('data-full-text');
        var researchKeywords = this.querySelector('.research-keywords').getAttribute('data-full-text');
        var researchPublishDate = this.querySelector('.research-publish-date').textContent;
        var researchUploader = this.querySelector('.research-uploader').getAttribute('data-full-text');
        var researchProgram = this.querySelector('.research-programs').innerHTML;
        var researchAuthor = this.querySelector('.research-authors').innerHTML;
        var researchInterest = this.querySelector('.research-interest').innerHTML;
        var researchProgramRaw = JSON.parse(this.querySelector('.research-raw-programs').value);
        var researchAuthorRaw = JSON.parse(this.querySelector('.research-raw-authors').value);
        var researchInterestRaw = JSON.parse(this.querySelector('.research-raw-interests').value);

        // displaypapermodal
        document.getElementById('display-title-modal').textContent = researchTitle;
        document.getElementById('display-abstract-modal').innerHTML = researchAbstract;
        document.getElementById('display-keywords-modal').textContent = researchKeywords;
        document.getElementById('display-publish-date-modal').textContent = researchPublishDate;
        document.getElementById('display-programs-modal').innerHTML = researchProgram;
        document.getElementById('display-authors-modal').innerHTML = researchAuthor;
        document.getElementById('display-interests-modal').innerHTML = researchInterest;
        document.getElementById('display-uploader-modal').textContent = "Uploaded By: " + researchUploader;

        // deletepapermodal
        document.getElementById('delete-title-modal').textContent = researchTitle;
        document.getElementById('delete-id-modal').value = researchID;

        // editpaperswitch
        if (document.querySelector('.upload-title-label')) {
          document.querySelector('.upload-title-label').style.display = "none";
          document.querySelector('.upload-title').value = researchTitle;
          document.querySelector('.upload-title-label').style.display = "block";
        }

        tinymce.get("content-input").setContent(researchAbstract);

        var parts = researchPublishDate.split(' ');
        var monthName = parts[1];
        var day = parts[0];
        var year = parts[2];
        var month = new Date(Date.parse(monthName + ' 1, 2000')).getMonth() + 1;
        var formattedMonth = month.toString().padStart(2, '0');
        var formattedDate = year + '-' + formattedMonth + '-' + day.padStart(2, '0');
        document.getElementById("date").value = formattedDate;

        if (document.querySelector('.upload-keywords-label')) {
          document.querySelector('.upload-keywords-label').style.display = "none";
          document.querySelector('.upload-keywords').value = researchKeywords;
          document.querySelector('.upload-keywords-label').style.display = "block";
        }

        //Deselect the prev select
        $('#author-select').multiselect('deselectAll');
        $('#program-select').multiselect('deselectAll');
        $('#interest-select').multiselect('deselectAll');

        researchAuthorRaw.forEach(authorID => {
          $('#author-select').multiselect('select', authorID);
        });
        researchProgramRaw.forEach(programID => {
          $('#program-select').multiselect('select', programID);
        });
        researchInterestRaw.forEach(interestID => {
          $('#interest-select').multiselect('select', interestID);
        });

        //Set UploadResearch to Edit Paper
        document.querySelector("#researchID").value = researchID;

      });
    });

    $(".editpaperswitch").on("click", function () {
      document.getElementById("uploadresearchBtn").click();
    });
  }

  // Update research list function
  async function updateMyWorksList() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          type: "faculty",
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatemyworks.php",
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


  async function updateMyWorksListSearch(search) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          type: "faculty",
          search: search,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatemyworks.php",
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

  $(document).on("input", "#search-myworks", function (e) {
    // Get the search query
    const search = $(this).val();
    e.preventDefault();
    updateMyWorksListSearch('%');
  });
</script>