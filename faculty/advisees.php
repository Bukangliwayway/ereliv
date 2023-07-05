<?php require_once("../backend/session_faculty.php"); ?>

<div class="row mx-auto d-flex flex-column justify-content-center  align-items-center">

  <div
    class="d-flex flex-column gap-3 sticky-top col-lg-12 col-sm-auto justify-content-center align-items-stretch mx-auto mt-1 p-5 pb-3">

    <div class="d-flex flex-row gap-3">
      <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchAdvisees" name="search" class="form-control form-control-sm align-middle"
          placeholder="Search" required style="padding: 1.17rem 0.75rem;">
      </div>
    </div>
  </div>
  <div id="searchAdviseesResult" class="d-flex flex-column gap-3"></div>
</div>
<script>

  updateAdviseesResult('%');

  async function updateAdviseesResult(search) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          userID: '<?php echo $_SESSION['userID']; ?>',
          search: search,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updateadvisees.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#searchAdviseesResult").html(response);
          adviseesEventListener();
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

  async function updateAdviseeStatus(userID, status) {
    try {
      var revStatus = (status == 'Active') ? 'Inactive' : 'Active'; // reversed status
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          adviseeID: userID,
          status: revStatus,
          name: "<?php echo $_SESSION['username'] ?>",
          ownertype: 'faculty',
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updateadviseestatus_backend.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          updateAdviseesResult('%');
          var data = JSON.parse(response);
          displayToastr(data.status, data.message);
        });

        ajaxRequest.fail(function (xhr, status, error) {
          console.log(error);
          displayToastr("error", "An error occurred. Please try again.");
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

  $(document).on("input", "#searchAdvisees", function (e) {
    const query = $(this).val();
    e.preventDefault();
    updateAdviseesResult(query);
  });


  function adviseesEventListener() {
    // Select all the links with the specified class
    var adviseesView = document.querySelectorAll('.advisee-view');

    adviseesView.forEach(function (advisee) {
      // Assign a click event handler to the advisee
      advisee.addEventListener('click', function (event) {
        event.preventDefault();
        var adviseeID = this.getAttribute('data-advisee-studentID');
        var adviseeName = this.getAttribute('data-advisee-name');
        var adviseeStudentNumber = this.getAttribute('data-advisee-studentnumber');
        var adviseeSection = this.getAttribute('data-advisee-sectionname');
        var adviseeStatus = this.getAttribute('data-advisee-status');
        var adviseeProgram = this.getAttribute('data-advisee-program');
        var adviseeDate = this.getAttribute('data-advisee-date');
        var adviseeComputeDate = this.getAttribute('data-advisee-computedate');
        var adviseePriority = this.getAttribute('data-advisee-priority');
        var adviseeBgStatus = this.getAttribute('data-advisee-bgStatus');
        var adviseeBtnStatus = this.getAttribute('data-advisee-btnStatus');
        var adviseeActionTitle = this.getAttribute('data-advisee-action-title');

        // displaypapermodal
        document.getElementById('display-advisee-priority-modal').textContent = adviseePriority;
        document.getElementById('display-advisee-status-modal').textContent = adviseeStatus;

        var priorityModal = document.getElementById('display-advisee-priority-modal');
        var statusModal = document.getElementById('display-advisee-status-modal');
        priorityModal.className = ''; // Remove all existing classes
        statusModal.className = ''; // Remove all existing classes
        priorityModal.classList.toggle("badge");
        statusModal.classList.toggle("badge");
        priorityModal.classList.toggle(adviseeBgStatus);
        statusModal.classList.toggle(adviseeBgStatus);

        document.getElementById('display-advisee-name-modal').textContent = adviseeName;
        document.getElementById('display-advisee-studentnumber-modal').textContent = adviseeStudentNumber;

        document.getElementById('display-advisee-program-modal').textContent = adviseeProgram;
        document.getElementById('display-advisee-section-modal').textContent = adviseeSection;

        document.getElementById('display-advisee-date-modal').textContent = adviseeDate;

        var actionModal = document.getElementById('display-advisee-action-modal');
        actionModal.textContent = adviseeActionTitle;
        actionModal.className = ''; // Remove all existing classes
        actionModal.classList.toggle('btn');
        actionModal.classList.toggle('text-capitalize');
        actionModal.classList.toggle('adviseeSwitch');
        actionModal.classList.toggle(adviseeBtnStatus);
        actionModal.setAttribute('data-advisee-studentID', adviseeID);
        actionModal.setAttribute('data-advisee-status', adviseeStatus);
      });
    });
    document.querySelector('.adviseeSwitch').addEventListener('click', function (event) {
      event.preventDefault(); // Prevent form from submitting normally
      $('#displayadviseemodal').modal('hide');
      updateAdviseeStatus(this.getAttribute('data-advisee-studentID'), this.getAttribute('data-advisee-status'));
    }, { once: true });
  }




</script>