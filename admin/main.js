//INDEX.PHP
$(document).ready(function () {
  const displayToastr = (type, message) => {
    toastr[type](message);
  };

  var programListContainer = document.getElementById("programListContainer");
  var facultyRegistrationContainer = document.getElementById(
    "facultyRegistrationContainer"
  );
  var viewAccountsContainer = document.getElementById("viewAccountsContainer");
  var notificationsContainer = document.getElementById(
    "notificationsContainer"
  );

  // Get the button elements
  var addProgramsBtn = document.getElementById("addProgramsBtn");
  var addFacultyBtn = document.getElementById("addFacultyBtn");
  var viewAccountsBtn = document.getElementById("viewAccountsBtn");
  var notificationsBtn = document.getElementById("notificationsBtn");

  // Get the buttons and div containers
  const buttons = document.querySelectorAll(".toggle-btn");
  const containers = document.querySelectorAll(".toggle-visibility");

  // Function to toggle visibility of div containers
  const toggleView = (containerToShow) => {
    // Hide all div containers
    containers.forEach((container) => {
      container.classList.add("d-none");
    });

    // Show the selected container
    containerToShow.classList.remove("d-none");
  };

  // Add click event listener to the button container
  document.addEventListener("click", (event) => {
    const target = event.target;

    // Check if the clicked element is a button
    if (target.classList.contains("toggle-btn")) {
      const containerId = target.dataset.container;
      const containerToShow = document.getElementById(containerId);

      // Toggle the visibility of div containers
      toggleView(containerToShow);

      // Toggle the active class on buttons
      buttons.forEach((button) => {
        button.classList.toggle("active", button === target);
      });
    }
  });

  //FACULTYREGIS.PHP

  $("#facultyForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    //Loading Routine
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#facultyForm").css({ "pointer-events": "none" });

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../backend/facultyregis_backend.php",
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
        toastr.error("An error occurred. Please try again.");
      },
      complete: function () {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#facultyForm").css("pointer-events", "auto");
      },
    });
  });

  //PROGRAMLIST.PHP
  updateProgramList();

  async function updateProgramList() {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const formData = new FormData();
        formData.append("csrf_token", csrfToken);

        // Make the request to update the program list
        const updateResponse = await fetch("../backend/updateprogramlist.php", {
          method: "POST",
          body: formData,
        });

        if (updateResponse.ok) {
          // Request succeeded, do something with the response if needed
          const addSectionContainer = document.getElementById("programList");
          addSectionContainer.innerHTML = await updateResponse.text();

          // Attach event listeners to the newly added elements
          attachEventListeners();
        } else {
          // Request failed, handle the error
          console.error("Error updating program list:", updateResponse.status);
          displayToastr("error", "An error occurred. Please try again.");
        }
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

  function attachEventListeners() {
    const addSectionButtons = document.querySelectorAll(".addsectionbutton");
    addSectionButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const string = button.getAttribute("data-string");
        document.querySelector("#getprogramid_target").value = string;
      });
    });

    const editSectionButtons = document.querySelectorAll(".editsectionbutton");
    editSectionButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const string = this.getAttribute("data-string");
        document.querySelector("#original_target").value = string;
      });
    });

    const deleteSectionButtons = document.querySelectorAll(
      ".deletesectionbutton"
    );
    deleteSectionButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const name = this.getAttribute("data-string");
        const id = this.getAttribute("data-id");
        document.querySelector("#delete_target").value = id;
        document.querySelector("#delete_target_name").value = name;
      });
    });

    const editProgramButtons = document.querySelectorAll(".editprogrambutton");
    editProgramButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const string = this.getAttribute("data-string");
        document.querySelector("#original_program_target").value = string;
      });
    });

    const deleteProgramButtons = document.querySelectorAll(
      ".deleteprogrambutton"
    );
    deleteProgramButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const string = this.getAttribute("data-string");
        document.querySelector("#delete_program_target").value = string;
      });
    });
  }

  const addSectionForm = document.getElementById("addSectionForm");
  addSectionForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#addSectionForm").css("pointer-events", "none");

    const formData = new FormData(addSectionForm);

    fetch("../backend/addsection_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);

        // Reset the form after successful submission
        addSectionForm.reset();

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addSectionForm").css("pointer-events", "auto");
      });
  });

  const editSectionForm = document.getElementById("editSectionForm");
  editSectionForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#editSectionForm").css("pointer-events", "none");

    const formData = new FormData(editSectionForm);

    fetch("../backend/editsection_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status == "success") {
          // Reset the form after successful edit
          editSectionForm.reset();

          // Close the active modal section
          $("#editsectionmodal").modal("hide");
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editSectionForm").css("pointer-events", "auto");
      });
  });

  const deleteSectionForm = document.getElementById("deleteSectionForm");
  deleteSectionForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#deleteSectionForm").css("pointer-events", "none");

    const formData = new FormData(deleteSectionForm);

    fetch("../backend/deletesection_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === "success") {
          // Reset the form after successful deletion
          deleteSectionForm.reset();

          // Close the active modal section
          $("#deletesectionmodal").modal("hide");
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteSectionForm").css("pointer-events", "auto");
      });
  });

  const addProgramForm = document.getElementById("addProgramForm");
  addProgramForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");

    $("#addProgramForm").css("pointer-events", "none");

    const formData = new FormData(addProgramForm);

    fetch("../backend/addprogram_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);

        // Reset the form after successful submission
        addProgramForm.reset();

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#addProgramForm").css("pointer-events", "auto");
      });
  });

  const editProgramForm = document.getElementById("editProgramForm");
  editProgramForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#editProgramForm").css("pointer-events", "none");

    const formData = new FormData(editProgramForm);

    fetch("../backend/editprogram_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === "success") {
          // Reset the form after successful edit
          editProgramForm.reset();

          // Close the active modal section
          $("#editprogrammodal").modal("hide");
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#editProgramForm").css("pointer-events", "auto");
      });
  });

  const deleteProgramForm = document.getElementById("deleteProgramForm");
  deleteProgramForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-none");
    $("#loadingSpinner").addClass("d-flex");
    $("#deleteProgramForm").css("pointer-events", "none");

    const formData = new FormData(deleteProgramForm);

    fetch("../backend/deleteprogram_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr success message
        displayToastr(data.status, data.message);
        console.log(data.status);
        if (data.status === "success") {
          // Reset the form after successful deletion
          deleteProgramForm.reset();

          // Close the active modal Program
          $("#deleteprogrammodal").modal("hide");
        }

        // Reload the program list container
        updateProgramList();
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert Loading Routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $("#deleteProgramForm").css("pointer-events", "auto");
      });
  });

  // VIEWACCOUNTS
  // Function to load faculty accounts
  async function loadFacultyAccounts(column, order) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          column_name: column,
          order: order,
          csrf_token: csrfToken,
        };

        // Make the request to load faculty accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatefacultyaccounts.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#facultyList").html(response);
          $(".sortFaculty").find(".bi").remove(); // Remove arrows from other columns
          $('[data-faculty="' + column + '"]').append(getArrowHtml(order));
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

  // Function to load student accounts
  async function loadStudentAccounts(column, order) {
    try {
      // Fetch the CSRF token from the server
      const response = await fetch("../backend/getcsrftoken.php");
      if (response.ok) {
        const csrfToken = await response.text();

        // Prepare the request data
        const requestData = {
          column_name: column,
          order: order,
          csrf_token: csrfToken,
        };

        // Make the request to load student accounts
        const ajaxRequest = $.ajax({
          url: "../backend/updatestudentaccounts.php",
          type: "POST",
          data: requestData,
        });

        ajaxRequest.done(function (response) {
          // Update the table content
          $("#studentList").html(response);
          $(".sortStudent").find(".bi").remove(); // Remove arrows from other columns
          $('[data-student="' + column + '"]').append(getArrowHtml(order));
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

  function attachEventListeners() {
    // Function to handle activate button click
    const activateButton = document.querySelectorAll(".activatebutton");
    activateButton.forEach((button) => {
      button.addEventListener("click", function () {
        const accountID = button.getAttribute("data-string");
        const user = button.getAttribute("data-user");
        document.querySelector("#activateAccountID").value = accountID;
        document.querySelector("#activateUserType").value = user;

        // Show the activate modal
        $("#activatemodal").modal("show");
      });
    });

    // Function to handle deactivate button click
    const deactivateButton = document.querySelectorAll(".deactivatebutton");
    deactivateButton.forEach((button) => {
      button.addEventListener("click", function () {
        const accountID = button.getAttribute("data-string");
        const user = button.getAttribute("data-user");
        document.querySelector("#deactivateAccountID").value = accountID;
        document.querySelector("#deactivateUserType").value = user;

        // Show the deactivate modal
        $("#deactivatemodal").modal("show");
      });
    });
  }

  const activateModalForm = document.getElementById("activateModalForm");
  activateModalForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-flex");
    $("#loadingSpinner").addClass("d-none");
    $(activateModalForm).css("pointer-events", "none");

    const formData = new FormData(activateModalForm);

    fetch("../backend/updatestatus_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr notification
        displayToastr(data.status, data.message);

        if (data.status === "success") {
          // Reset the form after successful activation
          activateModalForm.reset();

          // Close the activate modal
          $("#activatemodal").modal("hide");
        }
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert loading routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $(activateModalForm).css("pointer-events", "auto");
        loadStudentAccounts("priority", "asc");
        loadFacultyAccounts("priority", "asc");
      });
  });

  const deactivateModalForm = document.getElementById("deactivateModalForm");
  deactivateModalForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form from submitting normally

    $("#deactivatemodal").modal("hide");

    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-flex");
    $("#loadingSpinner").addClass("d-none");
    $(deactivateModalForm).css("pointer-events", "none");

    const formData = new FormData(deactivateModalForm);

    fetch("../backend/updatestatus_backend.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Display a Toastr notification
        displayToastr(data.status, data.message);

        if (data.status === "success") {
          // Reset the form after successful deactivation
          deactivateModalForm.reset();

          // Close the deactivate modal
          $("#deactivatemodal").modal("hide");
        }
      })
      .catch((error) => {
        // Handle error response here
        console.log(error);
        displayToastr("error", "An error occurred. Please try again.");
      })
      .finally(() => {
        // Revert loading routine back to normal
        $("#loadingSpinner").removeClass("d-flex");
        $("#loadingSpinner").addClass("d-none");
        $(deactivateModalForm).css("pointer-events", "auto");

        loadStudentAccounts("priority", "asc");
        loadFacultyAccounts("priority", "asc");
      });
  });

  // Sort student accounts on column click
  $(document).on("click", ".sortStudent", function (e) {
    e.preventDefault();
    var column = $(this).data("student");
    var order = $(this).data("order");

    loadStudentAccounts(column, order);
  });

  // Sort faculty accounts on column click
  $(document).on("click", ".sortFaculty", function (e) {
    e.preventDefault();
    var column = $(this).data("faculty");
    var order = $(this).data("order");

    loadFacultyAccounts(column, order);
  });

  // Initial load of student accounts on page load
  loadFacultyAccounts("facultyID", "desc");
  // Initial load of faculty accounts on page load
  loadStudentAccounts("studentID", "desc");

  function getArrowHtml(order) {
    if (order === "desc") {
      return '&nbsp;<span class="bi bi-arrow-down"></span>';
    } else {
      return '&nbsp;<span class="bi bi-arrow-up"></span>';
    }
  }
  function showLoadingAnimation(formElement) {
    // Perform loading routine before form submission
    $("#loadingSpinner").removeClass("d-flex");
    $("#loadingSpinner").addClass("d-none");
    $(formElement).css("pointer-events", "none");
  }

  function hideLoadingAnimation(formElement) {
    // Revert loading routine back to normal
    $("#loadingSpinner").removeClass("d-flex");
    $("#loadingSpinner").addClass("d-none");
    $(formElement).css("pointer-events", "auto");
  }
});
